<?php

declare(strict_types=1);

namespace App\Model\Logic;

# library
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Log;

final class HelperLogic
{
    /**
     * Filters the input array to only include the specified keys.
     * 
     * @param array $inputs The input associative array.
     * @param array $keys The keys to be retained in the input array.
     * @return array The filtered associative array containing only the specified keys.
     */
    public static function safeInput($inputs, $keys)
    {
        // Use array_intersect_key to get only the keys present in both $inputs and the flipped $keys array
        return array_intersect_key($inputs, array_flip($keys));
    }

    /**
     * Cleans and filters an array based on specified keys and empty value conditions.
     *
     * @param array $res The input array to be cleaned.
     * @param array $patternOutputs The keys to be retained in the output array.
     * @param bool $allowEmpty Whether to allow empty values to be retained.
     * @param array $specifiedNotEmpty The keys that must not be empty even if $allowEmpty is true.
     * @return array The cleaned array containing only the specified keys and values.
     */
    public static function cleanParams(array $res = [], array $patternOutputs = [], bool $allowEmpty = false, array $specifiedNotEmpty = [])
    {
        $output = [];
        foreach ($res as $key => $data) {
            // Check if the key is in the list of keys to be retained
            if (in_array($key, $patternOutputs)) {
                // Check if the value is allowed to be empty or is not empty
                if ($allowEmpty || $data === "0" || !empty($data)) {
                    // Check if the key requires a non-empty value
                    if (in_array($key, $specifiedNotEmpty)) {
                        // Only include if the value is not empty or is "0"
                        if (!empty($data) || $data === "0") {
                            $output[$key] = $data;
                        }
                    } else {
                        // Handle cases where the value can be empty
                        if ($allowEmpty && empty($data) && $data !== "0") {
                            $data = null;
                        }

                        $output[$key] = $data;
                    }
                }
            }
        }

        return $output;
    }

    /**
     * Filters an array to include only keys with non-empty values (including "0").
     *
     * @param array $res The input array to be cleaned.
     * @return array The cleaned array containing only non-empty keys and values.
     */
    public static function cleanTableParams(array $res = [])
    {
        $issetFilter = [];
        foreach ($res as $key => $value) {
            // Check if the value is not empty or is "0"
            if (!empty($value) || $value == "0") {
                // Include the key-value pair in the output array
                $issetFilter[$key] = $value;
            }
        }
        return $issetFilter;
    }

    /**
     * Explodes a string into an array, removing spaces and trimming the string.
     *
     * @param string $res The input string to be exploded.
     * @return array The array containing the exploded values.
     */
    public static function explodeParams($res)
    {
        // Remove spaces, trim the string, and store the result in $res
        $res = trim(str_replace(" ", "", $res), ",");

        // Explode the modified string using commas as the delimiter
        $array = explode(",", $res);

        return $array;
    }

    /**
     * Splits JSON string into separate arrays with keys and values or just values.
     *
     * @param string $res The JSON string to be processed.
     * @param bool $withKey
     * @return array An array containing the keys and a concatenated string of values.
     */
    public static function splitJsonParams($res, $withKey = true)
    {
        $decoded = json_decode($res, true);
        $dataValue = "";

        if ($withKey) {
            $dataKey = [];
            foreach ($decoded as $key => $value) {
                $dataKey[] = $key;
                $dataValue .= $value . ",";
            }
            return [$dataKey, rtrim($dataValue, ",")];
        } else {
            foreach ($decoded as $value) {
                $dataValue .= $value . ",";
            }
            return [rtrim($dataValue, ",")];
        }
    }

    /**
     * Splits JSON string into separate arrays with modified keys and values
     * 
     * @param mixed $res
     * @param mixed $table
     * @param mixed $tableFilterColumn
     * @param mixed $tableSelectColumn
     * @return array
     */
    public static function splitJsonWithModifiedKey($res, $table, $tableFilterColumn, $tableSelectColumn)
    {
        $decoded = json_decode($res, true);
        $dataKey = [];

        foreach ($decoded as $key => $value) {
            $setting = SettingLogic::get($table, [$tableFilterColumn => $key]);
            if ($setting) {
                $dataKey[$setting[$tableSelectColumn]] = $value;
            } else {
                $dataKey[$key] = $value;
            }
        }

        return $dataKey;
    }

