<?php

namespace Arui\AlaSite\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class BaseModel extends Model
{
    use SoftDeletes;

    public $timestamps = true;

    protected $guarded = [
        "created_at",'updated_at','deleted_at'
    ];

    protected $hidden = [
        'deleted_at',
        'updated_at'
    ];

    protected $casts = [
        "status" => "boolean"
    ];

    protected static $instance = null;

    protected function timeFormatMin ($value){
        return $value ? date("Y/m/d H:i",$value) : '';
    }

    protected function timeFormat ($value,$format="Y/m/d H:i:s"){
        return $value ? date($format,$value) : '';
    }

    protected function dateFormat ($value,$format="Y/m/d"){
        return $value ? date($format,$value) : '';
    }

    protected function setTimeFormat ($key,$value){
        $this->attributes[$key] = $value ? strtotime($value) : null;
    }

    //自动维护时间戳格式转换
    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }


    /**
     * @param $pagesize
     * @param $where
     * @return mixed
     */
    public static function getPaginate ($pagesize,$where=[]){
        $data = self::where($where)
            ->orderBy('created_at','desc');
        if($pagesize > 0){
            $data = $data->paginate($pagesize);
        }else{
            $data = $data->get();
        }
        return $data;
    }

    public static function __callStatic($method, $parameters)
    {
        if(is_null(self::$instance)){
            self::$instance = new static();
        }
        return self::$instance->$method(...$parameters);
    }

}
