<?php

namespace Arui\AlaSite\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Post extends Model
{

    use HasFactory;
    use SoftDeletes;

    protected $table = 'posts';

    //文章所属分类
    public function category()
    {
        return $this->morphToMany(Category::class, 'relationship', 'relationships', 'item_id', 'target_id');
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
        if (strpos($this->attributes['thumbnail'], 'https://smse.sjtu.edu.cn') !== false) {
            return $this->attributes['thumbnail'];
        }
        return $this->attributes['thumbnail'] ? config('alasite.asset_url') . $this->attributes['thumbnail'] : null;
    }

    public function getBannerAttribute()
    {
        return $this->attributes['banner'] ? config('alasite.asset_url') . $this->attributes['banner'] : null;
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

    /**
     * @param $pagesize
     * @param $where
     * @return mixed
     */
    public static function getPaginate ($pagesize=10,$where=[]){
        $where[] = ['site_label','=',config('alasite.site_label')];
        $data = self::where($where)
            ->select(['id', 'description', 'name', 'sub_name', 'thumbnail', 'created_time', 'redirect'])
            ->orderBy('pinned', 'desc')
            ->orderBy('created_time', 'desc')
            ->orderBy('sort');
        if($pagesize > 0){
            $data = $data->paginate($pagesize);
        }else{
            $data = $data->get();
        }
        return $data;
    }

}
