<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class GlobalProject extends Model
{
    
    use HasFactory;
    use SoftDeletes;
    public $table = 'global_projects';
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

    public function  getCreatedAtAttribute(){
        return date('Y-m-d H:i:s',strtotime($this->attributes['created_at']));
    }

    public  function  getUpdatedAtAttribute(){
        return date('Y-m-d H:i:s',strtotime($this->attributes['updated_at']));
    }
}
