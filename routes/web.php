<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers as Admin;
use App\Http\Middleware\MaintenanceMiddleware;
use App\Http\Middleware\PathDetectorMiddleware;
use App\Http\Middleware\PermissionControlMiddleware;

/**
 * 执行操作: 前端访客
 *    List = GET /tickets/list - 列出所有
 *    List = GET /tickets - 列出 paging
 *    Read = GET /tickets/{id} - 列出 id
 *    Create = POST /tickets - 创建
 *    Update = PUT /tickets/{id} - 更新信息
 *    UpdatePartial = PATCH /tickets/{id} - 部分修改, 例如修改状态
 *    Delete = DELETE /tickets/{id} - 删掉 9839 这张车票
 */

// empty login for unauthenticated route login not found problem
Route::get("/login")->name("login");


// test
Route::prefix("/test")->group(function () {
    Route::get("/testing", [Admin\Test::class, "testing"]);
});

// global
Route::prefix("/global")->group(function () {
    Route::get("/redisFlush", [Admin\GlobalController::class, "redisFlush"]);
    Route::get("/redis", [Admin\GlobalController::class, "redis"]);
});

// csrf
Route::get("/csrfToken", function () {
    return ["token" => csrf_token()];
});

Route::middleware([
    MaintenanceMiddleware::class,
    PathDetectorMiddleware::class
])->prefix("/admin")->group(function () {
    // auth
    Route::prefix("/auth")->group(function () {
        Route::post("/request", [Admin\Auth\Ask::class, "index"]);
        Route::post("/verify", [Admin\Auth\Verify::class, "index"]);
        Route::get("/logout", [Admin\Auth\Logout::class, "index"])->middleware([
            "auth:sanctum",
        ]);
        Route::get("/rule", [Admin\Auth\Rule::class, "index"])->middleware([
            "auth:sanctum",
        ]);
    });

    // enum list
    Route::middleware([
        "auth:sanctum",
        PermissionControlMiddleware::class
    ])->prefix("/enumList")->group(function () {
        Route::get("/list", [Admin\EnumList\Listing::class, "index"]);
    });

    // account
    Route::middleware([
        "auth:sanctum",
        PermissionControlMiddleware::class
    ])->prefix("/account")->group(function () {
        Route::prefix("/admin")->group(function () {
            Route::get("/list", [Admin\Account\Admin\Listing::class, "index"]);
            Route::get("", [Admin\Account\Admin\Paging::class, "index"]);
            Route::get("/{id}", [Admin\Account\Admin\Read::class, "index"])->where("id", "\d+");
            Route::post("", [Admin\Account\Admin\Create::class, "index"]);
            Route::put("/{id}", [Admin\Account\Admin\Update::class, "index"])->where("id", "\d+");
            Route::delete("/{id}", [Admin\Account\Admin\Delete::class, "index"])->where("id", "\d+");
        });

        Route::prefix("/user")->group(function () {
            Route::get("/list", [Admin\Account\User\Listing::class, "index"]);
            Route::get("", [Admin\Account\User\Paging::class, "index"]);
            Route::get("/{id}", [Admin\Account\User\Read::class, "index"])->where("id", "\d+");
            Route::post("", [Admin\Account\User\Create::class, "index"]);
            Route::put("/{id}", [Admin\Account\User\Update::class, "index"])->where("id", "\d+");
            Route::delete("/{id}", [Admin\Account\User\Delete::class, "index"])->where("id", "\d+");
            Route::get("/details", [Admin\Account\User\Details::class, "index"]);
            Route::get("/viewBalance/{id}", [Admin\Account\User\ViewBalance::class, "index"])->where("id", "\d+");
            Route::put("/addBalance/{id}", [Admin\Account\User\AddBalance::class, "index"])->where("id", "\d+");
            Route::put("/deductBalance/{id}", [Admin\Account\User\DeductBalance::class, "index"])->where("id", "\d+");
        });
    });

    // // hierarchy
    // Route::middleware([
    //     "auth:sanctum",
    //     PermissionControlMiddleware::class
    // ])->prefix("/hierarchy")->group(function () {
    //     Route::get("/upline", [Admin\Hierarchy\Upline::class, "index"]);
    //     Route::get("/downline", [Admin\Hierarchy\Downline::class, "index"]);
    // });

    // // log
    // Route::middleware([
    //     "auth:sanctum",
    //     PermissionControlMiddleware::class
    // ])->prefix("/log")->group(function () {
    //     Route::prefix("/admin")->group(function () {
    //         Route::get("/list", [Admin\Log\Admin\Listing::class, "index"]);
    //         Route::get("", [Admin\Log\Admin\Paging::class, "index"]);
    //         Route::get("/{id}", [Admin\Log\Admin\Read::class, "index"])->where("id", "\d+");
    //         Route::post("", [Admin\Log\Admin\Create::class, "index"]);
    //         Route::put("/{id}", [Admin\Log\Admin\Update::class, "index"])->where("id", "\d+");
    //         Route::delete("/{id}", [Admin\Log\Admin\Delete::class, "index"])->where("id", "\d+");
    //     });

    //     Route::prefix("/cronjob")->group(function () {
    //         Route::get("/list", [Admin\Log\Cronjob\Listing::class, "index"]);
    //         Route::get("", [Admin\Log\Cronjob\Paging::class, "index"]);
    //         Route::get("/{id}", [Admin\Log\Cronjob\Read::class, "index"])->where("id", "\d+");
    //         Route::post("", [Admin\Log\Cronjob\Create::class, "index"]);
    //         Route::put("/{id}", [Admin\Log\Cronjob\Update::class, "index"])->where("id", "\d+");
    //         Route::delete("/{id}", [Admin\Log\Cronjob\Delete::class, "index"])->where("id", "\d+");
    //     });

    //     Route::prefix("/user")->group(function () {
    //         Route::get("/list", [Admin\Log\User\Listing::class, "index"]);
    //         Route::get("", [Admin\Log\User\Paging::class, "index"]);
    //         Route::get("/{id}", [Admin\Log\User\Read::class, "index"])->where("id", "\d+");
    //         Route::post("", [Admin\Log\User\Create::class, "index"]);
    //         Route::put("/{id}", [Admin\Log\User\Update::class, "index"])->where("id", "\d+");
    //         Route::delete("/{id}", [Admin\Log\User\Delete::class, "index"])->where("id", "\d+");
    //     });
    // });

    // // network
    // Route::middleware([
    //     "auth:sanctum",
    //     PermissionControlMiddleware::class
    // ])->prefix("/network")->group(function () {
    //     Route::prefix("/sponsor")->group(function () {
    //         Route::get("/list", [Admin\Network\Sponsor\Listing::class, "index"]);
    //         Route::get("", [Admin\Network\Sponsor\Paging::class, "index"]);
    //         Route::get("/{id}", [Admin\Network\Sponsor\Read::class, "index"])->where("id", "\d+");
    //         Route::post("", [Admin\Network\Sponsor\Create::class, "index"]);
    //         Route::put("/{id}", [Admin\Network\Sponsor\Update::class, "index"])->where("id", "\d+");
    //         Route::delete("/{id}", [Admin\Network\Sponsor\Delete::class, "index"])->where("id", "\d+");
    //     });
    // });

    // // permission
    // Route::middleware([
    //     "auth:sanctum",
    //     PermissionControlMiddleware::class
    // ])->prefix("/permission")->group(function () {
    //     Route::prefix("/admin")->group(function () {
    //         Route::get("/list", [Admin\Permission\Admin\Listing::class, "index"]);
    //         Route::get("", [Admin\Permission\Admin\Paging::class, "index"]);
    //         Route::get("/{id}", [Admin\Permission\Admin\Read::class, "index"])->where("id", "\d+");
    //         Route::post("", [Admin\Permission\Admin\Create::class, "index"]);
    //         Route::put("/{id}", [Admin\Permission\Admin\Update::class, "index"])->where("id", "\d+");
    //         Route::delete("/{id}", [Admin\Permission\Admin\Delete::class, "index"])->where("id", "\d+");
    //     });

    //     Route::prefix("/template")->group(function () {
    //         Route::get("/list", [Admin\Permission\Template\Listing::class, "index"]);
    //         Route::get("", [Admin\Permission\Template\Paging::class, "index"]);
    //         Route::get("/{id}", [Admin\Permission\Template\Read::class, "index"])->where("id", "\d+");
    //         Route::post("", [Admin\Permission\Template\Create::class, "index"]);
    //         Route::put("/{id}", [Admin\Permission\Template\Update::class, "index"])->where("id", "\d+");
    //         Route::delete("/{id}", [Admin\Permission\Template\Delete::class, "index"])->where("id", "\d+");
    //     });

    //     Route::prefix("/warehouse")->group(function () {
    //         Route::get("/list", [Admin\Permission\Warehouse\Listing::class, "index"]);
    //         Route::get("", [Admin\Permission\Warehouse\Paging::class, "index"]);
    //         Route::get("/{id}", [Admin\Permission\Warehouse\Read::class, "index"])->where("id", "\d+");
    //         Route::post("", [Admin\Permission\Warehouse\Create::class, "index"]);
    //         Route::put("/{id}", [Admin\Permission\Warehouse\Update::class, "index"])->where("id", "\d+");
    //         Route::delete("/{id}", [Admin\Permission\Warehouse\Delete::class, "index"])->where("id", "\d+");
    //     });
    // });

    // // reward
    // Route::middleware([
    //     "auth:sanctum",
    //     PermissionControlMiddleware::class
    // ])->prefix("/reward")->group(function () {
    //     Route::prefix("/record")->group(function () {
    //         Route::get("/list", [Admin\Reward\Record\Listing::class, "index"]);
    //         Route::get("", [Admin\Reward\Record\Paging::class, "index"]);
    //         Route::get("/{id}", [Admin\Reward\Record\Read::class, "index"])->where("id", "\d+");
    //         Route::post("", [Admin\Reward\Record\Create::class, "index"]);
    //         Route::put("/{id}", [Admin\Reward\Record\Update::class, "index"])->where("id", "\d+");
    //         Route::delete("/{id}", [Admin\Reward\Record\Delete::class, "index"])->where("id", "\d+");
    //     });
    // });

    // // setting
    // Route::middleware([
    //     "auth:sanctum",
    //     PermissionControlMiddleware::class
    // ])->prefix("/setting")->group(function () {
    //     Route::prefix("/attribute")->group(function () {
    //         Route::get("/list", [Admin\Setting\Attribute\Listing::class, "index"]);
    //         Route::get("/{id}", [Admin\Setting\Attribute\Read::class, "index"])->where("id", "\d+");
    //         Route::get("", [Admin\Setting\Attribute\Paging::class, "index"]);
    //         Route::post("", [Admin\Setting\Attribute\Create::class, "index"]);
    //         Route::put("/{id}", [Admin\Setting\Attribute\Update::class, "index"])->where("id", "\d+");
    //         Route::delete("/{id}", [Admin\Setting\Attribute\Delete::class, "index"])->where("id", "\d+");
    //     });

    //     Route::prefix("/blockchainNetwork")->group(function () {
    //         Route::get("/list", [Admin\Setting\BlockchainNetwork\Listing::class, "index"]);
    //         Route::get("/{id}", [Admin\Setting\BlockchainNetwork\Read::class, "index"])->where("id", "\d+");
    //         Route::get("", [Admin\Setting\BlockchainNetwork\Paging::class, "index"]);
    //         Route::post("", [Admin\Setting\BlockchainNetwork\Create::class, "index"]);
    //         Route::put("/{id}", [Admin\Setting\BlockchainNetwork\Update::class, "index"])->where("id", "\d+");
    //         Route::delete("/{id}", [Admin\Setting\BlockchainNetwork\Delete::class, "index"])->where("id", "\d+");
    //     });

    //     Route::prefix("/coin")->group(function () {
    //         Route::get("/list", [Admin\Setting\Coin\Listing::class, "index"]);
    //         Route::get("/{id}", [Admin\Setting\Coin\Read::class, "index"])->where("id", "\d+");
    //         Route::get("", [Admin\Setting\Coin\Paging::class, "index"]);
    //         Route::post("", [Admin\Setting\Coin\Create::class, "index"]);
    //         Route::put("/{id}", [Admin\Setting\Coin\Update::class, "index"])->where("id", "\d+");
    //         Route::delete("/{id}", [Admin\Setting\Coin\Delete::class, "index"])->where("id", "\d+");
    //     });

    //     Route::prefix("/deposit")->group(function () {
    //         Route::get("/list", [Admin\Setting\Deposit\Listing::class, "index"]);
    //         Route::get("/{id}", [Admin\Setting\Deposit\Read::class, "index"])->where("id", "\d+");
    //         Route::get("", [Admin\Setting\Deposit\Paging::class, "index"]);
    //         Route::post("", [Admin\Setting\Deposit\Create::class, "index"]);
    //         Route::put("/{id}", [Admin\Setting\Deposit\Update::class, "index"])->where("id", "\d+");
    //         Route::delete("/{id}", [Admin\Setting\Deposit\Delete::class, "index"])->where("id", "\d+");
    //     });

    //     Route::prefix("/general")->group(function () {
    //         Route::get("/list", [Admin\Setting\General\Listing::class, "index"]);
    //         Route::get("/{id}", [Admin\Setting\General\Read::class, "index"])->where("id", "\d+");
    //         Route::get("", [Admin\Setting\General\Paging::class, "index"]);
    //         Route::post("", [Admin\Setting\General\Create::class, "index"]);
    //         Route::put("/{id}", [Admin\Setting\General\Update::class, "index"])->where("id", "\d+");
    //         Route::delete("/{id}", [Admin\Setting\General\Delete::class, "index"])->where("id", "\d+");
    //     });

    //     Route::prefix("/nft")->group(function () {
    //         Route::get("/list", [Admin\Setting\Nft\Listing::class, "index"]);
    //         Route::get("/{id}", [Admin\Setting\Nft\Read::class, "index"])->where("id", "\d+");
    //         Route::get("", [Admin\Setting\Nft\Paging::class, "index"]);
    //         Route::post("", [Admin\Setting\Nft\Create::class, "index"]);
    //         Route::put("/{id}", [Admin\Setting\Nft\Update::class, "index"])->where("id", "\d+");
    //         Route::delete("/{id}", [Admin\Setting\Nft\Delete::class, "index"])->where("id", "\d+");
    //     });

    //     Route::prefix("/operator")->group(function () {
    //         Route::get("/list", [Admin\Setting\Operator\Listing::class, "index"]);
    //         Route::get("/{id}", [Admin\Setting\Operator\Read::class, "index"])->where("id", "\d+");
    //         Route::get("", [Admin\Setting\Operator\Paging::class, "index"]);
    //         Route::post("", [Admin\Setting\Operator\Create::class, "index"]);
    //         Route::put("/{id}", [Admin\Setting\Operator\Update::class, "index"])->where("id", "\d+");
    //         Route::delete("/{id}", [Admin\Setting\Operator\Delete::class, "index"])->where("id", "\d+");
    //     });

    //     Route::prefix("/payment")->group(function () {
    //         Route::get("/list", [Admin\Setting\Payment\Listing::class, "index"]);
    //         Route::get("/{id}", [Admin\Setting\Payment\Read::class, "index"])->where("id", "\d+");
    //         Route::get("", [Admin\Setting\Payment\Paging::class, "index"]);
    //         Route::post("", [Admin\Setting\Payment\Create::class, "index"]);
    //         Route::put("/{id}", [Admin\Setting\Payment\Update::class, "index"])->where("id", "\d+");
    //         Route::delete("/{id}", [Admin\Setting\Payment\Delete::class, "index"])->where("id", "\d+");
    //     });

    //     Route::prefix("/wallet")->group(function () {
    //         Route::get("/list", [Admin\Setting\Wallet\Listing::class, "index"]);
    //         Route::get("/{id}", [Admin\Setting\Wallet\Read::class, "index"])->where("id", "\d+");
    //         Route::get("", [Admin\Setting\Wallet\Paging::class, "index"]);
    //         Route::post("", [Admin\Setting\Wallet\Create::class, "index"]);
    //         Route::put("/{id}", [Admin\Setting\Wallet\Update::class, "index"])->where("id", "\d+");
    //         Route::delete("/{id}", [Admin\Setting\Wallet\Delete::class, "index"])->where("id", "\d+");
    //     });

    //     Route::prefix("/walletAttribute")->group(function () {
    //         Route::get("/list", [Admin\Setting\WalletAttribute\Listing::class, "index"]);
    //         Route::get("/{id}", [Admin\Setting\WalletAttribute\Read::class, "index"])->where("id", "\d+");
    //         Route::get("", [Admin\Setting\WalletAttribute\Paging::class, "index"]);
    //         Route::post("", [Admin\Setting\WalletAttribute\Create::class, "index"]);
    //         Route::put("/{id}", [Admin\Setting\WalletAttribute\Update::class, "index"])->where("id", "\d+");
    //         Route::delete("/{id}", [Admin\Setting\WalletAttribute\Delete::class, "index"])->where("id", "\d+");
    //     });

    //     Route::prefix("/withdraw")->group(function () {
    //         Route::get("/list", [Admin\Setting\Withdraw\Listing::class, "index"]);
    //         Route::get("/{id}", [Admin\Setting\Withdraw\Read::class, "index"])->where("id", "\d+");
    //         Route::get("", [Admin\Setting\Withdraw\Paging::class, "index"]);
    //         Route::post("", [Admin\Setting\Withdraw\Create::class, "index"]);
    //         Route::put("/{id}", [Admin\Setting\Withdraw\Update::class, "index"])->where("id", "\d+");
    //         Route::delete("/{id}", [Admin\Setting\Withdraw\Delete::class, "index"])->where("id", "\d+");
    //     });
    // });

    // // stat
    // Route::middleware([
    //     "auth:sanctum",
    //     PermissionControlMiddleware::class
    // ])->prefix("/stat")->group(function () {
    //     Route::prefix("/sponsor")->group(function () {
    //         Route::get("/list", [Admin\Stat\Sponsor\Listing::class, "index"]);
    //         Route::get("", [Admin\Stat\Sponsor\Paging::class, "index"]);
    //         Route::get("/{id}", [Admin\Stat\Sponsor\Read::class, "index"])->where("id", "\d+");
    //         Route::post("", [Admin\Stat\Sponsor\Create::class, "index"]);
    //         Route::put("/{id}", [Admin\Stat\Sponsor\Update::class, "index"])->where("id", "\d+");
    //         Route::delete("/{id}", [Admin\Stat\Sponsor\Delete::class, "index"])->where("id", "\d+");
    //     });
    // });

    // // user
    // Route::middleware([
    //     "auth:sanctum",
    //     PermissionControlMiddleware::class
    // ])->prefix("/user")->group(function () {
    //     Route::prefix("/deposit")->group(function () {
    //         Route::get("/list", [Admin\User\Deposit\Listing::class, "index"]);
    //         Route::get("", [Admin\User\Deposit\Paging::class, "index"]);
    //         Route::get("/{id}", [Admin\User\Deposit\Read::class, "index"])->where("id", "\d+");
    //         Route::post("", [Admin\User\Deposit\Create::class, "index"]);
    //         Route::put("/{id}", [Admin\User\Deposit\Update::class, "index"])->where("id", "\d+");
    //         Route::delete("/{id}", [Admin\User\Deposit\Delete::class, "index"])->where("id", "\d+");
    //     });

    //     Route::prefix("/nft")->group(function () {
    //         Route::get("/list", [Admin\User\Nft\Listing::class, "index"]);
    //         Route::get("", [Admin\User\Nft\Paging::class, "index"]);
    //         Route::get("/{id}", [Admin\User\Nft\Read::class, "index"])->where("id", "\d+");
    //         Route::post("", [Admin\User\Nft\Create::class, "index"]);
    //         Route::put("/{id}", [Admin\User\Nft\Update::class, "index"])->where("id", "\d+");
    //         Route::delete("/{id}", [Admin\User\Nft\Delete::class, "index"])->where("id", "\d+");
    //     });

    //     Route::prefix("/remark")->group(function () {
    //         Route::get("/list", [Admin\User\Remark\Listing::class, "index"]);
    //         Route::get("", [Admin\User\Remark\Paging::class, "index"]);
    //         Route::get("/{id}", [Admin\User\Remark\Read::class, "index"])->where("id", "\d+");
    //         Route::post("", [Admin\User\Remark\Create::class, "index"]);
    //         Route::put("/{id}", [Admin\User\Remark\Update::class, "index"])->where("id", "\d+");
    //         Route::delete("/{id}", [Admin\User\Remark\Delete::class, "index"])->where("id", "\d+");
    //     });

    //     Route::prefix("/withdraw")->group(function () {
    //         Route::get("/list", [Admin\User\Withdraw\Listing::class, "index"]);
    //         Route::get("", [Admin\User\Withdraw\Paging::class, "index"]);
    //         Route::get("/{id}", [Admin\User\Withdraw\Read::class, "index"])->where("id", "\d+");
    //         Route::post("", [Admin\User\Withdraw\Create::class, "index"]);
    //         Route::put("/{id}", [Admin\User\Withdraw\Update::class, "index"])->where("id", "\d+");
    //         Route::delete("/{id}", [Admin\User\Withdraw\Delete::class, "index"])->where("id", "\d+");
    //     });
    // });

    // // wallet
    // Route::middleware([
    //     "auth:sanctum",
    //     PermissionControlMiddleware::class
    // ])->prefix("/wallet")->group(function () {
    //     Route::prefix("/transaction")->group(function () {
    //         Route::get("/list", [Admin\Wallet\Transaction\Listing::class, "index"]);
    //         Route::get("", [Admin\Wallet\Transaction\Paging::class, "index"]);
    //         Route::get("/{id}", [Admin\Wallet\Transaction\Read::class, "index"])->where("id", "\d+");
    //         Route::post("", [Admin\Wallet\Transaction\Create::class, "index"]);
    //         Route::put("/{id}", [Admin\Wallet\Transaction\Update::class, "index"])->where("id", "\d+");
    //         Route::delete("/{id}", [Admin\Wallet\Transaction\Delete::class, "index"])->where("id", "\d+");
    //     });

    //     Route::prefix("/transactionDetail")->group(function () {
    //         Route::get("/list", [Admin\Wallet\TransactionDetail\Listing::class, "index"]);
    //         Route::get("", [Admin\Wallet\TransactionDetail\Paging::class, "index"]);
    //         Route::get("/{id}", [Admin\Wallet\TransactionDetail\Read::class, "index"])->where("id", "\d+");
    //         Route::post("", [Admin\Wallet\TransactionDetail\Create::class, "index"]);
    //         Route::put("/{id}", [Admin\Wallet\TransactionDetail\Update::class, "index"])->where("id", "\d+");
    //         Route::delete("/{id}", [Admin\Wallet\TransactionDetail\Delete::class, "index"])->where("id", "\d+");
    //     });
    // });

    // // summary
    // Route::middleware([
    //     "auth:sanctum",
    //     PermissionControlMiddleware::class
    // ])->prefix("/dashboard")->group(function () {
    //     Route::get("/activeUser", [Admin\dashboard\ActiveUser::class, "index"]);
    // });
});
