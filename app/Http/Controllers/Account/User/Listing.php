<?php

namespace App\Http\Controllers\Account\User;

# library
use App\Http\Controllers\Base;
use Illuminate\Http\Request;
# database & logic
use App\Model\Database\AccountUserModel;
use App\Model\Logic\HelperLogic;

class Listing extends Base
{
    # [validation-rule]
    protected $rule = [
        "id" => "integer|max:11",
        "user_id" => "",
        "web3_address" => "min:42|max:42|alpha_num",
        "nickname" => "",
        "tag" => "",
        "status" => "in:active,inactivated,freezed,suspended",
        "remark" => "",
        "created_at_start" => "date",
        "created_at_end" => "date",
        "updated_at_start" => "date",
        "updated_at_end" => "date",
    ];

    # [inputs-pattern]
    protected $patternInputs = [
        "id",
        "user_id",
        "web3_address",
        "nickname",
        "tag",
        "authenticator",
        "status",
        "remark"
    ];

    # [outputs-pattern]
    protected $patternOutputs = [
        "id",
        "user_id",
        "web3_address",
        "nickname",
        "tag",
        "authenticator",
        "status",
        "remark",
        "created_at",
        "updated_at",
    ];

    public function index(Request $request)
    {
        # [validation]
        $this->validation($request->input(), $this->rule);

        # [clean variables]
        $cleanVars = HelperLogic::cleanParams($request->input(), $this->patternInputs);

        # [proceed]
        if (!count($this->error)) {

            # [search date range]
            $cleanVars = array_merge(
                $cleanVars,
                HelperLogic::buildDateSearch($request, ["created_at", "updated_at"])
            );

            # [listing query]
            $res = AccountUserModel::listing(
                $cleanVars,
                ["*"],
                ["id", "desc"]
            );

            # [result]
            if ($res) {
                $this->response = [
                    "success" => true,
                    "data" => HelperLogic::formatOutput($res, $this->patternOutputs, 1),
                ];
            }
        }

        # [standard output]
        return $this->output();
    }
}
