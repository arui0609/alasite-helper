<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class SiteConfig extends Model
{
    
    use HasFactory;
    protected $table = 'site_configs';
    protected $fillable = ['site_label','name','key_name','key_value','type','option','description'];

    protected static $ignoreChangedAttributes = ['updated_at'];
    protected static $logOnlyDirty = true;
    //记录字段信息变更
    protected static $logAttributes = ['*'];
    //记录所以fillabel变更
    protected static $logFillable = true;
    public function category()
    {
        return $this->belongsTo('App\Models\Category','key_value')->select('id','name');
    }

    public function page()
    {
        return $this->belongsTo('App\Models\Page','key_value')->select('id','name');
    }

    public static function getConfig($site_label){


        $list = SiteConfig::select(['id', 'site_label', 'key_name', 'key_value'])
            ->where('site_label', $site_label)
            ->get()
            ->toArray();
        $data = [];
        if (count($list)>0){
            foreach ($list as $k => $v){
                $data[$v['key_name']] = $v['key_value']??'';
            }
        }
        return $data;
    }
}
