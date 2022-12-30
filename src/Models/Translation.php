<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Translation extends Model
{
    
    use HasFactory;

    public $table = 'translation';

    public $primaryKey = 'id'; //主键id

    protected $fillable = ['site_label','label','value','description','type'];
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
}
