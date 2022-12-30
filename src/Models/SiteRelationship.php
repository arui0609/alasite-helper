<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class SiteRelationship extends Model
{
    
    use HasFactory;
    use SoftDeletes;
    protected $guarded = ['id'];
    public $fillable = ['*'];
    public $timestamps = false;
    //记录字段信息变更
    protected static $logAttributes = ['*'];
    //记录所以fillabel变更
    protected static $logFillable = true;
}
