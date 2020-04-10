<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use App\Http\Management\BitcoinQuote;
use App\Http\Management\HistoricInvestment;

use Illuminate\Support\Facades\Auth;

use  App\User;


class ExtractController extends Controller
{
    //


    private $token;
    private $quote;
    private $saler;

      public function __construct()
    {
// $this->middleware('auth');
        $user = User::find(3);

        if ($user == NULL) return;

        $this -> token = $user->remember_token;

        $q = new BitcoinQuote();

        $this -> quote      = $q -> buy();      //verifica a cotacao do bitcoin para compra
        $this -> saler      = $q -> sel();

        
    }

    // 
    //   Lista as movimentações de bitcoins
    //

    public function showbitcoin($id){

    	$token = $this -> token;

        	return view ('extract.bitcoin.datatable')->with(compact('id', 'token')); 

    }
    public function jsonbitcoin ($id)
    {

    	$token = $this -> token;
    	var_dump($this ->quote);
    	var_dump($this ->saler);
	   	$data['data'] = HistoricInvestment::moviment($id, $this->quote, $this->saler);

	   	//var_dump($data);
	   	

        return response() ->json ($data);   
         
    }
}
