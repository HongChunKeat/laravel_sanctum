<?php

namespace App\Model\Logic;

use App\Model\Database\SettingAttributeModel;
use App\Model\Database\SettingBlockchainNetworkModel;
use App\Model\Database\SettingCoinModel;
use App\Model\Database\SettingDepositModel;
use App\Model\Database\SettingGeneralModel;
use App\Model\Database\SettingNftModel;
use App\Model\Database\SettingOperatorModel;
use App\Model\Database\SettingPaymentModel;
use App\Model\Database\SettingWalletModel;
use App\Model\Database\SettingWalletAttributeModel;
use App\Model\Database\SettingWithdrawModel;

class SettingLogic
{
    public static function get(string $table = "", array $params = [], bool $list = false)
    {
        $_response = false;

        switch ($table) {
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
