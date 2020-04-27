<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    //
    protected $guarded = ['id','token'];
    public function memberPackage(){
        return $this->belongsTo('App\Models\MemberPackage');
    }
}
