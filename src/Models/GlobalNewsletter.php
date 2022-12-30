<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class GlobalNewsletter extends Model
{
    
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['site_label','name','year','sub_name','banner','redirect','description','default_font_color','highlight_font_color','help_font_color','published','pinned','is_title_show','content'];

    //记录字段信息变更
    protected static $logAttributes = ['*'];
    //记录所以fillabel变更
    protected static $logFillable = true;
    //created,updated,deleted
    //protected static $recordEvents = ['deleted','updated'];

    public function post()
    {
        return $this->morphToMany('App\Models\Post', 'relationship', 'relationships', 'item_id', 'target_id');
    }

    public function event()
    {
        return $this->morphToMany('App\Models\Event', 'relationship', 'relationships', 'item_id', 'target_id');
    }

    public function  getCreatedAtAttribute(){
        return date('Y-m-d H:i:s',strtotime($this->attributes['created_at']));
    }

    public  function  getUpdatedAtAttribute(){
        return date('Y-m-d H:i:s',strtotime($this->attributes['updated_at']));
    }
}
