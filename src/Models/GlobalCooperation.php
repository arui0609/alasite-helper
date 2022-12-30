<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class GlobalCooperation extends Model
{
    
    use HasFactory;
    use SoftDeletes;
    public $table = 'global_cooperations';
    public $fillable = ['site_label','name','code', 'region', 'country_name', 'image','cover_image', 'description', 'expire_date', 'cooperation_date', 'type', 'url','published','pinned'];
    //记录字段信息变更
    protected static $logAttributes = ['*'];
    //记录所以fillabel变更
    protected static $logFillable = true;

    public function  getCreatedAtAttribute(){
        return date('Y-m-d H:i:s',strtotime($this->attributes['created_at']));
    }

    public  function  getUpdatedAtAttribute(){
        return date('Y-m-d H:i:s',strtotime($this->attributes['updated_at']));
    }

    public function globalCooperationProgramme(){
        return $this->hasMany('App\Models\GlobalCooperationProgramme', 'code', 'code');
    }
}
