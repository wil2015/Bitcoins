<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Investment extends Model
{
    //
    //
		      protected $fillable = ['user_id'];

       public function extrato()
    {
        return $this->hasMany('Investment');
    }
}
