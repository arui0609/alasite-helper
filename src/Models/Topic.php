<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Topic extends Model
{
    
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'site_label',
        'name',
        'published',
        'description',
        'image',
        'banner',
        'parent_id',
        'content',
        'sort',
        'segment',
        'label',
        'redirect'
    ];
    //记录字段信息变更
    protected static $logAttributes = ['*'];
    //记录所以fillabel变更
    protected static $logFillable = true;
}
