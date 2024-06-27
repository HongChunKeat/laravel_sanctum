<?php

declare(strict_types=1);

namespace App\Model\Logic;

use Illuminate\Support\Facades\Log;
use Web3\Contract;
use Web3\Providers\HttpProvider;
use Web3\Utils;
use Web3\Web3;
use Elliptic\EC;
use kornrunner\Ethereum\Transaction;
use kornrunner\Keccak;

# https://www.quicknode.com/docs/ethereum
final class EvmLogic
{
    private static function abi()
    {
        return '[{"inputs":[],"payable":false,"stateMutability":"nonpayable","type":"constructor"},{"anonymous":false,"inputs":[{"indexed":true,"internalType":"address","name":"owner","type":"address"},{"indexed":true,"internalType":"address","name":"spender","type":"address"},{"indexed":false,"internalType":"uint256","name":"value","type":"uint256"}],"name":"Approval","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"internalType":"address","name":"previousOwner","type":"address"},{"indexed":true,"internalType":"address","name":"newOwner","type":"address"}],"name":"OwnershipTransferred","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"internalType":"address","name":"from","type":"address"},{"indexed":true,"internalType":"address","name":"to","type":"address"},{"indexed":false,"internalType":"uint256","name":"value","type":"uint256"}],"name":"Transfer","type":"event"},{"constant":true,"inputs":[],"name":"_decimals","outputs":[{"internalType":"uint8","name":"","type":"uint8"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"_name","outputs":[{"internalType":"string","name":"","type":"string"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"_symbol","outputs":[{"internalType":"string","name":"","type":"string"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[{"internalType":"address","name":"owner","type":"address"},{"internalType":"address","name":"spender","type":"address"}],"name":"allowance","outputs":[{"internalType":"uint256","name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"internalType":"address","name":"spender","type":"address"},{"internalType":"uint256","name":"amount","type":"uint256"}],"name":"approve","outputs":[{"internalType":"bool","name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[{"internalType":"address","name":"account","type":"address"}],"name":"balanceOf","outputs":[{"internalType":"uint256","name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"decimals","outputs":[{"internalType":"uint256","name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"internalType":"address","name":"spender","type":"address"},{"internalType":"uint256","name":"subtractedValue","type":"uint256"}],"name":"decreaseAllowance","outputs":[{"internalType":"bool","name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[],"name":"getOwner","outputs":[{"internalType":"address","name":"","type":"address"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"internalType":"address","name":"spender","type":"address"},{"internalType":"uint256","name":"addedValue","type":"uint256"}],"name":"increaseAllowance","outputs":[{"internalType":"bool","name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"internalType":"uint256","name":"amount","type":"uint256"}],"name":"mint","outputs":[{"internalType":"bool","name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[],"name":"name","outputs":[{"internalType":"string","name":"","type":"string"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"owner","outputs":[{"internalType":"address","name":"","type":"address"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[],"name":"renounceOwnership","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[],"name":"symbol","outputs":[{"internalType":"string","name":"","type":"string"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"totalSupply","outputs":[{"internalType":"uint256","name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"internalType":"address","name":"recipient","type":"address"},{"internalType":"uint256","name":"amount","type":"uint256"}],"name":"transfer","outputs":[{"internalType":"bool","name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"internalType":"address","name":"sender","type":"address"},{"internalType":"address","name":"recipient","type":"address"},{"internalType":"uint256","name":"amount","type":"uint256"}],"name":"transferFrom","outputs":[{"internalType":"bool","name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"internalType":"address","name":"newOwner","type":"address"}],"name":"transferOwnership","outputs":[],"payable":false,"stateMutability":"nonpayable","type":"function"}]';
    }

