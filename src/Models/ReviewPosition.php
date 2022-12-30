<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class ReviewPosition extends Model
{
    
    use HasFactory;
    use SoftDeletes;
    public $table = 'review_positions';
    public $fillable = ['site_label','context_type','context_id','plot_id','step_id','review_status'];
    //记录字段信息变更
    protected static $logAttributes = ['*'];
    //记录所以fillabel变更
    protected static $logFillable = true;
}
