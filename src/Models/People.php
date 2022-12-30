<?php

namespace Arui\AlaSite\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class People extends Model
{
    use HasFactory;
    use SoftDeletes;


    public $table = 'peoples';

    public function department()
    {
        return $this->belongsTo(Category::class, 'department', 'id');
    }

    public function getImageAttribute()
    {
        return $this->attributes['image'] ? config('alasite.asset_url') . $this->attributes['image'] : null;
    }

    public function extensionValue ($index=''){
        if(is_null($this->extensionValue)){
            $this->extensionValue = ExtensionFieldValue::getValue('peoples',$this->id);
        }
        return $index ? $this->extensionValue[$index] ?? '' : $this->extensionValue;
    }

    public $extensionValue = null;

    /**
     * @param $pagesize
     * @param $where
     * @return mixed
     */
    public static function getPaginate ($pagesize=10,$where=[]){
        $where[] = ['site_label','=',config('alasite.site_label')];
        $where[] = ['published','=',1];
        $data = self::where($where)
            ->select(['id', 'name', 'title', 'image', 'research', 'email', 'tel', 'description', 'content', 'created_at'])
            ->orderBy('pinned', 'desc')
            ->orderBy('deleted_at', 'desc')
            ->orderBy('sort');
        if($pagesize > 0){
            $data = $data->paginate($pagesize);
        }else{
            $data = $data->get();
        }
        return $data;
    }
}
