<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class ReviewTrigger extends Model
{
    
    use HasFactory;
    use SoftDeletes;
    public $table = 'review_trigger';
    public $fillable = ['step_id','action','target_context_type','target_table','target_action','target_field','target_value','next_step_id',"position_review_status"];
    //记录字段信息变更
    protected static $logAttributes = ['*'];
    //记录所以fillabel变更
    protected static $logFillable = true;

    public function step(){
        return $this->hasOne(ReviewStep::class,'id','step_id');
    }

    public function nextStep(){
        return $this->hasOne(ReviewStep::class,'id','next_step_id');
    }
}