    /**
     * Combines a key string with a comma-separated value string into an associative array.
     *
     * @param array $key The key array to be used as keys in the output array.
     * @param string $value The comma-separated value string to be exploded and used as values in the output array.
     * @return array An associative array combining keys from $key and values from $value.
     */
    public static function combineParamsToArray($key, $value)
    {
        // $key = self::explodeParams($key);
        $valueBreak = self::explodeParams($value);

        $output = [];
        for ($count = 0; $count < count($key); $count++) {
            $output[$key[$count]] = $valueBreak[$count];
        }

        return $output;
    }

    /**
     * Formats an array based on a specified pattern of keys.
     * 
     * @param object|array $res The input data to be formatted. It can be a single record or a list of records.
     * @param array $patternOutputs The pattern array which defines the keys to be included in the output.
     * @param bool $isListing Flag to determine if the input data is a list of records or a single record.
     * @return array The formatted output array.
     */
    public static function formatOutput($res, $patternOutputs = ["success", "data", "msg"], $isListing = false)
    {
        $output = [];
        if ($isListing) {
            foreach ($res as $mainIndex => $data) {
                foreach ($patternOutputs as $index) {
                    $output[$mainIndex][$index] = isset($data[$index]) ? $data[$index] : "";
                }
            }
        } else {
            foreach ($patternOutputs as $index) {
                $output[$index] = isset($res[$index]) ? $res[$index] : "";
            }
        }
        return array_merge([], $output);
    }

    /**
     * Builds an action code based on a route path and an HTTP method.
     *
     * @param string $path The route path.
     * @param string $method The HTTP method.
     * @return string The action code.
     */
    public static function buildActionCode(string $path = "", string $method = ""): string
    {
        // Remove leading and trailing slashes, then replace remaining slashes with underscores
        $target = trim(str_replace("/", "_", trim($path)), "_");

        // Replace {_id:\d+} and {_id} placeholders with "_id"
        $target = str_replace("_{id:\d+}", "_id", $target);
        $target = str_replace("_{id}", "_id", $target);

        // Concatenate the target and method (if provided) with a "@" symbol
        return $method ? strtolower("{$target}@{$method}") : strtolower("{$target}");
    }

    /**
     * Builds date search conditions based on request parameters and date parameters.
     *
     * @param Request $request The request object containing the date parameters.
     * @param array $dateParams An array of date parameters to search for.
     * @param string|null $table The table name to prefix to the date parameters.
     * @return array An array of date search conditions.
     */
    public static function buildDateSearch(Request $request, $dateParams = [], $table = null)
    {
        $output = [];

        foreach ($dateParams as $param) {
            $start = $request->get($param . "_start") ?? "";
            $end = $request->get($param . "_end") ?? "";

            if (!empty($start)) {
                $startAt = !is_null($table) ? $table . "." . $param : $param;
                $output[] = [$startAt, ">=", $start . " 00:00:00"];
            }

            if (!empty($end)) {
                $endAt = !is_null($table) ? $table . "." . $param : $param;
                $output[] = [$endAt, "<=", $end . " 23:59:59"];
            }
        }

        return $output;
    }

    /**
     * Builds attributes for a table based on specified parameters.
     *
     * @param string $table The table name.
     * @param array $params The parameters to use for fetching attributes.
     * @return array The output array with attribute codes as keys and values as values.
     */
    public static function buildAttribute($table, $params)
    {
        $output = [];
        $list = SettingLogic::get($table, $params, true);

        foreach ($list as $row) {
            $attribute = SettingLogic::get("attribute", ["id" => $row["attribute_id"]]);
            if ($attribute) {
                $output[$attribute["code"]] = $row["value"];
            }
        }

        return $output;
    }

