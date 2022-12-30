<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Template extends Model
{
    
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'site_label',
        'name',
        'thumbnail',
        'html',
        'description',
        'published'
    ];

    protected static $ignoreChangedAttributes = ['updated_at'];
    protected static $logOnlyDirty = true;
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

    public static function getTemplate($site_label)
    {

        $templates = Template::select(['name', 'thumbnail', 'html'])
            ->where(['site_label' => $site_label])
            ->orderBy('created_at','desc')
            ->get()->toArray();

        return $templates;

    }
}
