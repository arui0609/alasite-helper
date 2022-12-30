<?php

namespace Arui\AlaSite\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class ExtensionFieldValue extends Model
{

    use HasFactory;
    use SoftDeletes;

    protected $table = 'extension_field_value';
    protected $hidden = ['deleted_at'];

    public function getCreatedAtAttribute()
    {
        return date('Y-m-d H:i:s', strtotime($this->attributes['created_at']));
    }

    public function getUpdatedAtAttribute()
    {
        return date('Y-m-d H:i:s', strtotime($this->attributes['updated_at']));
    }

    public static function getValue ($table_name,$table_key_id){
        $fields = ExtensionField::getField($table_name);
        $values = ExtensionFieldValue::where(['table_name'=>$table_name,'table_key_id'=>$table_key_id])->pluck('value_content','extension_field_id')->toArray();
        $datas = [];
        foreach ($fields as $field){
            $datas[$field['field_name']] = $values[$field['id']] ?? '';
            if($field['field_type'] === 'file'){
                $datas[$field['field_name']] = config('alasite.asset_url') . $datas[$field['field_name']];
            }
        }
        return $datas;
    }
}
