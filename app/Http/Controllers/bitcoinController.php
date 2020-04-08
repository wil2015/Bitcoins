<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Validator;
use App\Http\Management\CurrentAccount;
use App\Http\Management\AccountBitcoin;
use App\Http\Management\AccountHistoric;
use App\Http\Management\BitcoinQuote;
use Illuminate\Support\Facades\Auth;
use  App\User;


class bitcoinController extends Controller
{
    //

        private $token;
        private $quote;
        private $saler;

    //
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
	// compra de bitcons e atualizacao de saldo em conta
    // 
    public function purchase(Request $request, $id)
    {

    	$amount 	= (int)$request -> input('qtd');
    	//$price 		= $request -> price;
      
        $purchasequote = $this->quote;
        $salequote     = $this->saler;
        $token         = $this->token; 


        $need          = $amount * $purchasequote;      //quantidade que quer comprar
        $account       = new CurrentAccount($id);
    	$balance	   = $account ->balance_inquiry();


    	if 	($need > $balance) {          //verifica se tem saldo para comprar a quantidade que quer
            $errors     = [];
            $errors[]   = 'Sem saldo';
            return  view('bitcoin.purchase')->
                    with(compact('amount', 'balance','id', 'token', 'errors', 'purchasequote', 'salequote'));  
    	}
    	
        $account -> withdrawal($need);        // retira o valor comprado da conta corrente 

        $bitcoin = new AccountBitcoin($id);        
        $bitcoin -> purchasebitcoin($amount, $purchasequote, $need);        //adiciona a quantidade no bitcoin 
        $balance    = $account ->balance_inquiry();
        $token      = $this -> token;
        return  view('bitcoin.purchase')->
                with(compact('amount', 'balance', 'id', 'token', 'purchasequote', 'salequote'));  

    }
    //
    // venda de bitcons e atualizacao de saldo em conta
    //
    public function sale(Request $request, $id)
    {

        $purchasequote = $this->quote;
        $salequote     = $this->saler;
        $token         = $this->token; 

    	$qtd 	        = (int)$request -> input('qtd');
        $bitcoin        = new AccountBitcoin($id);
        $amount_account = $bitcoin -> amount_inquiry();


        if ($amount_account < $qtd){    // verifica se tem a quantidade que quer vender
            $errors     = [];
            $errors[]   = 'Nao tem bitcoins em conta para a operacao';
            $balance    = $request -> balance;
            $amount     = $request -> amount;
            return view('bitcoin.sale')
                    ->with(compact('amount', 'balance', 'errors', 'id', 'token','purchasequote', 'salequote'));  

        }

        $value = $qtd * $salequote;
        $account = new CurrentAccount($id); 
        $account -> deposit($value);        // adiciona o valor vendido na conta corrente 
        $bitcoin -> sale($qtd, $salequote, $value);             // subtrai a quantidade dos bitcoins 
        $balance = $account ->balance_inquiry(); // recupera o valor real 
        $amount  = $bitcoin -> amount_inquiry(); // recupera a quantidade atualizada de bitcoins
                    $token = $this -> token;


        return view('bitcoin.sale')
                ->with(compact('amount', 'balance', 'id', 'token', 'purchasequote', 'salequote'));  

  	

    }
    

    //
    //   Mostra a tela inicial de compra
    //

    public function showpurchase($id){

        $purchasequote = $this->quote;
        $salequote       = $this->saler;
        $bitcoin    = new AccountBitcoin($id);
        $amount     = $bitcoin -> amount_inquiry();
        $account    =  new CurrentAccount($id);
        $balance      = $account->balance_inquiry();
        $token = $this -> token;

        return view('bitcoin.purchase')
                ->with(compact('amount', 'balance', 'id', 'token','purchasequote', 'salequote'));  

    }

    //
    //   Mostra a tela inicial de venda
    //

    public function showsale($id){

        $purchasequote = $this->quote;
        $salequote = $this->saler;

        $bitcoin    = new AccountBitcoin($id);
        $amount     = $bitcoin -> amount_inquiry();
        $account    =  new CurrentAccount($id);
        $balance    = $account->balance_inquiry();
        $token = $this -> token;
        return view('bitcoin.sale')
            ->with(compact('amount', 'balance', 'id', 'token', 'purchasequote', 'salequote'));  

    }
}