    private static function nftAbi()
    {
        return '[{"inputs":[],"stateMutability":"nonpayable","type":"constructor"},{"inputs":[],"name":"AccessControlBadConfirmation","type":"error"},{"inputs":[{"internalType":"address","name":"account","type":"address"},{"internalType":"bytes32","name":"neededRole","type":"bytes32"}],"name":"AccessControlUnauthorizedAccount","type":"error"},{"inputs":[],"name":"ApprovalCallerNotOwnerNorApproved","type":"error"},{"inputs":[],"name":"ApprovalQueryForNonexistentToken","type":"error"},{"inputs":[],"name":"BalanceQueryForZeroAddress","type":"error"},{"inputs":[],"name":"ECDSAInvalidSignature","type":"error"},{"inputs":[{"internalType":"uint256","name":"length","type":"uint256"}],"name":"ECDSAInvalidSignatureLength","type":"error"},{"inputs":[{"internalType":"bytes32","name":"s","type":"bytes32"}],"name":"ECDSAInvalidSignatureS","type":"error"},{"inputs":[],"name":"EnforcedPause","type":"error"},{"inputs":[],"name":"ExpectedPause","type":"error"},{"inputs":[],"name":"InvalidInitialization","type":"error"},{"inputs":[],"name":"InvalidQueryRange","type":"error"},{"inputs":[],"name":"InvalidSignature","type":"error"},{"inputs":[],"name":"MintERC2309QuantityExceedsLimit","type":"error"},{"inputs":[],"name":"MintToZeroAddress","type":"error"},{"inputs":[],"name":"MintZeroQuantity","type":"error"},{"inputs":[],"name":"NotCompatibleWithSpotMints","type":"error"},{"inputs":[],"name":"NotInitializing","type":"error"},{"inputs":[],"name":"OwnerQueryForNonexistentToken","type":"error"},{"inputs":[],"name":"OwnershipNotInitializedForExtraData","type":"error"},{"inputs":[],"name":"ReentrancyGuardReentrantCall","type":"error"},{"inputs":[],"name":"SequentialMintExceedsLimit","type":"error"},{"inputs":[],"name":"SequentialUpToTooSmall","type":"error"},{"inputs":[{"internalType":"bytes","name":"signature","type":"bytes"}],"name":"SignatureAlreadyClaimed","type":"error"},{"inputs":[],"name":"SpotMintTokenIdTooSmall","type":"error"},{"inputs":[{"internalType":"uint256","name":"value","type":"uint256"},{"internalType":"uint256","name":"length","type":"uint256"}],"name":"StringsInsufficientHexLength","type":"error"},{"inputs":[{"internalType":"address","name":"nftAddress","type":"address"},{"internalType":"uint256","name":"nftTokenId","type":"uint256"}],"name":"TokenAlreadyClaimed","type":"error"},{"inputs":[],"name":"TokenAlreadyExists","type":"error"},{"inputs":[],"name":"TransferCallerNotOwnerNorApproved","type":"error"},{"inputs":[],"name":"TransferFromIncorrectOwner","type":"error"},{"inputs":[],"name":"TransferToNonERC721ReceiverImplementer","type":"error"},{"inputs":[],"name":"TransferToZeroAddress","type":"error"},{"inputs":[],"name":"URIQueryForNonexistentToken","type":"error"},{"inputs":[{"internalType":"address","name":"user","type":"address"}],"name":"UserAlreadyClaimedOrPurchased","type":"error"},{"anonymous":false,"inputs":[{"indexed":true,"internalType":"address","name":"owner","type":"address"},{"indexed":true,"internalType":"address","name":"approved","type":"address"},{"indexed":true,"internalType":"uint256","name":"tokenId","type":"uint256"}],"name":"Approval","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"internalType":"address","name":"owner","type":"address"},{"indexed":true,"internalType":"address","name":"operator","type":"address"},{"indexed":false,"internalType":"bool","name":"approved","type":"bool"}],"name":"ApprovalForAll","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"internalType":"uint256","name":"fromTokenId","type":"uint256"},{"indexed":false,"internalType":"uint256","name":"toTokenId","type":"uint256"},{"indexed":true,"internalType":"address","name":"from","type":"address"},{"indexed":true,"internalType":"address","name":"to","type":"address"}],"name":"ConsecutiveTransfer","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"internalType":"address","name":"from","type":"address"},{"indexed":false,"internalType":"uint256","name":"tokenId","type":"uint256"}],"name":"EvolveSeedToTree","type":"event"},{"anonymous":false,"inputs":[{"indexed":false,"internalType":"uint64","name":"version","type":"uint64"}],"name":"Initialized","type":"event"},{"anonymous":false,"inputs":[{"indexed":false,"internalType":"address","name":"account","type":"address"}],"name":"Paused","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"internalType":"bytes32","name":"role","type":"bytes32"},{"indexed":true,"internalType":"bytes32","name":"previousAdminRole","type":"bytes32"},{"indexed":true,"internalType":"bytes32","name":"newAdminRole","type":"bytes32"}],"name":"RoleAdminChanged","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"internalType":"bytes32","name":"role","type":"bytes32"},{"indexed":true,"internalType":"address","name":"account","type":"address"},{"indexed":true,"internalType":"address","name":"sender","type":"address"}],"name":"RoleGranted","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"internalType":"bytes32","name":"role","type":"bytes32"},{"indexed":true,"internalType":"address","name":"account","type":"address"},{"indexed":true,"internalType":"address","name":"sender","type":"address"}],"name":"RoleRevoked","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"internalType":"address","name":"from","type":"address"},{"indexed":true,"internalType":"address","name":"to","type":"address"},{"indexed":true,"internalType":"uint256","name":"tokenId","type":"uint256"}],"name":"Transfer","type":"event"},{"anonymous":false,"inputs":[{"indexed":false,"internalType":"address","name":"account","type":"address"}],"name":"Unpaused","type":"event"},{"inputs":[],"name":"ADMIN_ROLE","outputs":[{"internalType":"bytes32","name":"","type":"bytes32"}],"stateMutability":"view","type":"function"},{"inputs":[],"name":"DEFAULT_ADMIN_ROLE","outputs":[{"internalType":"bytes32","name":"","type":"bytes32"}],"stateMutability":"view","type":"function"},{"inputs":[],"name":"MINTER_ROLE","outputs":[{"internalType":"bytes32","name":"","type":"bytes32"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"address","name":"to","type":"address"},{"internalType":"uint256","name":"tokenId","type":"uint256"}],"name":"approve","outputs":[],"stateMutability":"payable","type":"function"},{"inputs":[{"internalType":"address","name":"owner","type":"address"}],"name":"balanceOf","outputs":[{"internalType":"uint256","name":"","type":"uint256"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"uint256","name":"tokenId","type":"uint256"}],"name":"burn","outputs":[],"stateMutability":"nonpayable","type":"function"},{"inputs":[{"internalType":"bytes","name":"validationSignature","type":"bytes"},{"internalType":"address","name":"claimedNftAddress","type":"address"},{"internalType":"uint256","name":"claimedNftTokenId","type":"uint256"}],"name":"claimSeed","outputs":[],"stateMutability":"nonpayable","type":"function"},{"inputs":[{"internalType":"uint256","name":"tokenId","type":"uint256"}],"name":"evolveSeedToTree","outputs":[],"stateMutability":"nonpayable","type":"function"},{"inputs":[{"internalType":"uint256","name":"tokenId","type":"uint256"}],"name":"explicitOwnershipOf","outputs":[{"components":[{"internalType":"address","name":"addr","type":"address"},{"internalType":"uint64","name":"startTimestamp","type":"uint64"},{"internalType":"bool","name":"burned","type":"bool"},{"internalType":"uint24","name":"extraData","type":"uint24"}],"internalType":"struct IERC721AUpgradeable.TokenOwnership","name":"ownership","type":"tuple"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"uint256[]","name":"tokenIds","type":"uint256[]"}],"name":"explicitOwnershipsOf","outputs":[{"components":[{"internalType":"address","name":"addr","type":"address"},{"internalType":"uint64","name":"startTimestamp","type":"uint64"},{"internalType":"bool","name":"burned","type":"bool"},{"internalType":"uint24","name":"extraData","type":"uint24"}],"internalType":"struct IERC721AUpgradeable.TokenOwnership[]","name":"","type":"tuple[]"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"uint256","name":"tokenId","type":"uint256"}],"name":"getApproved","outputs":[{"internalType":"address","name":"","type":"address"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"bytes32","name":"role","type":"bytes32"}],"name":"getRoleAdmin","outputs":[{"internalType":"bytes32","name":"","type":"bytes32"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"bytes32","name":"role","type":"bytes32"},{"internalType":"address","name":"account","type":"address"}],"name":"grantRole","outputs":[],"stateMutability":"nonpayable","type":"function"},{"inputs":[{"internalType":"bytes32","name":"role","type":"bytes32"},{"internalType":"address","name":"account","type":"address"}],"name":"hasRole","outputs":[{"internalType":"bool","name":"","type":"bool"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"address","name":"_genesisNft","type":"address"},{"internalType":"address","name":"_gen2Nft","type":"address"},{"internalType":"contract IPortionNFT","name":"_portionNft","type":"address"},{"internalType":"address","name":"_signer","type":"address"}],"name":"initialize","outputs":[],"stateMutability":"nonpayable","type":"function"},{"inputs":[{"internalType":"address","name":"owner","type":"address"},{"internalType":"address","name":"operator","type":"address"}],"name":"isApprovedForAll","outputs":[{"internalType":"bool","name":"","type":"bool"}],"stateMutability":"view","type":"function"},{"inputs":[],"name":"name","outputs":[{"internalType":"string","name":"","type":"string"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"uint256","name":"","type":"uint256"}],"name":"nftType","outputs":[{"internalType":"enum TreeNFT.NftType","name":"","type":"uint8"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"uint256","name":"tokenId","type":"uint256"}],"name":"ownerOf","outputs":[{"internalType":"address","name":"","type":"address"}],"stateMutability":"view","type":"function"},{"inputs":[],"name":"pause","outputs":[],"stateMutability":"nonpayable","type":"function"},{"inputs":[],"name":"paused","outputs":[{"internalType":"bool","name":"","type":"bool"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"bytes32","name":"role","type":"bytes32"},{"internalType":"address","name":"callerConfirmation","type":"address"}],"name":"renounceRole","outputs":[],"stateMutability":"nonpayable","type":"function"},{"inputs":[{"internalType":"bytes32","name":"role","type":"bytes32"},{"internalType":"address","name":"account","type":"address"}],"name":"revokeRole","outputs":[],"stateMutability":"nonpayable","type":"function"},{"inputs":[{"internalType":"address","name":"from","type":"address"},{"internalType":"address","name":"to","type":"address"},{"internalType":"uint256","name":"tokenId","type":"uint256"}],"name":"safeTransferFrom","outputs":[],"stateMutability":"payable","type":"function"},{"inputs":[{"internalType":"address","name":"from","type":"address"},{"internalType":"address","name":"to","type":"address"},{"internalType":"uint256","name":"tokenId","type":"uint256"},{"internalType":"bytes","name":"_data","type":"bytes"}],"name":"safeTransferFrom","outputs":[],"stateMutability":"payable","type":"function"},{"inputs":[{"internalType":"address","name":"operator","type":"address"},{"internalType":"bool","name":"approved","type":"bool"}],"name":"setApprovalForAll","outputs":[],"stateMutability":"nonpayable","type":"function"},{"inputs":[{"internalType":"string","name":"baseURI","type":"string"}],"name":"setBaseURI","outputs":[],"stateMutability":"nonpayable","type":"function"},{"inputs":[{"internalType":"uint256","name":"tokenId","type":"uint256"},{"internalType":"string","name":"_tokenURI","type":"string"}],"name":"setCustomTokenURI","outputs":[],"stateMutability":"nonpayable","type":"function"},{"inputs":[{"internalType":"bytes4","name":"interfaceId","type":"bytes4"}],"name":"supportsInterface","outputs":[{"internalType":"bool","name":"","type":"bool"}],"stateMutability":"view","type":"function"},{"inputs":[],"name":"symbol","outputs":[{"internalType":"string","name":"","type":"string"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"uint256","name":"tokenId","type":"uint256"}],"name":"tokenURI","outputs":[{"internalType":"string","name":"","type":"string"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"address","name":"owner","type":"address"}],"name":"tokensOfOwner","outputs":[{"internalType":"uint256[]","name":"","type":"uint256[]"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"address","name":"owner","type":"address"},{"internalType":"uint256","name":"start","type":"uint256"},{"internalType":"uint256","name":"stop","type":"uint256"}],"name":"tokensOfOwnerIn","outputs":[{"internalType":"uint256[]","name":"","type":"uint256[]"}],"stateMutability":"view","type":"function"},{"inputs":[],"name":"totalSupply","outputs":[{"internalType":"uint256","name":"result","type":"uint256"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"address","name":"from","type":"address"},{"internalType":"address","name":"to","type":"address"},{"internalType":"uint256","name":"tokenId","type":"uint256"}],"name":"transferFrom","outputs":[],"stateMutability":"payable","type":"function"},{"inputs":[],"name":"unpause","outputs":[],"stateMutability":"nonpayable","type":"function"}]';
    }

