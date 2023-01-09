<?php

namespace Arui\AlaSite\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Event extends Model
{

    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['site_label', 'name', 'sub_name', 'author', 'image', 'start_time', 'end_time', 'location', 'redirect', 'enroll_url', 'description', 'content', 'label', 'sort', 'view', 'pinned', 'published', 'created_time'];

    //文章所属分类
    public function category()
    {
        return $this->morphToMany(Category::class, 'relationship', null, 'item_id', 'target_id');
    }

    public function getCreatedAtAttribute()
    {
        return date('Y-m-d H:i:s', strtotime($this->attributes['created_at']));
    }

    public function getUpdatedAtAttribute()
    {
        return date('Y-m-d H:i:s', strtotime($this->attributes['updated_at']));
    }

    public function getImageAttribute()
    {
        return $this->attributes['image'] ? config('alasite.asset_url') . $this->attributes['image'] : null;
    }

    public function getDescriptionAttribute()
    {
        $description = $this->attributes['description'];
        if ($description) {
            $description = str_replace('&ldquo;', '“', $description);
            $description = str_replace('&rdquo;', '”', $description);
            $description = str_replace('&lsquo;', '‘', $description);
            $description = str_replace('&rsquo;', '’', $description);
        }
        return $description ? $description : null;
    }

    public function getContentAttribute()
    {
        $content = $this->attributes['content'];
        if ($content) {
            $content = str_replace('&ldquo;', '“', $content);
            $content = str_replace('&rdquo;', '”', $content);
            $content = str_replace('&lsquo;', '‘', $content);
            $content = str_replace('&rsquo;', '’', $content);
        }
        return $content ? $content : null;
    }

    public static function getPaginate ($pagesize,$where=[]){
        $where[] = ['site_label','=',config('alasite.site_label')];
        $where[] = ['published','=',1];
        $data = self::where($where)
            ->select(['id', 'description', 'name', 'image', 'created_time', 'start_time', 'end_time', 'location', 'redirect','enroll_url'])
            ->orderBy('pinned','desc')
            ->orderBy('sort')
            ->orderBy('start_time', 'desc');
        if($pagesize > 0){
            $data = $data->paginate($pagesize);
        }else{
            $data = $data->get();
        }
        return $data;
    }
}
