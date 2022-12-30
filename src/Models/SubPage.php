<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class SubPage extends Model
{
    
    use HasFactory;
    use SoftDeletes;
    public $fillable = ['parent_id','banner','name','content','sort','image','description','published','site_label'];
    //记录字段信息变更
    protected static $logAttributes = ['*'];
    //记录所以fillabel变更
    protected static $logFillable = true;

    public function getBannerAttribute()
    {
        return $this->attributes['banner'] ? env('SITE_URL') . $this->attributes['banner'] : null;
    }
    public function getImageAttribute()
    {
        return $this->attributes['image'] ? env('SITE_URL') . $this->attributes['image'] : null;
    }
}
