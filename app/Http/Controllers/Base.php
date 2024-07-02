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
    // lt
    // gt
    // gte
    // min (string input)
    // min_digits (numberic input)
    // max (string input)
    // max_digits (numberic input)
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

    private function reinforceRules($rules)
    {
        $maxLength = 50;
        $newRules = [];

        foreach ($rules as $field => $rulesString) {
            //default must be first
            $newRules[$field] = $rulesString;

            //add on max
            if (
                !str_contains($rulesString, "max") &&
                !str_contains($rulesString, "in")
            ) {
                if (!empty($rulesString)) {
                    $newRules[$field] .= "|";
                }

                $newRules[$field] .= "max:" . $maxLength;
            }

            //add on greater than 0
            if (
                (str_contains($rulesString, "integer") || str_contains($rulesString, "numeric"))
                && !str_contains($rulesString, "gt") && !str_contains($rulesString, "negative")
            ) {
                if (!empty($rulesString)) {
                    $newRules[$field] .= "|";
                }

                $newRules[$field] .= "gt:0";
            }

            //add on min 2 to date
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

    protected function output()
    {
        if ($this->error) {
            $this->response = [
                "success" => false,
                "data" => $this->error,
                "msg" => "error",
            ];
        }

        return HelperLogic::formatOutput($this->response);
    }

    protected function tokenError()
    {
        // for token still exist but unable to fetch user bug
        $this->response = [
            "success" => false,
            "data" => ["unauthenticated"],
            "msg" => "401"
        ];

        return HelperLogic::formatOutput($this->response);
    }
}
