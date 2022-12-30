<?php


namespace Arui\AlaSite\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Relationship extends Model
{
    protected $table = "relationships";
    public $timestamps = false;

    public static function getItemID ($relationship_type,$target_type,$target_id){
        $where = [
            ['relationship_type','=',$relationship_type],
            ['target_type' ,'=', $target_type],
        ];
        if(is_array($target_id)){
            $target_id = implode(',',$target_id);
            $where[] = [DB::raw("target_id in ({$target_id})"), 1];
        }else{
            $where['target_id'] = $target_id;
        }
        return self::where($where)->pluck('item_id')->toArray();
    }
}
