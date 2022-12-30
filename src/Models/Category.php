<?php

namespace Arui\AlaSite\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Category extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'categories';

    //子分类
    public function childs()
    {
        return $this->hasMany(Category::class,'parent_id','id');
    }

    public function parent()
    {
        return $this->hasOne(Category::class,'id','parent_id');
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

    public function childIds (){
        return $this->childs->pluck('id')->toArray();
    }

    //分类下所有的文章
//    public function articles()
//    {
//        return $this->hasMany('App\Models\Article');
//    }
    /**
     * 获取分类下所有的文章
     */
    public function posts()
    {
        return $this->morphedByMany('App\Models\Post', 'relation_ship');
    }
}
