<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class RoleHasDataPermission extends Model
{
    
    use HasFactory;
    protected $table = 'role_has_data_permissions';
    protected $fillable = ['role_id','model_id','module'];

    protected static $ignoreChangedAttributes = ['updated_at'];
    protected static $logOnlyDirty = true;
    //记录字段信息变更
    protected static $logAttributes = ['*'];
    //记录所以fillabel变更
    protected static $logFillable = true;

}
