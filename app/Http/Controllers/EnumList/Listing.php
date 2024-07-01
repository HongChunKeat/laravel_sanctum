<?php

namespace App\Http\Controllers\EnumList;

# library
use Illuminate\Http\Request;
use App\Http\Controllers\Base;
# database & logic
use App\Model\Database\SettingOperatorModel;
use App\Model\Database\SettingCoinModel;
use App\Model\Database\SettingWalletModel;
use App\Model\Database\SettingBlockchainNetworkModel;
use App\Model\Database\SettingAttributeModel;
use App\Model\Database\PermissionTemplateModel;
use App\Model\Logic\HelperLogic;

class Listing extends Base
{
    # [validation-rule]
    protected $rule = [
        "type" => "required|max:80"
    ];

    # [inputs-pattern]
    protected $patternInputs = ["type"];

    public function index(Request $request)
    {
        # [validation]
        $this->validation($request->input(), $this->rule);

        # [clean variables]
        $cleanVars = HelperLogic::cleanParams($request->input(), $this->patternInputs);

        # [proceed]
        if (!count($this->error)) {
            $res = "";

            // filter by type
            switch ($cleanVars["type"]) {
                case "yes_no":
                    $res = [
                        "1" => "yes",
                        "0" => "no",
                    ];
                    break;

                case "active_status":
                    $res = [
                        "1" => "active",
                        "0" => "inactive",
                    ];
                    break;

                case "account_status":
                    $res = [
                        "active" => "active",
                        "inactivated" => "inactivated",
                        "freezed" => "freezed",
                        "suspended" => "suspended"
                    ];
                    break;

                case "permission_action":
                    $res = [
                        "POST" => "POST",
                        "GET" => "GET",
                        "PUT" => "PUT",
                        "DELETE" => "DELETE",
                        "PATCH" => "PATCH",
                    ];
                    break;

                case "payment_formula":
                    $res = [
                        "equal" => "equal",
                        "min" => "min",
                        "max" => "max",
                    ];
                    break;

                case "admin_role":
                    $res = [];
                    $settings = PermissionTemplateModel::select("id", "template_code")->get();

                    foreach ($settings as $setting) {
                        $res[$setting["id"]] = $setting["template_code"];
                    }
                    break;

                case "user_deposit_status":
                    $res = [];
                    $settings = SettingOperatorModel::select("id", "code")
                        ->where("category", "status")
                        ->whereIn("code", ["success", "failed"])
                        ->get();

                    foreach ($settings as $setting) {
                        $res[$setting["id"]] = $setting["code"];
                    }
                    break;

                case "user_withdraw_status":
                    $res = [];
                    $settings = SettingOperatorModel::select("id", "code")
                        ->where("category", "status")
                        ->whereIn("code", ["pending", "accepted", "rejected", "processing", "success", "failed"])
                        ->get();

                    foreach ($settings as $setting) {
                        $res[$setting["id"]] = $setting["code"];
                    }
                    break;

                case "user_nft_status":
                    $res = [];
                    $settings = SettingOperatorModel::select("id", "code")
                        ->where("category", "status")
                        ->whereIn("code", ["processing", "success", "failed"])
                        ->get();

                    foreach ($settings as $setting) {
                        $res[$setting["id"]] = $setting["code"];
                    }
                    break;

                case "operator_status":
                    $res = [];
                    $settings = SettingOperatorModel::select("id", "code")
                        ->where("category", "status")
                        ->get();

                    foreach ($settings as $setting) {
                        $res[$setting["id"]] = $setting["code"];
                    }
                    break;

                case "operator_type":
                    $res = [];
                    $settings = SettingOperatorModel::select("id", "code")
                        ->where("category", "type")
                        ->get();

                    foreach ($settings as $setting) {
                        $res[$setting["id"]] = $setting["code"];
                    }
                    break;

                case "operator_reward":
                    $res = [];
                    $settings = SettingOperatorModel::select("id", "code")
                        ->where("category", "reward")
                        ->get();

                    foreach ($settings as $setting) {
                        $res[$setting["id"]] = $setting["code"];
                    }
                    break;

                case "operator_deposit":
                    $res = [];
                    $settings = SettingOperatorModel::select("id", "code")
                        ->whereIn("code", ["admin_top_up", "admin_deduct", "top_up", "deduct"])
                        ->get();

                    foreach ($settings as $setting) {
                        $res[$setting["id"]] = $setting["code"];
                    }
                    break;

                case "transaction_type":
                    $res = [];
                    $settings = SettingOperatorModel::select("id", "code")
                        ->whereIn("category", ["type", "reward"])
                        ->get();

                    foreach ($settings as $setting) {
                        $res[$setting["id"]] = $setting["code"];
                    }
                    break;

                case "attribute_wallet":
                    $res = [];
                    $settings = SettingAttributeModel::where("filter", "wallet")
                        ->select("id", "code")
                        ->get();

                    foreach ($settings as $setting) {
                        $res[$setting["id"]] = $setting["code"];
                    }
                    break;

                case "attribute":
                    $res = [];
                    $settings = SettingAttributeModel::select("id", "code")->get();

                    foreach ($settings as $setting) {
                        $res[$setting["id"]] = $setting["code"];
                    }
                    break;

                case "network":
                    $res = [];
                    $settings = SettingBlockchainNetworkModel::select("id", "code")->get();

                    foreach ($settings as $setting) {
                        $res[$setting["id"]] = $setting["code"];
                    }
                    break;

                case "coin":
                    $res = [];
                    $settings = SettingCoinModel::select("id", "code")->get();

                    foreach ($settings as $setting) {
                        $res[$setting["id"]] = $setting["code"];
                    }
                    break;

                case "wallet":
                    $res = [];
                    $settings = SettingWalletModel::select("id", "code")->get();

                    foreach ($settings as $setting) {
                        $res[$setting["id"]] = $setting["code"];
                    }
                    break;

                default:
                    // handle default case if needed
                    break;
            }

            # [result]
            if ($res) {
                $this->response = [
                    "success" => true,
                    "data" => $res,
                ];
            }
        }

        # [standard output]
        return $this->output();
    }
}
