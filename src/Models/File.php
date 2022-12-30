<?php

namespace Arui\AlaSite\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;


class File extends BaseModel
{
    use HasFactory;
    use SoftDeletes;

    //文件所属分类
    public function folder()
    {
        return $this->morphToMany('App\Models\Folder', 'relationship', 'relationships', 'item_id', 'target_id');
    }

    public function getCreatedAtAttribute()
    {
        return date('Y-m-d H:i:s', strtotime($this->attributes['created_at']));
    }

    public function getUpdatedAtAttribute()
    {
        return date('Y-m-d H:i:s', strtotime($this->attributes['updated_at']));
    }

    public function getThumbnailAttribute()
    {
        return $this->attributes['thumbnail'] ? config('alasite.asset_url') . $this->attributes['thumbnail'] : null;
    }

    public function getPathAttribute()
    {
        return $this->attributes['path'] ? config('alasite.asset_url') . $this->attributes['path'] : null;
    }

    public static function getList ($where){
        return self::where($where)
            ->where('published', 1)
            ->orderBy('sort')->get(['id', 'path', 'name', 'thumbnail', 'description', 'content', 'redirect'])
            ->toArray();
    }
}
