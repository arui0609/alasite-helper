<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use phpDocumentor\Reflection\Types\False_;


class ReviewStep extends Model
{
    
    use HasFactory;
    use SoftDeletes;
    public $table = 'review_steps';
    public $fillable = ['step','sort','plot_id','count','user_id','actions'];
    //记录字段信息变更
    protected static $logAttributes = ['*'];
    //记录所以fillabel变更
    protected static $logFillable = true;
    public $timestamps = false;

    public function user(){
        return $this->hasOne(Admin::class,'id','user_id')->select('id','name');
    }

    public function trigger(){
        return $this->hasMany(ReviewTrigger::class,'step_id','id');
    }
}
