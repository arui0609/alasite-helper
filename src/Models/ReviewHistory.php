<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class ReviewHistory extends Model
{
    
    use HasFactory;
    use SoftDeletes;
    public $table = 'review_history';
    public $fillable = ['site_label','user_id','context_type','context_id','current_step_id','next_step_id','action','comment'];
    //记录字段信息变更
    protected static $logAttributes = ['*'];
    //记录所以fillabel变更
    protected static $logFillable = true;

    public function user(){
        return $this->hasOne(Admin::class,'id','user_id')->select('id','name');
    }
}
