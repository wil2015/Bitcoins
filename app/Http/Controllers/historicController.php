<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Management\CurrentAccount;
use App\Http\Management\AccountBitcoin;
use App\Http\Management\AccountHistoric;
use Illuminate\Support\Facades\Auth;
use  App\User;

class historicController extends Controller
{
    //
	// lista as 

    private $token;

      public function __construct()
    {
        $this->middleware('auth');
        $user = User::find(Auth::id());
        
        if ($user == NULL) return;

        $this -> token = $user->remember_token;

    }

    public function moviment ($id)
    {

         $token = $this -> token;
    	 $moviment = AccountHistoric::moviment($id);
         
         return view('historic.table')->with(compact('moviment', 'id', 'token'));
    }

    //deleata os antigos 
    public function delete ()
    {


    }
}
