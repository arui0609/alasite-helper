<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Spatie\Permission\Exceptions\RoleAlreadyExists;
use Spatie\Permission\Guard;

class Role extends \Spatie\Permission\Models\Role
{
    
    use HasFactory;
    //记录字段信息变更
    protected static $logAttributes = ['*'];
    //记录所以fillabel变更
    protected static $logFillable = true;

    public function syncDataPermissions($role_id,$permissions,$module){
        //清空旧的数据权限
        RoleHasDataPermission::where('role_id',$role_id)->where('module',$module)->delete();
        $permissions = collect($permissions)
            ->flatten()
            ->map(function ($permission) use($module,$role_id){
                if (empty($permission)) {
                    return false;
                }
                $info['model_id'] = $permission;
                $info['module'] = $module;
                $info['role_id'] = $role_id;
                $info['created_at'] = date('Y-m-d H:i:s');
                $info['updated_at'] = date('Y-m-d H:i:s');
                return $info;
            })->toArray();
        return RoleHasDataPermission::insert($permissions);

    }

    public static function create(array $attributes = [])
    {
        $attributes['guard_name'] = $attributes['guard_name'] ?? Guard::getDefaultName(static::class);

        if (static::where('name', $attributes['name'])->where('guard_name', $attributes['guard_name'])->where('site_label',$attributes['site_label'])->first()) {
            throw RoleAlreadyExists::create($attributes['name'], $attributes['guard_name']);
        }

        return static::query()->create($attributes);
    }
}
