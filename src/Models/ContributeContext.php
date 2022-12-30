<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class ContributeContext extends Model
{

    use HasFactory;
    use SoftDeletes;
    //文章所属分类
    public function category()
    {
        return $this->morphToMany('App\Models\Category', 'relationship', 'relationships', 'item_id', 'target_id');
    }

    public function user(){
        return $this->hasOne(ContributeOrganizationUser::class,'employee_code','employee_code');
    }

    public function inspector(){
        return $this->hasOne(ContributeOrganizationUser::class,'employee_code','inspector_employee_code');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function organization(){
        return $this->hasMany(ContributeOrganization::class,'id','organization_id');
    }

    public function  getSubmitedAtAttribute(){
        if(isset($this->attributes['submited_at']) && !empty($this->attributes['submited_at'])){
            return date('Y-m-d',strtotime($this->attributes['submited_at']));
        }
        return "";
    }

    public function  getPlatformAttribute(){
        if(isset($this->attributes['platform'])){
            return json_decode($this->attributes['platform'],true);
        }else{
            return  isset($this->attributes['platform'])?$this->attributes['platform']:"";
        }
    }

    public function process(){
        return $this->hasMany(ContributeContextProcess::class,'contribute_context_id','id');
    }
}
