<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Tymon\JWTAuth\Contracts\JWTSubject;

class ContributeOrganizationUser  extends Authenticatable implements JWTSubject
{
    
    use HasFactory;

    public $table =  'contribute_organization_user';

    public $timestamps = false;

    protected $fillable = ['name','employee_code','email','password','role','organization_id','enabled','phone','site_label'];
    //记录字段信息变更
    protected static $logAttributes = ['*'];
    //记录所以fillabel变更
    protected static $logFillable = true;
    public function getJWTIdentifier()
    {
        return $this->employee_code;
    }
    public function getJWTCustomClaims()
    {
        return [
            'role'=>'contribute'
        ];
    }
    public function site(){
        return $this->belongsTo(Sites::class,'site_label','site_label');
    }
}