    /**
     * Builds general attributes based on specified parameters.
     *
     * @param array $params The parameters to use for fetching general attributes.
     * @return array The output array with attribute keys and values.
     */
    public static function buildAttributeGeneral($params)
    {
        $output = [];
        $res = SettingLogic::get("general", $params);
        $list = ($res)
            ? self::explodeParams($res["value"])
            : [];

        foreach ($list as $row) {
            $split = explode("-", $row);
            $output[] = [
                "key" => $split[0],
                "value" => $split[1],
            ];
        }

        return $output;
    }

    /**
     * Generates a random code of a specified length and type.
     *
     * @param int $length The length of the code to generate.
     * @param string $type The type of characters to include in the code (int|string|string-upper|string-lower|mixed-upper|mixed-lower|mixed).
     * @return int|string The generated random code.
     */
    public static function randomCode(int $length = 16, string $type = "mixed-upper"): int|string
    {
        switch ($type) {
            case "int":
                $selections = "0123456789";
                break;

            case "string":
                $selections = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
                break;

            case "string-upper":
                $selections = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
                break;

            case "string-lower":
                $selections = "abcdefghijklmnopqrstuvwxyz";
                break;

            case "mixed-upper":
                $selections = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
                break;

            case "mixed-lower":
                $selections = "0123456789abcdefghijklmnopqrstuvwxyz";
                break;

            case "mixed":
            default:
                $selections = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
                break;
        }

        $range = strlen($selections);
        $random_string = "";
        for ($i = 0; $i < $length; $i++) {
            $random_string .= $selections[mt_rand(0, $range - 1)];
        }

        return $random_string;
    }

    /**
     * Generates a unique serial number for a specified table and column.
     *
     * @param string|null $table The table name.
     * @param int $length The length of the serial number to generate.
     * @param string $type The type of characters to include in the serial number.
     * @param array $snArray for bulk insert check unique sn
     * @return string The generated unique serial number.
     */
    public static function generateUniqueSN(string $table = null, int $length = 16, string $type = "mixed-upper", array $snArray = [])
    {
        $isUnique = false;
        $sn = "";
        $column = "sn";

        // sn column name
        if ($table == "account_admin") {
            $column = "admin_id";
        } else if ($table == "account_user") {
            $column = "user_id";
        } else if ($table == "account_user:referral_code") {
            $table = "account_user";
            $column = "referral_code";
        }

        // Loop until a unique serial number is generated
        while (!$isUnique) {
            $sn = self::randomCode($length, $type);

            if (
                !Db::table($table)->where($column, $sn)->exists() &&
                !in_array($sn, $snArray)
            ) {
                $isUnique = true;
            }
        }

        return $sn;
    }

    /**
     * Encrypts data using AES-256-CBC encryption algorithm.
     *
     * @param mixed $data The data to be encrypted.
     * @return string|false The encrypted data, or false on failure.
     */
    public static function encrypt($data)
    {
        $response = false;

        try {
            $method = "AES-256-CBC";
            $key = env("OPEN_SSL_KEY");
            $options = 0;
            $iv = env("OPEN_SSL_IV");

            $response = openssl_encrypt($data, $method, $key, $options, $iv);
        } catch (\Exception $e) {
        }

        return $response;
    }

    /**
     * Decrypts data encrypted using AES-256-CBC encryption algorithm.
     *
     * @param string $data The encrypted data to be decrypted.
     * @return string|false The decrypted data, or false on failure.
     */
    public static function decrypt($data)
    {
        $response = false;

        try {
            $method = "AES-256-CBC";
            $key = env("OPEN_SSL_KEY");
            $options = 0;
            $iv = env("OPEN_SSL_IV");

            $response = openssl_decrypt($data, $method, $key, $options, $iv);
        } catch (\Exception $e) {
        }

        return $response;
    }

    /**
     * Send an HTTP request using cURL
     */
    public static function httpSend(string $method = "GET", string $url = "", array $data = [], array $header = [], int $connectionTimeout = 0)
    {
        $response = false;
        $method = strtoupper($method);
        $curl = curl_init();

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        // default 0, in seconds
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, $connectionTimeout);

        # data
        if ($method === "GET") {
            if (count($data) > 0) {
                curl_setopt($curl, CURLOPT_URL, $url . "?" . http_build_query($data));
            } else {
                curl_setopt($curl, CURLOPT_URL, $url);
            }
        } else {
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
        }