    private static function treeValidatorAbi()
    {
        return '[{"inputs":[],"stateMutability":"nonpayable","type":"constructor"},{"inputs":[],"name":"AccessControlBadConfirmation","type":"error"},{"inputs":[{"internalType":"address","name":"account","type":"address"},{"internalType":"bytes32","name":"neededRole","type":"bytes32"}],"name":"AccessControlUnauthorizedAccount","type":"error"},{"inputs":[{"internalType":"address","name":"caller","type":"address"}],"name":"CallerNotSignerAddress","type":"error"},{"inputs":[{"internalType":"address","name":"nftAddress","type":"address"}],"name":"InvalidClaimedNftAddress","type":"error"},{"inputs":[],"name":"InvalidInitialization","type":"error"},{"inputs":[],"name":"NotInitializing","type":"error"},{"inputs":[],"name":"ReentrancyGuardReentrantCall","type":"error"},{"inputs":[{"internalType":"uint256","name":"value","type":"uint256"},{"internalType":"uint256","name":"length","type":"uint256"}],"name":"StringsInsufficientHexLength","type":"error"},{"inputs":[{"internalType":"address","name":"nftAddress","type":"address"},{"internalType":"uint256","name":"nftTokenId","type":"uint256"}],"name":"UserNotOwnerOfNft","type":"error"},{"anonymous":false,"inputs":[{"indexed":false,"internalType":"uint64","name":"version","type":"uint64"}],"name":"Initialized","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"internalType":"bytes32","name":"role","type":"bytes32"},{"indexed":true,"internalType":"bytes32","name":"previousAdminRole","type":"bytes32"},{"indexed":true,"internalType":"bytes32","name":"newAdminRole","type":"bytes32"}],"name":"RoleAdminChanged","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"internalType":"bytes32","name":"role","type":"bytes32"},{"indexed":true,"internalType":"address","name":"account","type":"address"},{"indexed":true,"internalType":"address","name":"sender","type":"address"}],"name":"RoleGranted","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"internalType":"bytes32","name":"role","type":"bytes32"},{"indexed":true,"internalType":"address","name":"account","type":"address"},{"indexed":true,"internalType":"address","name":"sender","type":"address"}],"name":"RoleRevoked","type":"event"},{"inputs":[],"name":"DEFAULT_ADMIN_ROLE","outputs":[{"internalType":"bytes32","name":"","type":"bytes32"}],"stateMutability":"view","type":"function"},{"inputs":[],"name":"gen2Nft","outputs":[{"internalType":"address","name":"","type":"address"}],"stateMutability":"view","type":"function"},{"inputs":[],"name":"genesisNft","outputs":[{"internalType":"address","name":"","type":"address"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"bytes32","name":"role","type":"bytes32"}],"name":"getRoleAdmin","outputs":[{"internalType":"bytes32","name":"","type":"bytes32"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"bytes32","name":"role","type":"bytes32"},{"internalType":"address","name":"account","type":"address"}],"name":"grantRole","outputs":[],"stateMutability":"nonpayable","type":"function"},{"inputs":[{"internalType":"bytes32","name":"role","type":"bytes32"},{"internalType":"address","name":"account","type":"address"}],"name":"hasRole","outputs":[{"internalType":"bool","name":"","type":"bool"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"address","name":"_genesisNft","type":"address"},{"internalType":"address","name":"_gen2Nft","type":"address"}],"name":"initialize","outputs":[],"stateMutability":"nonpayable","type":"function"},{"inputs":[{"internalType":"bytes32","name":"role","type":"bytes32"},{"internalType":"address","name":"callerConfirmation","type":"address"}],"name":"renounceRole","outputs":[],"stateMutability":"nonpayable","type":"function"},{"inputs":[{"internalType":"bytes32","name":"role","type":"bytes32"},{"internalType":"address","name":"account","type":"address"}],"name":"revokeRole","outputs":[],"stateMutability":"nonpayable","type":"function"},{"inputs":[{"internalType":"bytes4","name":"interfaceId","type":"bytes4"}],"name":"supportsInterface","outputs":[{"internalType":"bool","name":"","type":"bool"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"address","name":"userToClaim","type":"address"},{"internalType":"address","name":"claimedNftAddress","type":"address"},{"internalType":"uint256","name":"claimedNftTokenId","type":"uint256"}],"name":"validateGenesisNft","outputs":[{"internalType":"string","name":"","type":"string"}],"stateMutability":"view","type":"function"}]';
    }

