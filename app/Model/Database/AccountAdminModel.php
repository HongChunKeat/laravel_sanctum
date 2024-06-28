<?php

namespace App\Model\Database;

use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\MustVerifyEmail;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Laravel\Sanctum\HasApiTokens;
use zjkal\TimeHelper;

class AccountAdminModel extends DbBase implements
    AuthenticatableContract,
    AuthorizableContract,
    CanResetPasswordContract
{
    use HasApiTokens, Authenticatable, Authorizable, CanResetPassword, MustVerifyEmail;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "account_admin";

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = "id";

    /**
     * All fields inside the $guarded array are not mass-assignable
     *
     * @var string
     */
    protected $guarded = ["id", "deleted_at"];

    /**
     * Get the formatted created_at timestamp.
     *
     * @var string
     */
    public function getCreatedAtAttribute($value)
    {
        return TimeHelper::format("Y-m-d H:i:s", $value);
    }

    /**
     * Get the formatted updated_at timestamp.
     *
     * @var string
     */
    public function getUpdatedAtAttribute($value)
    {
        return TimeHelper::format("Y-m-d H:i:s", $value);
    }
}
