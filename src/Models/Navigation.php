<?php

namespace Arui\AlaSite\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Navigation extends Model
{

    use HasFactory;
    use SoftDeletes;

    public function category()
    {
        return $this->morphToMany('App\Models\Category', 'relationship', 'relationships', 'item_id', 'target_id');
    }

    public function childs (){
        return $this->hasMany(Navigation::class,"parent_id","id")->orderBy('sort');
    }

    public function parent (){
        return $this->belongsTo(Navigation::class,"parent_id","id")->orderBy('sort');
    }

    public function getImageAttribute()
    {
        return $this->attributes['image'] ? config('alasite.site_url') . $this->attributes['image'] : null;
    }

    public function getCreatedAtAttribute()
    {
        return date('Y-m-d H:i:s', strtotime($this->attributes['created_at']));
    }

    public function getUpdatedAtAttribute()
    {
        return date('Y-m-d H:i:s', strtotime($this->attributes['updated_at']));
    }

    public static function tree ($where,$pid=0){
        $data = self::where($where)->where('parent_id', $pid)->orderBy('sort','asc')->where('published',1)->get()->toArray();
        foreach ($data as &$datum){
            if(self::where($where)->where('parent_id',$datum['id'])->first()){
                $datum['children'] = self::tree($where,$datum['id']);
            }else{
                $datum['children'] = [];
            }
        }
        return $data;
    }

    public function getSort ($id){
        $nav = self::find($id);
        $brothers = self::orderBy('sort','asc')->where('published',1)->where('parent_id',$nav->parent_id)->get();
        echo "<pre>";
        print_r($brothers);
        echo "</pre>";
        die;
        foreach ($brothers as $key => $brother){
            if($brother['id'] === $nav->id){
                return $key;
            }
        }
        return null;
    }
}