    # convert hex decimal value to decimal
    public static function hexdecimalToDecimal(string $hexValue = "", int $decimalPlaces = 18)
    {
        list($bnq, $bnr) = Utils::fromWei(Utils::toBn($hexValue), "ether");
        return $bnq->toString() . "." . str_pad($bnr->toString(), $decimalPlaces, "0", STR_PAD_LEFT);
    }

    # get decimal of the token address / contract
    public static function getDecimals(string $rpcUrl, string $tokenAddress)
    {
        $web3 = new Web3(new HttpProvider($rpcUrl, 2));
        $contract = new Contract($web3->provider, self::abi());

        $decimal = 0;
        $contract->at($tokenAddress)->call("decimals", function ($err, $data) use (&$decimal) {
            if (!is_null($err)) {
                Log::error("getDecimals err", ["err" => $err]);
            } else {
                $decimal = (int) $data[0]->toString();
            }
        });

        return $decimal;
    }

    # default function - get balance of address in that contract (for token and ERC-721 nft only)
    # if token: count balance
    # if nft: ERC-721 (count number of nft)
    public static function balanceOf(string $type, string $rpcUrl, string $tokenAddress, string $address)
    {
        $web3 = new Web3(new HttpProvider($rpcUrl, 2));
        $contract = new Contract(
            $web3->provider,
            $type == "token"
                ? self::abi()
                : self::nftAbi()
        );

        $balance = 0;
        $contract->at($tokenAddress)->call("balanceOf", $address, function ($err, $data) use (&$type, &$balance) {
            if (!is_null($err)) {
                Log::error("balanceOf err", ["err" => $err]);
            } else {
                $value = gmp_strval($data[0]->value);
                if ($type == "token") {
                    $balance = self::hexdecimalToDecimal($value);
                } else if ($type == "nft") {
                    $balance = $value;
                }
            }
        });

        return $balance;
    }

