<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

//审核策略表
class ReviewPlot extends Model
{

    
    use HasFactory;
    use SoftDeletes;
    public $table = 'review_plots';
    public $fillable = ['name','context_type','scope','enabled','site_label'];

    public $timestamps = false;
    //记录字段信息变更
    protected static $logAttributes = ['*'];
    //记录所以fillabel变更
    protected static $logFillable = true;


    public function reviewStep(){
        return $this->hasMany(ReviewStep::class,'plot_id','id');
    }
}
