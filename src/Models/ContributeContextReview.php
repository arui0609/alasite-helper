<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class ContributeContextReview extends Model
{

    use HasFactory;
    
    use HasFactory;
    use SoftDeletes;
    public $table = 'contribute_context_review';
    protected $fillable = ['contribute_context_id','contribute_organization_user_id','status'];
    //记录字段信息变更
    protected static $logAttributes = ['*'];
    //记录所以fillabel变更
    protected static $logFillable = true;
}