    # custom function - get nft token_id in array - this function is based on azuki contract
    public static function tokensOfOwner(string $rpcUrl, string $tokenAddress, string $address)
    {
        $web3 = new Web3(new HttpProvider($rpcUrl, 2));
        $contract = new Contract($web3->provider, self::nftAbi());

        $res = [];
        $contract->at($tokenAddress)->call("tokensOfOwner", $address, function ($err, $data) use (&$res) {
            if (!is_null($err)) {
                Log::error("tokensOfOwner err", ["err" => $err]);
            } else {
                $array = [];
                foreach ($data[0] as $row) {
                    $array[] = gmp_strval($row->value);
                }
                $res = $array;
            }
        });

        return $res;
    }

    # custom function - check is tree
    public static function isTree(string $rpcUrl, string $tokenAddress, int $tokenId)
    {
        $web3 = new Web3(new HttpProvider($rpcUrl, 2));
        $contract = new Contract($web3->provider, self::nftAbi());

        $res = 0;
        $contract->at($tokenAddress)->call("nftType", $tokenId, function ($err, $data) use (&$res) {
            if (!is_null($err)) {
                Log::error("nftType err", ["err" => $err]);
            } else {
                $res = gmp_strval($data[0]->value);
            }
        });

        return $res;
    }

    # custom function - validate genesis nft for claim seed
    public static function validateGenesisNft(string $rpcUrl, string $tokenAddress, string $address, string $nftAddress, int $tokenId)
    {
        $web3 = new Web3(new HttpProvider($rpcUrl, 2));
        $contract = new Contract($web3->provider, self::treeValidatorAbi());

        $res = false;
        $contract->at($tokenAddress)->call("validateGenesisNft", $address, $nftAddress, $tokenId, function ($err, $data) use (&$res) {
            if (!is_null($err)) {
                Log::error("nftType err", ["err" => $err]);
            } else {
                $res = true;
            }
        });

        return $res;
    }

