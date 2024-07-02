<?php

namespace App\Http\Controllers\Account\User;

# library
use App\Http\Controllers\Base;
use Illuminate\Http\Request;
# database & logic
use App\Model\Database\AccountUserModel;
use App\Model\Logic\HelperLogic;

class Paging extends Base
{
    # [validation-rule]
    protected $rule = [
        "size" => "required|integer",
        "page" => "required|integer",
        "id" => "integer|max_digits:11",
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

            # [paging query]
            $res = AccountUserModel::paging(
                $cleanVars,
                $request->get("page"),
                $request->get("size"),
                ["*"],
                ["id", "desc"]
            );

            # [result]
            if ($res) {
                // meta filter
                $filter = HelperLogic::cleanTableParams($cleanVars);

                $this->response = [
                    "success" => true,
                    "data" => [
                        "data" => HelperLogic::formatOutput($res["items"], $this->patternOutputs, 1),
                        "count" => $res["count"],
                        "last_page" => ceil($res["count"] / $request->get("size")),
                        "meta" => [
                            "total" => (count($filter) > 0)
                                ? AccountUserModel::where($filter)->count("id")
                                : AccountUserModel::count("id"),
                            "active" => (count($filter) > 0)
                                ? AccountUserModel::where($filter)->where("status", "active")->count("id")
                                : AccountUserModel::where("status", "active")->count("id"),
                            "inactivated" => (count($filter) > 0)
                                ? AccountUserModel::where($filter)->where("status", "inactivated")->count("id")
                                : AccountUserModel::where("status", "inactivated")->count("id"),
                            "freezed" => (count($filter) > 0)
                                ? AccountUserModel::where($filter)->where("status", "freezed")->count("id")
                                : AccountUserModel::where("status", "freezed")->count("id"),
                            "suspended" => (count($filter) > 0)
                                ? AccountUserModel::where($filter)->where("status", "suspended")->count("id")
                                : AccountUserModel::where("status", "suspended")->count("id"),
                        ]
                    ],
                ];
            }
        }

        # [standard output]
        return $this->output();
    }
}
