<?php

namespace App\Model\Database;

use zjkal\TimeHelper;

class AdminPermissionModel extends DbBase
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "admin_permission";

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