    # get current block number of the rpc
    public static function getBlockNumber(string $rpcUrl)
    {
        $web3 = new Web3(new HttpProvider($rpcUrl, 2));

        $block = 0;
        $web3->eth->blockNumber(function ($err, $data) use (&$block) {
            if (!is_null($err)) {
                Log::error("blockNumber err", ["err" => $err]);
            } else {
                $block = (int) $data->toString();
            }
        });

        return $block;
    }

    # get transaction info of the txid - no log but have more info
    public static function getTransactionByHash(string $rpcUrl, string $txid)
    {
        $web3 = new Web3(new HttpProvider($rpcUrl, 2));

        $ret = [];
        $web3->eth->getTransactionByHash($txid, function ($err, $data) use (&$ret) {
            if (!is_null($err)) {
                Log::error("getTransactionByHash err", ["err" => $err]);
            } else {
                $ret = json_decode(json_encode($data, 1), true);
            }
        });

        return $ret;
    }

    # get transaction info of the txid - with log but less info
    public static function getTransactionReceipt(string $rpcUrl, string $txid)
    {
        $web3 = new Web3(new HttpProvider($rpcUrl, 2));

        $ret = [];
        $web3->eth->getTransactionReceipt($txid, function ($err, $data) use (&$ret) {
            if (!is_null($err)) {
                Log::error("getTransactionReceipt err", ["err" => $err]);
            } else {
                $ret = json_decode(json_encode($data, 1), true);
            }
        });

        return $ret;
    }

