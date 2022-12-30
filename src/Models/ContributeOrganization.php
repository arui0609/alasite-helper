<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class ContributeOrganization extends Model
{
    
    use HasFactory;
    public $table = 'contribute_organization';
    public $fillable = ['name','parent_id','enabled','site_label'];
    public $timestamps = false;
    //记录字段信息变更
    protected static $logAttributes = ['*'];
    //记录所以fillabel变更
    protected static $logFillable = true;

    public function organizationUser(){
        return $this->hasMany(ContributeOrganizationUser::class,'organization_id','id');
    }
}
