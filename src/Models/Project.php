<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Project extends Model
{
    
    use HasFactory;
    use SoftDeletes;
    public $table = 'projects';
    public $fillable = ['name','label','site_label','published','open_time','end_time','content','sort','segment','description','image','banner','parent_id','redirect'];
    //记录字段信息变更
    protected static $logAttributes = ['*'];
    //记录所以fillabel变更
    protected static $logFillable = true;
    //项目所属分类
    public function category()
    {
        return $this->morphToMany('App\Models\Category', 'relationship', 'relationships', 'item_id', 'target_id');
    }

    public function getImageAttribute()
    {
        return $this->attributes['image'] ? env('SITE_URL') . $this->attributes['image'] : null;
    }

    public function getBannerAttribute()
    {
        return $this->attributes['banner'] ? env('SITE_URL') . $this->attributes['banner'] : null;
    }

    public function getDescriptionAttribute()
    {
        $description = $this->attributes['description'];
        if ($description) {
            $description = str_replace('&ldquo;', '“', $description);
            $description = str_replace('&rdquo;', '“', $description);
        }
        return $description ? $description : null;
    }

}