    # decode transaction info
    public static function decodeTransaction($receipt, $index)
    {
        return [
            "tokenAddress" => $receipt["logs"][$index]["address"],
            "event" => $receipt["logs"][$index]["topics"][0],
            "fromAddress" => !empty($receipt["logs"][$index]["topics"][1])
                ? strtolower(str_replace("0x000000000000000000000000", "0x", $receipt["logs"][$index]["topics"][1]))
                : null,
            "toAddress" => !empty($receipt["logs"][$index]["topics"][2])
                ? strtolower(str_replace("0x000000000000000000000000", "0x", $receipt["logs"][$index]["topics"][2]))
                : null,
            "tokenId" => !empty($receipt["logs"][$index]["topics"][3])
                ? hexdec($receipt["logs"][$index]["topics"][3])
                : null,
            "amount" => self::hexdecimalToDecimal($receipt["logs"][$index]["data"]),
            "logIndex" => $receipt["logs"][$index]["logIndex"],
        ];
    }

    # send to chain and return txid (withdraw)
    public static function transfer($rpcUrl, $chainId, $amount, $tokenAddress, $fromAddress, $privateKey, $toAddress)
    {
        $success = 0;
        $transactionHash = "";

        //check it is main coin or not
        $mainCoin = $tokenAddress ? false : true;
        $amount = Utils::toHex($amount, true);
        $web3 = new Web3(new HttpProvider($rpcUrl, 2));
        $eth = $web3->eth;
        $contract = new Contract($web3->provider, self::abi());
        $nonce = 0;

        $web3->eth->getTransactionCount($fromAddress, "pending", function ($err, $result) use (&$nonce, &$success) {
            if (!is_null($err)) {
                Log::error("transaction count error: " . $err->getMessage());
            } else {
                $nonce = gmp_intval($result->value);
                $success++;
            }
        });

        $gasPrice = 0;
        $eth->gasPrice(function ($err, $result) use (&$gasPrice, &$success) {
            if (!is_null($err)) {
                Log::error("gas price error: " . $err->getMessage());
            } else {
                $gasPrice = gmp_intval($result->value);
                $success++;
            }
        });

        $params = [
            "nonce" => $nonce,
            "from" => $fromAddress,
            "to" => $mainCoin ? $toAddress : $tokenAddress,
        ];

        if (!$mainCoin) {
            $data = $contract->at($tokenAddress)->getData("transfer", $toAddress, $amount);
            $params["data"] = $data;
        }

        $es = null;
        if ($mainCoin) {
            $es = "21000";
            $success++;
        } else {
            $contract
                ->at($tokenAddress)
                ->estimateGas("transfer", $toAddress, $amount, $params, function ($err, $result) use (&$es, &$success) {
                    if (!is_null($err)) {
                        Log::error("estimate gas error: " . $err->getMessage());
                    } else {
                        $es = $result->toString();
                        $success++;
                    }
                });
        }

        if ($success == 3) {
            // withdraw gas price multiplier from setting general
            $setting = SettingLogic::get("general", ["category" => "withdraw", "code" => "withdraw_gasprice_multiplier"]);
            $multiply = $setting["value"] ?? 1;

            $nonce = Utils::toHex($nonce, true);
            $gas = Utils::toHex(intval($gasPrice * $multiply), true);
            $gasLimit = Utils::toHex($es, true);

            if ($mainCoin) {
                $to = $toAddress;
                $value = $amount;
                $data = "";
            } else {
                $to = $tokenAddress;
                $value = Utils::toHex(0, true);
                $data = sprintf("0x%s", $data);
            }

            $transaction = new Transaction($nonce, $gas, $gasLimit, $to, $value, $data);

            $signedTransaction = "0x" . $transaction->getRaw($privateKey, $chainId);

            // send signed transaction
            $web3->eth->sendRawTransaction($signedTransaction, function ($err, $data) use (&$transactionHash) {
                if (!is_null($err)) {
                    Log::error("send raw transaction error: " . $err->getMessage());
                } else {
                    $transactionHash = $data;
                }
            });
        }

        return $transactionHash;
    }

