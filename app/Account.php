<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    //
		      protected $fillable = ['user_id'];

       public function extrato()
    {
        return $this->hasMany('Historic');
    }
}
