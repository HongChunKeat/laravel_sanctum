<?php

namespace app\model\database;

class PermissionTemplateModel extends DbBase
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "permission_template";

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = "id";

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * All fields inside the $guarded array are not mass-assignable
     *
     * @var string
     */
    protected $guarded = ["id", "deleted_at"];
}