    # processor log reader
    /*
        # topics - act as a filter parameter
        - transfer (ERC-721 NFTs & common type of transfer) - 0xddf252ad1be2c89b69c2b068fc378daa952ba7f163c4a11628f55a4df523b3ef
        - single transfer (ERC-1155 NFTs) = 0xc3d58168c5ae7397731d063d5bbf3d657854427343f4c083240f7aacaa2d0f62
        - if mint nft - from is 0x0000000000000000000000000000000000000000, to is user

        # topics index
        ERC-20 - topic 1 = from, topic 2 = to
        ERC-721 - topic 1 = from, topic 2 = to, topic 3 = tokenId
        ERC-1155 - topic 1 = operator, topic 2 = from, topic 3 = to

        get the transaction log not receipt so wont have status field, and only success transaction will have log, so basically the log that's fetched by this function are from transaction that's success
    */
    public static function recordReader(
        string $tokenAddress = "",
        string $rpcUrl = "",
        int $startBlock = 0,
        int $endBlock = 0,
        string $event = "",
        string $fromAddress = "",
        string $toAddress = ""
    ) {
        $filter = null;
        $recordLists = [];
        $rawRecords = [];
        $success = 0;

        try {
            $web3 = new Web3(new HttpProvider($rpcUrl, 2));

            $event = !empty($event) ? $event : null;
            $fromAddress = !empty($fromAddress) ? "0x000000000000000000000000" . str_replace("0x", "", $fromAddress) : null;
            $toAddress = !empty($toAddress) ? "0x000000000000000000000000" . str_replace("0x", "", $toAddress) : null;
            $topics = [$event, $fromAddress, $toAddress];

            $params = [
                "fromBlock" => "0x" . dechex($startBlock),
                "toBlock" => "0x" . dechex($endBlock),
                "address" => $tokenAddress,
                "topics" => $topics,
            ];

            $web3->eth->newFilter($params, function ($err, $data) use (&$filter, &$success) {
                if (!is_null($err)) {
                    Log::error("web3 eth newFilter: " . $err);
                } else {
                    $filter = $data;
                    $success++;
                }
            });

            if (!empty($filter)) {
                $web3->eth->getFilterLogs($filter, function ($err, $data) use (&$rawRecords, &$success) {
                    if (!is_null($err)) {
                        // always trigger error due to rpc problem so commented out
                        // Log::error("web3 eth getFilterLogs: " . $err);
                    } else {
                        $rawRecords = $data;
                        $success++;
                    }
                });
            }

            if (count($rawRecords) > 0) {
                foreach ($rawRecords as $record) {
                    $recordLists[] = [
                        "txid" => $record->transactionHash,
                        "block" => hexdec($record->blockNumber),
                        "event" => $record->topics[0],
                        "fromAddress" => !empty($record->topics[1])
                            ? strtolower(str_replace("0x000000000000000000000000", "0x", $record->topics[1]))
                            : null,
                        "toAddress" => !empty($record->topics[2])
                            ? strtolower(str_replace("0x000000000000000000000000", "0x", $record->topics[2]))
                            : null,
                        "tokenId" => !empty($record->topics[3])
                            ? hexdec($record->topics[3])
                            : null,
                        "amount" => self::hexdecimalToDecimal($record->data),
                        "logIndex" => $record->logIndex,
                        "meta" => $record,
                    ];
                }
            }
        } catch (\Exception $e) {
        }

        if ($success == 2) {
            return $recordLists;
        } else {
            return false;
        }
    }

    # nft sign message
    public static function signMessage(string $message, $contract)
    {
        $signature = false;

        if ($contract && !empty($contract["private_key"])) {
            $privateKey = HelperLogic::decrypt($contract["private_key"]);

            // Validate the private key format
            if (self::isValidPrivateKeyFormat($privateKey)) {
                $hash = self::hashMessage($message);

                // Instantiate Elliptic Curve library with secp256k1 curve
                $ec = new EC("secp256k1");

                // Convert the private key from hex format to a key object
                $ecPrivateKey = $ec->keyFromPrivate($privateKey, "hex");

                // Sign the hash with the private key using canonical mode
                $signature = $ecPrivateKey->sign($hash, ["canonical" => true]);

                // Convert the signature components (r, s, v) to hexadecimal strings
                $r = str_pad($signature->r->toString(16), 64, "0", STR_PAD_LEFT);
                $s = str_pad($signature->s->toString(16), 64, "0", STR_PAD_LEFT);
                $v = dechex($signature->recoveryParam + 27);

                // Combine r, s, and v components to create the final signature string
                $signature = "0x" . $r . $s . $v;
            }
        }

        return $signature;
    }

    # hash the message
    private static function hashMessage(string $message)
    {
        // Prefix the message according to Ethereum Signed Message format
        $signMessage = "\x19Ethereum Signed Message:\n" . strlen($message) . strtolower($message);

        // Hash the prefixed message using Keccak-256 hash function
        $hash = "0x" . Keccak::hash($signMessage, 256);

        return $hash;
    }

    # check private key validity
    private static function isValidPrivateKeyFormat($privateKey)
    {
        $response = false;
        // Check if the string is a valid hexadecimal string
        if (is_string($privateKey)) {
            if (preg_match("/^(0x)?[0-9a-fA-F]{64}$/", $privateKey)) {
                $response = true;
            }
        }
        return $response;
    }
}
