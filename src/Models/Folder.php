<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Folder extends Model
{
    
    use HasFactory;
    public $table = 'folders';
    protected $fillable = ['name','sort','parent_id','site_label','label','published'];

    protected static $ignoreChangedAttributes = ['updated_at'];
    protected static $logOnlyDirty = true;
    //记录字段信息变更
    protected static $logAttributes = ['*'];
    //记录所以fillabel变更
    protected static $logFillable = true;



    //子分类
    public function childs()
    {
        return $this->hasMany('App\Models\Folder','parent_id','id');
    }

    public function parent()
    {
        return $this->hasOne('App\Models\Folder','id','parent_id');
    }

    //所有子类
    public function allChilds()
    {
        return $this->childs()->with('allChilds');
    }

    //所有子类
    public function children()
    {
        return $this->childs()->with('children');
    }

    //分类下所有的文章
//    public function articles()
//    {
//        return $this->hasMany('App\Models\Article');
//    }
    /**
     * 获取分类下所有的文章
     */
    public function file()
    {
        return $this->morphedByMany('App\Models\File', 'relation_ship');
    }

    public function  getCreatedAtAttribute(){
        return date('Y-m-d H:i:s',strtotime($this->attributes['created_at']));
    }

    public  function  getUpdatedAtAttribute(){
        return date('Y-m-d H:i:s',strtotime($this->attributes['updated_at']));
    }
}
