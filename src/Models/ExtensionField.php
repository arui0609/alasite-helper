<?php

namespace Arui\AlaSite\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class ExtensionField extends Model
{

    use HasFactory;
    use SoftDeletes;

    protected $table = 'extension_field';

    public function getCreatedAtAttribute()
    {
        return date('Y-m-d H:i:s', strtotime($this->attributes['created_at']));
    }

    public function getUpdatedAtAttribute()
    {
        return date('Y-m-d H:i:s', strtotime($this->attributes['updated_at']));
    }

    public function value()
    {
        return $this->hasOne(ExtensionFieldValue::class, 'extension_field_id', 'id');
    }

    public static $fields = [];

    public static function getField ($table_name){
        if(!isset(self::$fields[$table_name])){
            $where = [
                ['table_name','=',$table_name],
                ['site_label','=',config('alasite.site_label')]
            ];
            self::$fields[$table_name] = self::where($where)
                ->orderBy('field_sort')
                ->get();
        }
        return self::$fields[$table_name];

    }
}
