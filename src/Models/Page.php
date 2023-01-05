<?php

namespace Arui\AlaSite\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Page extends Model
{
    use HasFactory;

    use SoftDeletes;

    //记录字段信息变更
    protected static $logAttributes = ['*'];

    public function parent()
    {
        return $this->hasOne(Page::class, 'id', 'parent_id');
    }


    //子分类
    public function childs()
    {
        return $this->hasMany(Page::class, 'parent_id', 'id')
            ->select(['id', 'name', 'sort', 'sub_name', 'created_at', 'parent_id', 'site_label', 'description', 'image', 'banner', 'redirect', 'content'])
            ->where('published',1)
            ->orderBy('sort','asc');
    }


    //所有子类
    public function allChilds()
    {
        return $this->childs()->with(['allChilds' => function ($query) {
            $query->where('published', 1);
        }])->where('pages.published', 1)->orderBy('sort')
            ->select([
                'pages.id', 'pages.name', 'pages.sub_name', 'pages.parent_id',
                'pages.site_label', 'pages.author', 'pages.short_tag', 'pages.tag',
                'pages.description', 'pages.image', 'pages.banner', 'pages.redirect',
                'pages.sort', 'pages.published', 'pages.content', 'pages.created_at'
            ]);
    }

    // 一级分类
    public function children()
    {
        return $this->childs()->select(['pages.id', 'pages.name', 'pages.sub_name', 'pages.parent_id', 'pages.site_label', 'pages.author', 'pages.short_tag', 'pages.tag', 'pages.description', 'pages.image', 'pages.banner', 'pages.redirect', 'pages.sort', 'pages.published', 'pages.created_at'])
            ->orderBy('pages.sort');
    }

    public function getImageAttribute()
    {
        return $this->attributes['image'] ? config('alasite.asset_url')  . $this->attributes['image'] : null;
    }

    public function getBannerAttribute()
    {
        return $this->attributes['banner'] ? config('alasite.asset_url')  . $this->attributes['banner'] : null;
    }

    public function getCreatedAtAttribute()
    {
        return date('Y-m-d H:i:s', strtotime($this->attributes['created_at']));
    }

    public function getUpdatedAtAttribute()
    {
        return date('Y-m-d H:i:s', strtotime($this->attributes['updated_at']));
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
            $content = str_replace('/storage',config('alasite.asset_url').'/storage',$content);
        }
        return $content ? $content : null;
    }

    public function extensionValue ($index=''){
        if(is_null($this->extensionValue)){
            $this->extensionValue = ExtensionFieldValue::getValue('pages',$this->id);
        }
        return $index ? $this->extensionValue[$index] ?? '' : $this->extensionValue;
    }

    public $extensionValue = null;

}