        # header
        $headers = ["Content-Type: application/json"];
        if (count($header) > 0) {
            $headers = [...$headers, ...$header];
        }
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

        # execute
        $response = curl_exec($curl);
        if (curl_errno($curl)) {
            Log::error("Curl error:" . curl_error($curl));
        }
        curl_close($curl);

        if (!empty($response)) {
            return json_decode($response, true);
        } else {
            return [];
        }
    }

    /**
     * Select items randomly based on their weights.
     *
     * @param array $data An associative array where keys are item names and values are weights.
     * @param int $count The number of items to select.
     * @return array An array containing a success flag and the selected items.
     */
    public static function randomWeight($data = [], $count = 1)
    {
        $res = false;
        $selected = [];

        // validate input
        if (!empty($data) && is_array($data) && self::isValidWeightData($data)) {
            // append into distribution based on weight, if apple weight is 10 then will have 10 apple inside
            $distribution = [];
            foreach ($data as $name => $weight) {
                $distribution = array_merge($distribution, array_fill(0, $weight, $name));
            }

            // select items and shuffle everytime pick
            for ($i = 0; $i < $count; $i++) {
                shuffle($distribution);
                $selected[] = $distribution[array_rand($distribution)];
            }
        }

        if (count($selected) > 0) {
            $res = true;
        }

        return [
            "success" => $res,
            "data" => $selected,
        ];
    }

    /**
     * Check if the input array is valid for weighted random selection.
     *
     * @param array $data An associative array where keys are item names and values are weights.
     * @return bool True if all weights are integers greater than 0, false otherwise.
     */
    private static function isValidWeightData(array $data): bool
    {
        foreach ($data as $name => $weight) {
            if (!is_int($weight) || $weight <= 0) {
                return false;
            }
        }
        return true;
    }

    /**
     * Get the time left until the next minute interval.
     *
     * @param int $interval The interval in minutes.
     * @return int The time left in seconds.
     */
    public static function getCountdown($interval)
    {
        $currentHour = date("G"); // 24-hour format
        $currentMinute = date("i");

        // Convert to minutes since midnight
        $minutesSinceMidnight = ($currentHour * 60) + $currentMinute;

        // Calculate the time left until the next minute interval
        $timeLeft = date("Y-m-d H:i:00", strtotime("+" . ($interval - ($minutesSinceMidnight % $interval)) . " minutes"));
        $countdown = strtotime($timeLeft) - time();

        return $countdown;
    }

    // /**
    //  * Sends a message to a specific websocket client.
    //  *
    //  * @param string $uid  The unique identifier of the client.
    //  * @param string $type The type of the message.
    //  * @param mixed  $payload The payload to send.
    //  * @return void
    //  */
    // public static function websocketSendToClient($uid, $type, $payload)
    // {
    //     # [websocket with queue]
    //     RedisQueue::send("webSocket", [
    //         "type" => "sendToClient",
    //         "data" => [
    //             "uid" => $uid,
    //             "type" => $type,
    //             "payload" => $payload
    //         ]
    //     ]);
    // }

    // /**
    //  * Sends a message to all websocket clients.
    //  *
    //  * @param string $type The type of the message.
    //  * @param mixed  $payload The payload to send.
    //  * @return void
    //  */
    // public static function websocketSendToAll($type, $payload)
    // {
    //     # [websocket with queue]
    //     RedisQueue::send("webSocket", [
    //         "type" => "sendToAll",
    //         "data" => [
    //             "type" => $type,
    //             "payload" => $payload
    //         ]
    //     ]);
    // }

    // /**
    //  * Destroys a websocket client connection and cleans up associated records.
    //  *
    //  * @param string $uid The user ID associated with the client.
    //  * @return void
    //  */
    // public static function websocketDestroy($uid)
    // {
    //     # [websocket with queue]
    //     RedisQueue::send("webSocket", [
    //         "type" => "destoryClient",
    //         "data" => [
    //             "uid" => $uid,
    //         ]
    //     ]);
    // }
}
