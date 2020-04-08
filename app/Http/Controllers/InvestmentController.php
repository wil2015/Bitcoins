<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Http\Management\HistoricInvestment;
use App\Http\Management\BitcoinQuote;

use  App\User;


class InvestmentController extends Controller
{
    //

    private $token;

      public function __construct()
    {
        $this->middleware('auth');
        $user = User::find(Auth::id());

        if ($user == NULL) return;

        $this -> token = $user->remember_token;

        $q = new BitcoinQuote();

        $this -> quote      = $q -> buy();      //verifica a cotacao do bitcoin para compra
        $this -> saler      = $q -> sel();


    }

    // 
    //   Lista as movimentações de bitcoins
    //

    public function moviment ($id)
    {

       $token = $this -> token;
    	 $moviment = HistoricInvestment::moviment($id, $this->quote, $this->saler);
      //$data['data'] = $moviment;

     //  var_dump(json_encode($data));

         
       return view('historic.tableinvestment')->with(compact('moviment', 'id', 'token'));
    }

    //deleata os antigos 
}
