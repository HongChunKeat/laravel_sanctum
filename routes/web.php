<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers as admin;
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

// global
Route::prefix("/global")->group(function () {
    Route::get("/redisFlush", [admin\GlobalController::class, "redisFlush"]);
    Route::get("/redis", [admin\GlobalController::class, "redis"]);
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
        Route::post("/request", [admin\Auth\Ask::class, "index"]);
        Route::post("/verify", [admin\Auth\Verify::class, "index"]);
        Route::get("/logout", [admin\Auth\Logout::class, "index"])->middleware([
            "auth:sanctum",
        ]);
        Route::get("/rule", [admin\Auth\Rule::class, "index"])->middleware([
            "auth:sanctum",
        ]);
    });

    // enum list
    Route::middleware([
        "auth:sanctum",
        PermissionControlMiddleware::class
    ])->prefix("/enumList")->group(function () {
        Route::get("/list", [admin\enumList\Listing::class, "index"]);
    });

    // account
    Route::middleware([
        "auth:sanctum",
        PermissionControlMiddleware::class
    ])->prefix("/account")->group(function () {
        Route::prefix("/admin")->group(function () {
            Route::get("/list", [admin\account\admin\Listing::class, "index"]);
            Route::get("", [admin\account\admin\Paging::class, "index"]);
            Route::get("/{id:\d+}", [admin\account\admin\Read::class, "index"]);
            Route::post("", [admin\account\admin\Create::class, "index"]);
            Route::put("/{id:\d+}", [admin\account\admin\Update::class, "index"]);
            Route::delete("/{id:\d+}", [admin\account\admin\Delete::class, "index"]);
        });

        Route::prefix("/user")->group(function () {
            Route::get("/list", [admin\account\user\Listing::class, "index"]);
            Route::get("", [admin\account\user\Paging::class, "index"]);
            Route::get("/{id:\d+}", [admin\account\user\Read::class, "index"]);
            Route::post("", [admin\account\user\Create::class, "index"]);
            Route::put("/{id:\d+}", [admin\account\user\Update::class, "index"]);
            Route::delete("/{id:\d+}", [admin\account\user\Delete::class, "index"]);
            Route::get("/details", [admin\account\user\Details::class, "index"]);
            Route::get("/viewBalance/{id:\d+}", [admin\account\user\ViewBalance::class, "index"]);
            Route::put("/addBalance/{id:\d+}", [admin\account\user\AddBalance::class, "index"]);
            Route::put("/deductBalance/{id:\d+}", [admin\account\user\DeductBalance::class, "index"]);
        });
    });

    // hierarchy
    Route::middleware([
        "auth:sanctum",
        PermissionControlMiddleware::class
    ])->prefix("/hierarchy")->group(function () {
        Route::get("/upline", [admin\hierarchy\Upline::class, "index"]);
        Route::get("/downline", [admin\hierarchy\Downline::class, "index"]);
    });

    // log
    Route::middleware([
        "auth:sanctum",
        PermissionControlMiddleware::class
    ])->prefix("/log")->group(function () {
        Route::prefix("/admin")->group(function () {
            Route::get("/list", [admin\log\admin\Listing::class, "index"]);
            Route::get("", [admin\log\admin\Paging::class, "index"]);
            Route::get("/{id:\d+}", [admin\log\admin\Read::class, "index"]);
            Route::post("", [admin\log\admin\Create::class, "index"]);
            Route::put("/{id:\d+}", [admin\log\admin\Update::class, "index"]);
            Route::delete("/{id:\d+}", [admin\log\admin\Delete::class, "index"]);
        });

        Route::prefix("/cronjob")->group(function () {
            Route::get("/list", [admin\log\cronjob\Listing::class, "index"]);
            Route::get("", [admin\log\cronjob\Paging::class, "index"]);
            Route::get("/{id:\d+}", [admin\log\cronjob\Read::class, "index"]);
            Route::post("", [admin\log\cronjob\Create::class, "index"]);
            Route::put("/{id:\d+}", [admin\log\cronjob\Update::class, "index"]);
            Route::delete("/{id:\d+}", [admin\log\cronjob\Delete::class, "index"]);
        });

        Route::prefix("/user")->group(function () {
            Route::get("/list", [admin\log\user\Listing::class, "index"]);
            Route::get("", [admin\log\user\Paging::class, "index"]);
            Route::get("/{id:\d+}", [admin\log\user\Read::class, "index"]);
            Route::post("", [admin\log\user\Create::class, "index"]);
            Route::put("/{id:\d+}", [admin\log\user\Update::class, "index"]);
            Route::delete("/{id:\d+}", [admin\log\user\Delete::class, "index"]);
        });
    });

    // network
    Route::middleware([
        "auth:sanctum",
        PermissionControlMiddleware::class
    ])->prefix("/network")->group(function () {
        Route::prefix("/sponsor")->group(function () {
            Route::get("/list", [admin\network\sponsor\Listing::class, "index"]);
            Route::get("", [admin\network\sponsor\Paging::class, "index"]);
            Route::get("/{id:\d+}", [admin\network\sponsor\Read::class, "index"]);
            Route::post("", [admin\network\sponsor\Create::class, "index"]);
            Route::put("/{id:\d+}", [admin\network\sponsor\Update::class, "index"]);
            Route::delete("/{id:\d+}", [admin\network\sponsor\Delete::class, "index"]);
        });
    });

    // permission
    Route::middleware([
        "auth:sanctum",
        PermissionControlMiddleware::class
    ])->prefix("/permission")->group(function () {
        Route::prefix("/admin")->group(function () {
            Route::get("/list", [admin\permission\admin\Listing::class, "index"]);
            Route::get("", [admin\permission\admin\Paging::class, "index"]);
            Route::get("/{id:\d+}", [admin\permission\admin\Read::class, "index"]);
            Route::post("", [admin\permission\admin\Create::class, "index"]);
            Route::put("/{id:\d+}", [admin\permission\admin\Update::class, "index"]);
            Route::delete("/{id:\d+}", [admin\permission\admin\Delete::class, "index"]);
        });

        Route::prefix("/template")->group(function () {
            Route::get("/list", [admin\permission\template\Listing::class, "index"]);
            Route::get("", [admin\permission\template\Paging::class, "index"]);
            Route::get("/{id:\d+}", [admin\permission\template\Read::class, "index"]);
            Route::post("", [admin\permission\template\Create::class, "index"]);
            Route::put("/{id:\d+}", [admin\permission\template\Update::class, "index"]);
            Route::delete("/{id:\d+}", [admin\permission\template\Delete::class, "index"]);
        });

        Route::prefix("/warehouse")->group(function () {
            Route::get("/list", [admin\permission\warehouse\Listing::class, "index"]);
            Route::get("", [admin\permission\warehouse\Paging::class, "index"]);
            Route::get("/{id:\d+}", [admin\permission\warehouse\Read::class, "index"]);
            Route::post("", [admin\permission\warehouse\Create::class, "index"]);
            Route::put("/{id:\d+}", [admin\permission\warehouse\Update::class, "index"]);
            Route::delete("/{id:\d+}", [admin\permission\warehouse\Delete::class, "index"]);
        });
    });

    // reward
    Route::middleware([
        "auth:sanctum",
        PermissionControlMiddleware::class
    ])->prefix("/reward")->group(function () {
        Route::prefix("/record")->group(function () {
            Route::get("/list", [admin\reward\record\Listing::class, "index"]);
            Route::get("", [admin\reward\record\Paging::class, "index"]);
            Route::get("/{id:\d+}", [admin\reward\record\Read::class, "index"]);
            Route::post("", [admin\reward\record\Create::class, "index"]);
            Route::put("/{id:\d+}", [admin\reward\record\Update::class, "index"]);
            Route::delete("/{id:\d+}", [admin\reward\record\Delete::class, "index"]);
        });
    });

    // setting
    Route::middleware([
        "auth:sanctum",
        PermissionControlMiddleware::class
    ])->prefix("/setting")->group(function () {
        Route::prefix("/attribute")->group(function () {
            Route::get("/list", [admin\setting\attribute\Listing::class, "index"]);
            Route::get("/{id:\d+}", [admin\setting\attribute\Read::class, "index"]);
            Route::get("", [admin\setting\attribute\Paging::class, "index"]);
            Route::post("", [admin\setting\attribute\Create::class, "index"]);
            Route::put("/{id:\d+}", [admin\setting\attribute\Update::class, "index"]);
            Route::delete("/{id:\d+}", [admin\setting\attribute\Delete::class, "index"]);
        });

        Route::prefix("/blockchainNetwork")->group(function () {
            Route::get("/list", [admin\setting\blockchainNetwork\Listing::class, "index"]);
            Route::get("/{id:\d+}", [admin\setting\blockchainNetwork\Read::class, "index"]);
            Route::get("", [admin\setting\blockchainNetwork\Paging::class, "index"]);
            Route::post("", [admin\setting\blockchainNetwork\Create::class, "index"]);
            Route::put("/{id:\d+}", [admin\setting\blockchainNetwork\Update::class, "index"]);
            Route::delete("/{id:\d+}", [admin\setting\blockchainNetwork\Delete::class, "index"]);
        });

        Route::prefix("/coin")->group(function () {
            Route::get("/list", [admin\setting\coin\Listing::class, "index"]);
            Route::get("/{id:\d+}", [admin\setting\coin\Read::class, "index"]);
            Route::get("", [admin\setting\coin\Paging::class, "index"]);
            Route::post("", [admin\setting\coin\Create::class, "index"]);
            Route::put("/{id:\d+}", [admin\setting\coin\Update::class, "index"]);
            Route::delete("/{id:\d+}", [admin\setting\coin\Delete::class, "index"]);
        });

        Route::prefix("/deposit")->group(function () {
            Route::get("/list", [admin\setting\deposit\Listing::class, "index"]);
            Route::get("/{id:\d+}", [admin\setting\deposit\Read::class, "index"]);
            Route::get("", [admin\setting\deposit\Paging::class, "index"]);
            Route::post("", [admin\setting\deposit\Create::class, "index"]);
            Route::put("/{id:\d+}", [admin\setting\deposit\Update::class, "index"]);
            Route::delete("/{id:\d+}", [admin\setting\deposit\Delete::class, "index"]);
        });

        Route::prefix("/general")->group(function () {
            Route::get("/list", [admin\setting\general\Listing::class, "index"]);
            Route::get("/{id:\d+}", [admin\setting\general\Read::class, "index"]);
            Route::get("", [admin\setting\general\Paging::class, "index"]);
            Route::post("", [admin\setting\general\Create::class, "index"]);
            Route::put("/{id:\d+}", [admin\setting\general\Update::class, "index"]);
            Route::delete("/{id:\d+}", [admin\setting\general\Delete::class, "index"]);
        });

        Route::prefix("/nft")->group(function () {
            Route::get("/list", [admin\setting\nft\Listing::class, "index"]);
            Route::get("/{id:\d+}", [admin\setting\nft\Read::class, "index"]);
            Route::get("", [admin\setting\nft\Paging::class, "index"]);
            Route::post("", [admin\setting\nft\Create::class, "index"]);
            Route::put("/{id:\d+}", [admin\setting\nft\Update::class, "index"]);
            Route::delete("/{id:\d+}", [admin\setting\nft\Delete::class, "index"]);
        });

        Route::prefix("/operator")->group(function () {
            Route::get("/list", [admin\setting\operator\Listing::class, "index"]);
            Route::get("/{id:\d+}", [admin\setting\operator\Read::class, "index"]);
            Route::get("", [admin\setting\operator\Paging::class, "index"]);
            Route::post("", [admin\setting\operator\Create::class, "index"]);
            Route::put("/{id:\d+}", [admin\setting\operator\Update::class, "index"]);
            Route::delete("/{id:\d+}", [admin\setting\operator\Delete::class, "index"]);
        });

        Route::prefix("/payment")->group(function () {
            Route::get("/list", [admin\setting\payment\Listing::class, "index"]);
            Route::get("/{id:\d+}", [admin\setting\payment\Read::class, "index"]);
            Route::get("", [admin\setting\payment\Paging::class, "index"]);
            Route::post("", [admin\setting\payment\Create::class, "index"]);
            Route::put("/{id:\d+}", [admin\setting\payment\Update::class, "index"]);
            Route::delete("/{id:\d+}", [admin\setting\payment\Delete::class, "index"]);
        });

        Route::prefix("/wallet")->group(function () {
            Route::get("/list", [admin\setting\wallet\Listing::class, "index"]);
            Route::get("/{id:\d+}", [admin\setting\wallet\Read::class, "index"]);
            Route::get("", [admin\setting\wallet\Paging::class, "index"]);
            Route::post("", [admin\setting\wallet\Create::class, "index"]);
            Route::put("/{id:\d+}", [admin\setting\wallet\Update::class, "index"]);
            Route::delete("/{id:\d+}", [admin\setting\wallet\Delete::class, "index"]);
        });

        Route::prefix("/walletAttribute")->group(function () {
            Route::get("/list", [admin\setting\walletAttribute\Listing::class, "index"]);
            Route::get("/{id:\d+}", [admin\setting\walletAttribute\Read::class, "index"]);
            Route::get("", [admin\setting\walletAttribute\Paging::class, "index"]);
            Route::post("", [admin\setting\walletAttribute\Create::class, "index"]);
            Route::put("/{id:\d+}", [admin\setting\walletAttribute\Update::class, "index"]);
            Route::delete("/{id:\d+}", [admin\setting\walletAttribute\Delete::class, "index"]);
        });

        Route::prefix("/withdraw")->group(function () {
            Route::get("/list", [admin\setting\withdraw\Listing::class, "index"]);
            Route::get("/{id:\d+}", [admin\setting\withdraw\Read::class, "index"]);
            Route::get("", [admin\setting\withdraw\Paging::class, "index"]);
            Route::post("", [admin\setting\withdraw\Create::class, "index"]);
            Route::put("/{id:\d+}", [admin\setting\withdraw\Update::class, "index"]);
            Route::delete("/{id:\d+}", [admin\setting\withdraw\Delete::class, "index"]);
        });
    });

    // stat
    Route::middleware([
        "auth:sanctum",
        PermissionControlMiddleware::class
    ])->prefix("/stat")->group(function () {
        Route::prefix("/sponsor")->group(function () {
            Route::get("/list", [admin\stat\sponsor\Listing::class, "index"]);
            Route::get("", [admin\stat\sponsor\Paging::class, "index"]);
            Route::get("/{id:\d+}", [admin\stat\sponsor\Read::class, "index"]);
            Route::post("", [admin\stat\sponsor\Create::class, "index"]);
            Route::put("/{id:\d+}", [admin\stat\sponsor\Update::class, "index"]);
            Route::delete("/{id:\d+}", [admin\stat\sponsor\Delete::class, "index"]);
        });
    });

    // user
    Route::middleware([
        "auth:sanctum",
        PermissionControlMiddleware::class
    ])->prefix("/user")->group(function () {
        Route::prefix("/deposit")->group(function () {
            Route::get("/list", [admin\user\deposit\Listing::class, "index"]);
            Route::get("", [admin\user\deposit\Paging::class, "index"]);
            Route::get("/{id:\d+}", [admin\user\deposit\Read::class, "index"]);
            Route::post("", [admin\user\deposit\Create::class, "index"]);
            Route::put("/{id:\d+}", [admin\user\deposit\Update::class, "index"]);
            Route::delete("/{id:\d+}", [admin\user\deposit\Delete::class, "index"]);
        });

        Route::prefix("/nft")->group(function () {
            Route::get("/list", [admin\user\nft\Listing::class, "index"]);
            Route::get("", [admin\user\nft\Paging::class, "index"]);
            Route::get("/{id:\d+}", [admin\user\nft\Read::class, "index"]);
            Route::post("", [admin\user\nft\Create::class, "index"]);
            Route::put("/{id:\d+}", [admin\user\nft\Update::class, "index"]);
            Route::delete("/{id:\d+}", [admin\user\nft\Delete::class, "index"]);
        });

        Route::prefix("/remark")->group(function () {
            Route::get("/list", [admin\user\remark\Listing::class, "index"]);
            Route::get("", [admin\user\remark\Paging::class, "index"]);
            Route::get("/{id:\d+}", [admin\user\remark\Read::class, "index"]);
            Route::post("", [admin\user\remark\Create::class, "index"]);
            Route::put("/{id:\d+}", [admin\user\remark\Update::class, "index"]);
            Route::delete("/{id:\d+}", [admin\user\remark\Delete::class, "index"]);
        });

        Route::prefix("/withdraw")->group(function () {
            Route::get("/list", [admin\user\withdraw\Listing::class, "index"]);
            Route::get("", [admin\user\withdraw\Paging::class, "index"]);
            Route::get("/{id:\d+}", [admin\user\withdraw\Read::class, "index"]);
            Route::post("", [admin\user\withdraw\Create::class, "index"]);
            Route::put("/{id:\d+}", [admin\user\withdraw\Update::class, "index"]);
            Route::delete("/{id:\d+}", [admin\user\withdraw\Delete::class, "index"]);
        });
    });

    // wallet
    Route::middleware([
        "auth:sanctum",
        PermissionControlMiddleware::class
    ])->prefix("/wallet")->group(function () {
        Route::prefix("/transaction")->group(function () {
            Route::get("/list", [admin\wallet\transaction\Listing::class, "index"]);
            Route::get("", [admin\wallet\transaction\Paging::class, "index"]);
            Route::get("/{id:\d+}", [admin\wallet\transaction\Read::class, "index"]);
            Route::post("", [admin\wallet\transaction\Create::class, "index"]);
            Route::put("/{id:\d+}", [admin\wallet\transaction\Update::class, "index"]);
            Route::delete("/{id:\d+}", [admin\wallet\transaction\Delete::class, "index"]);
        });

        Route::prefix("/transactionDetail")->group(function () {
            Route::get("/list", [admin\wallet\transactionDetail\Listing::class, "index"]);
            Route::get("", [admin\wallet\transactionDetail\Paging::class, "index"]);
            Route::get("/{id:\d+}", [admin\wallet\transactionDetail\Read::class, "index"]);
            Route::post("", [admin\wallet\transactionDetail\Create::class, "index"]);
            Route::put("/{id:\d+}", [admin\wallet\transactionDetail\Update::class, "index"]);
            Route::delete("/{id:\d+}", [admin\wallet\transactionDetail\Delete::class, "index"]);
        });
    });

    // summary
    Route::middleware([
        "auth:sanctum",
        PermissionControlMiddleware::class
    ])->prefix("/dashboard")->group(function () {
        // Route::get("/activeUser", [admin\dashboard\ActiveUser::class, "index"]);
    });
});
