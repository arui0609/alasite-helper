<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class ContributeContextProcess extends Model
{
    use HasFactory;
    
    use HasFactory;
    use SoftDeletes;
    public $table = 'contribute_context_process';
    protected $fillable = ['contribute_context_id','from_employee_code','from_name','to_employee_code','to_name','status','status_desc'];
    //记录字段信息变更
    protected static $logAttributes = ['*'];
    //记录所以fillabel变更
    protected static $logFillable = true;
}
