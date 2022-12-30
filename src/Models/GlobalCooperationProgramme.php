<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class GlobalCooperationProgramme extends Model
{
    
    use HasFactory;
    use SoftDeletes;
    public $fillable = ['cooperation_name','programme_name','code','undergraduate','graduate','type','degree','term1','term2','term1_nominate_end','term1_apply_end','term2_nominate_end','term2_apply_end','english_requirement','apply_requirement','email1','course_content','institute_limit','email2','address','publiced','published','pinned','description','extend','image','banner','site_label'];
    //记录字段信息变更
    protected static $logAttributes = ['*'];
    //记录所以fillabel变更
    protected static $logFillable = true;
}
