<?php

declare(strict_types=1);

namespace app\model\logic;

# library
use support\Log;
use support\Request;
use support\Db;
use support\Redis;
use GatewayWorker\Lib\Gateway;
# database & logic
use app\model\database\LogApiModel;

final class HelperLogic
{
    # filter input flip internal data
    public static function safeInput($inputs, $keys)
    {
        return array_intersect_key($inputs, array_flip($keys));
    }

    # clean unuse variables
    public static function cleanParams(array $res = [], array $patternOutputs = [], bool $allowEmpty = false, array $specifiedNotEmpty = [])
    {
        $output = [];
        foreach ($res as $key => $data) {
            if (in_array($key, $patternOutputs)) {
                if ($allowEmpty || $data === "0" || !empty($data)) {
                    if (in_array($key, $specifiedNotEmpty)) {
                        if (!empty($data) || $data === "0") {
                            $output[$key] = $data;
                        }
                    } else {
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

    public static function cleanTableParams(array $res = [])
    {
        $issetFilter = [];
        foreach ($res as $key => $value) {
            if (!empty($value) || $value == "0") {
                $issetFilter[$key] = $value;
            }
        }

        return $issetFilter;
    }

    # split string by comma into array
    public static function explodeParams($res)
    {
        $res = str_replace(" ", "", trim($res));
        $array = explode(",", $res);

        return $array;
    }

    # split json into array of key and value in string comma
    public static function splitJsonParams($res)
    {
        $decoded = json_decode($res, true);
        $dataKey = [];
        $dataValue = "";
        foreach ($decoded as $key => $value) {
            $dataKey[] = $key;
            $dataValue .= $value . ",";
        }

        return [$dataKey, rtrim($dataValue, ",")];
    }

    # combine array of key and value in string comma into associative array
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

    # formating output array
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

    # generate action code
    public static function buildActionCode(string $path = "", string $method = ""): string
    {
        $target = trim(str_replace("/", "_", trim($path)), "_");
        $target = str_replace("_{id:\d+}", "_id", $target);
        $target = str_replace("_{id}", "_id", $target);

        return $method ? strtolower("{$target}@{$method}") : strtolower("{$target}");
    }

    # build date search
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

    # build attribute table
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

    # build attribute from setting general
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

    # build telegram callback data
    public static function buildTelegramCallbackData($string)
    {
        $output = [];

        // airdrop-id=1:page=2
        $initBreak = explode("-", $string);
        $output["method"] = $initBreak[0];

        if (!empty($initBreak[1])) {
            $break =  explode(":", $initBreak[1]);
            foreach ($break as $row) {
                $split = explode("=", $row);
                $output[$split[0]] = $split[1];
            }
        }

        return $output;
    }

    # build telegram pagination tab
    public static function buildTelegramPaginationTab($limitPage, $page, $size, $res, $inlineKeyboard, $prevNextTo, $backButton)
    {
        // prev and next button
        $prev = $page - 1;
        $next = $page + 1;

        // if 0 or less then empty
        $prevButton = ($prev <= 0) ? "empty" : $prevNextTo . $prev;

        // find last page
        $lastPage = ceil($res["count"] / $size);

        // limit the page to specific number
        if (!empty($limitPage)) {
            $lastPage = $lastPage > $limitPage ? $limitPage : $lastPage;
        }

        // if > last page then empty
        $nextButton = ($next > $lastPage) ? "empty" : $prevNextTo . $next;

        // the default button at below
        $defaultKeyboard = [
            [
                ["text" => "Prev", "callback_data" => $prevButton],
                ["text" => $page . "/" . $lastPage, "callback_data" => "empty"],
                ["text" => "Next", "callback_data" => $nextButton],
            ],
            $backButton
        ];

        return array_merge($inlineKeyboard, $defaultKeyboard);
    }

    # generate random keys
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

    # generate unique sn
    public static function generateUniqueSN(string $table = null, int $length = 16, string $type = "mixed-upper")
    {
        $isUnique = false;
        $sn = "";
        $column = "sn";

        // sn column name
        if ($table == "account_admin") {
            $column = "admin_id";
        } else if ($table == "account_user") {
            $column = "user_id";
        } else if ($table == "user_invite_code") {
            $column = "code";
        }

        // Loop until a unique serial number is generated
        while (!$isUnique) {
            $sn = self::randomCode($length, $type);

            $check = Db::table($table)->where($column, $sn)->first();
            if (!$check) {
                $isUnique = true;
            }
        }

        return $sn;
    }

    # encrypt ssl
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

    # decrypt ssl
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

    # api request
    public static function httpSend($method = "GET", $url = "", $data = [], $header = [])
    {
        $response = false;
        $method = strtoupper($method);
        $curl = curl_init();

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

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

        $headers = ["Content-Type: application/json"];
        if (count($header)) {
            $headers = [...$headers, ...$header];
        }
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

        $response = curl_exec($curl);
        if (curl_errno($curl)) {
            Log::error("Curl Error: " . curl_error($curl));
        }
        curl_close($curl);
        if (!empty($response)) {
            return json_decode($response, true);
        } else {
            return [];
        }
    }

    # logApiSendData
    public static function logApiSendData($method, $name, $url, $data, $refTable, $refId)
    {
        $method = strtoupper($method);
        $pending = SettingLogic::get("operator", ["category" => "status", "code" => "pending"]);
        $success = SettingLogic::get("operator", ["category" => "status", "code" => "success"]);
        $failed = SettingLogic::get("operator", ["category" => "status", "code" => "failed"]);

        # send out - only post have send out
        if ($method == "POST") {
            $sendOut = LogApiModel::log($pending["id"], "0.0.0.0", $name, $url, "send_out", $data, $refTable, $refId);
        }

        # send in
        $apiStatus = $failed["id"];
        $responseData = self::httpSend($method, $url, $data);

        // response need change according to requirement
        if (isset($responseData["status"]) && $responseData["status"] == "ok") {
            $apiStatus = $success["id"];
        }

        # update status
        if ($method == "POST") {
            LogApiModel::where("id", $sendOut["id"])->update(["status" => $apiStatus]);
        }
        LogApiModel::log(
            $apiStatus,
            "0.0.0.0",
            $name,
            $url,
            "send_in",
            $responseData,
            $method == "POST" ? "log_api" : $refTable,
            $method == "POST" ? $sendOut["id"] : $refId
        );

        return $responseData;
    }

    # random weight
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

    private static function isValidWeightData(array $data): bool
    {
        foreach ($data as $name => $weight) {
            if (!is_int($weight) || $weight <= 0) {
                return false;
            }
        }
        return true;
    }

    # countdown
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

    # websocket
    public static function websocketSendToClient($uid, $type, $data)
    {
        $clientId = Redis::get("ws_{$uid}_client_id");

        if (!empty($clientId)) {
            Gateway::sendToClient($clientId, json_encode([
                "type" => $type,
                "data" => $data
            ]));
        }
    }

    public static function websocketSendToAll($type, $data)
    {
        Gateway::sendToAll(json_encode([
            "type" => $type,
            "data" => $data
        ]));
    }

    public static function websocketDestroy($uid)
    {
        // delete old connection record in redis and websocket connection by fetching old client id first then delete both
        $oldClientId = Redis::get("ws_{$uid}_client_id");

        Redis::del("ws_{$uid}_client_id");
        if (!empty($oldClientId)) {
            Gateway::destoryClient($oldClientId);
            Redis::del("ws_{$oldClientId}_uid");
        }
    }
}
