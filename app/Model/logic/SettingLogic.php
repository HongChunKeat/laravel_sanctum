<?php

namespace app\model\logic;

use app\model\database\SettingAirdropModel;
use app\model\database\SettingAttributeModel;
use app\model\database\SettingBlockchainNetworkModel;
use app\model\database\SettingCoinModel;
use app\model\database\SettingDepositModel;
use app\model\database\SettingGeneralModel;
use app\model\database\SettingLevelModel;
use app\model\database\SettingMissionModel;
use app\model\database\SettingNftModel;
use app\model\database\SettingOperatorModel;
use app\model\database\SettingPaymentModel;
use app\model\database\SettingWalletModel;
use app\model\database\SettingWalletAttributeModel;
use app\model\database\SettingWithdrawModel;

class SettingLogic
{
    public static function get(string $table = "", array $params = [], bool $list = false)
    {
        $_response = false;

        switch ($table) {
            case "airdrop":
                $_response = SettingAirdropModel::where($params);
                break;
            case "attribute":
                $_response = SettingAttributeModel::where($params);
                break;
            case "blockchain_network":
                $_response = SettingBlockchainNetworkModel::where($params);
                break;
            case "coin":
                $_response = SettingCoinModel::where($params);
                break;
            case "deposit":
                $_response = SettingDepositModel::where($params);
                break;
            case "general":
                $_response = SettingGeneralModel::where($params)->where("is_show", 1);
                break;
            case "level":
                $_response = SettingLevelModel::where($params);
                break;
            case "mission":
                $_response = SettingMissionModel::where($params);
                break;
            case "nft":
                $_response = SettingNftModel::where($params);
                break;
            case "operator":
                $_response = SettingOperatorModel::where($params);
                break;
            case "payment":
                $_response = SettingPaymentModel::where($params);
                break;
            case "wallet":
                $_response = SettingWalletModel::where($params);
                break;
            case "wallet_attribute":
                $_response = SettingWalletAttributeModel::where($params);
                break;
            case "withdraw":
                $_response = SettingWithdrawModel::where($params);
                break;
        }

        if ($_response) {
            if ($list) {
                $_response = $_response->get();
            } else {
                $_response = $_response->first();
            }
        }

        return $_response;
    }

    public static function getDeposit(array $params = [])
    {
        $_response = false;

        $_response = SettingDepositModel::where($params)
            ->inRandomOrder()
            ->first();

        return $_response;
    }

    public static function getWithdraw(array $params = [])
    {
        $_response = false;

        $_response = SettingWithdrawModel::where($params)
            ->inRandomOrder()
            ->first();

        return $_response;
    }
}
