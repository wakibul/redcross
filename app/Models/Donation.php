<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Donation extends Model
{
    //
    use SoftDeletes;
    protected $guarded = ['id','token'];
    public function state(){
        return $this->belongsTo('App\Models\State','state_id');
    }
    public function customer(){
        return $this->belongsTo('App\Customer','customer_id');
    }
    public function country(){
        return $this->belongsTo('App\Models\Country','country_id');
    }
}
