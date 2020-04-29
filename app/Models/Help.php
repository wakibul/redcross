<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Help extends Model
{
    //
    use SoftDeletes;
    protected $guarded = ['id','token'];
    public function customer(){
        return $this->belongsTo('App\Customer','customer_id');
    }
}
