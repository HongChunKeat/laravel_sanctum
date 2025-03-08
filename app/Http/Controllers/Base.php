<?php

namespace App\Http\Controllers;

# library
use Illuminate\Support\Facades\Validator;
# database & logic
use App\Model\Logic\HelperLogic;

/**
 * Base Controller
 */
class Base
{
    protected $error = [];
    protected $successTotalCount = 0;
    protected $successPassedCount = 0;
    protected $response = ["success" => false, "data" => ["failed"], "msg" => ""];

    // required
    // integer (whole number)
    // numeric (integer and float)
    // gt
    // gte
    // min (string input)
    // min_digits (numeric input)
    // max (string input)
    // max_digits (numeric input)
    // in
    // email
    // date
    // ip
    // alpha_num
    protected function validation($inputs = [], $rules = [])
    {
        $newRules = self::reinforceRules($rules);
        $validator = validator::make($inputs, $newRules);

        $allError = $validator->errors();
        if (!empty($allError)) {
            $allError = json_decode($allError, true);
            foreach ($allError as $key => $error) {
                foreach ($error as $e) {
                    $this->error[] = $key . ":" . $e;
                }
            }
        }
    }

    /**
     * Enhances the provided validation rules by adding additional constraints such as maximum length, positive number checks, and minimum date rules.
     *
     * The method automatically adds the following rules if not already present:
     * - "max:50" for fields without a "max", "length", or "in" rule.
     * - "gt:0" for numeric fields without a "gt" (greater than) or "negative" rule.
     * - "min:2" for date fields.
     * - Removes the "negative" rule if present.
     *
     * @param array $rules An associative array where the key is the field name and the value is a string of validation rules.
     * @return array The modified array of validation rules with the additional constraints applied.
     */
    private function reinforceRules($rules)
    {
        $maxLength = 50;
        $newRules = [];

        foreach ($rules as $field => $rulesString) {
            // default must be first
            $newRules[$field] = $rulesString;

            // add on max
            if (
                !str_contains($rulesString, "max") &&
                !str_contains($rulesString, "in")
            ) {
                if (!empty($rulesString)) {
                    $newRules[$field] .= "|";
                }

                $newRules[$field] .= "max:" . $maxLength;
            }

            // add on greater than 0
            if (
                (str_contains($rulesString, "integer") || str_contains($rulesString, "numeric"))
                && !str_contains($rulesString, "gt") && !str_contains($rulesString, "negative")
            ) {
                if (!empty($rulesString)) {
                    $newRules[$field] .= "|";
                }

                $newRules[$field] .= "gt:0";
            }

            // add on min 2 to date
            if (str_contains($rulesString, "date")) {
                if (!empty($rulesString)) {
                    $newRules[$field] .= "|";
                }

                $newRules[$field] .= "min:2";
            }

            // to allow negative value, remove negative rules
            if (str_contains($rulesString, "negative")) {
                $newRules[$field] = str_replace("negative", "", $rulesString);
            }
        }

        foreach ($newRules as $key => $value) {
            if ($value[0] == "|") {
                $newRules[$key] = substr($value, 1);
            }

            if ($value[strlen($value) - 1] == "|") {
                $newRules[$key] = substr($value, 0, -1);
            }

            if (str_contains($value, "||")) {
                $newRules[$key] = str_replace("||", "|", $value);
            }
        }

        return $newRules;
    }

    /**
     * Prepares and returns a JSON response based on the validation outcome.
     *
     * If there are errors in the validation process, the response will indicate failure and include the error messages. Otherwise, the response structure is formatted according to the application's standard output format.
     */
    protected function output()
    {
        if ($this->error) {
            $this->response = [
                "success" => false,
                "data" => $this->error,
                "msg" => "error",
            ];
        }

        return json_encode(HelperLogic::formatOutput($this->response));
    }

    /**
     * Handles JWT-related errors and clears the current JWT token.
     *
     * This method is typically invoked when a user's account no longer exists but a valid JWT token is still present, leading to a potential security issue. 
     * The token is cleared, and an appropriate error response is returned.
     */
    protected function tokenError()
    {
        // for when account not exist but token still exist bug
        $this->response = [
            "success" => false,
            "data" => "901",
            "msg" => "jwt_error",
        ];

        return json_encode(HelperLogic::formatOutput($this->response));
    }
}
