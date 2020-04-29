<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Member extends Model
{
    //
    use SoftDeletes;
    protected $guarded = ['id','token'];
    public function memberPackage(){
        return $this->belongsTo('App\Models\MemberPackage','member_package_id');
    }
    public function customer(){
        return $this->belongsTo('App\Customer','customer_id');
    }
}
