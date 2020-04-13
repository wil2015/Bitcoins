<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Validator;
use App\Http\Management\CurrentAccount;
use App\Http\Management\AccountBitcoin;
use App\Http\Management\HistoricInvestment;
use App\Http\Management\BitcoinQuote;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\InvestmentEmail;
use  App\User;


class bitcoinController extends Controller
{
    //

        private $token;
        private $buy;
        private $saler;
        private $amountbuy;
        private $amountsaler;

    //
     public function __construct()
    {
        $this->middleware('auth');
        
        $user = User::find(Auth::id());

        if ($user == NULL) return;

        $this -> token = $user->remember_token;
        $this -> email = $user->email; 

        $q = new BitcoinQuote();

        $this -> buy        = $q -> buy();      //verifica a cotacao do bitcoin para compra
        $this -> saler      = $q -> sel();
        /*
        $total =   HistoricInvestment::totalofday(Auth::id());
        $this->amountbuy = $total['buy'];
        $this->amountsaler = $total['saler']; 
        */
    }
    //
	// compra de bitcons e atualizacao de saldo em conta
    // 
    public function purchase(Request $request, $id)
    {

    	$amount 	= (int)$request -> input('qtd');
    	//$price 		= $request -> price;
      
        $purchasequote = $this->buy;
        $salequote     = $this->saler;
        $token         = $this->token; 


        $need          = $amount * $purchasequote;      //quantidade que quer comprar
        $account       = new CurrentAccount($id);
    	$balance	   = $account ->balance_inquiry();


    	if 	($need > $balance) {          //verifica se tem saldo para comprar a quantidade que quer
            $errors     = [];
            $errors[]   = 'Sem saldo';
            $total =   HistoricInvestment::totalofday($id);
            $amountbuy = $total['buy'];
            $amountsaler = $total['saler']; 
            return  view('bitcoin.purchase')->
                    with(compact('amount', 'balance','id', 'token', 'errors', 'purchasequote', 'salequote', 
                        'amountbuy', 'amountsaler'));  
    	}
    	
        $account -> withdrawal($need);        // retira o valor comprado da conta corrente 

        $bitcoin    = new AccountBitcoin($id);        
        $bitcoin -> purchasebitcoin($amount, $purchasequote, $need);        //adiciona a quantidade no bitcoin 
        $amount = $bitcoin->amount_inquiry();                               //recupera qtd atualiza para view 

        $balance    = $account ->balance_inquiry();
        $token      = $this -> token;


        Mail::to($this->email)
                ->send(new InvestmentEmail($need, $amount, 'Compra', $purchasequote));


        $total =   HistoricInvestment::totalofday($id);
        $amountbuy = $total['buy'];
        $amountsaler = $total['saler']; 
        

        return  view('bitcoin.purchase')->
                with(compact('amount', 'balance', 'id', 'token', 'purchasequote', 'salequote', 'amountbuy',
                 'amountsaler'));  

    }
    //
    // venda de bitcons e atualizacao de saldo em conta
    //
    public function sale(Request $request, $id)
    {

        $purchasequote = $this->buy;
        $salequote     = $this->saler;
        $token         = $this->token; 

    	$qtd 	        = (int)$request -> input('qtd');
        $bitcoin        = new AccountBitcoin($id);
        $amount_account = $bitcoin -> amount_inquiry();


        if ($amount_account < $qtd){    // verifica se tem a quantidade que quer vender
            $errors     = [];
            $errors[]   = 'Nao tem bitcoins em conta para a operacao';
            $balance    = $request -> input('balance');
            $amount     = $request -> input('amount');
            $total      =   HistoricInvestment::totalofday($id);
            $amountbuy  = $total['buy'];
            $amountsaler = $total['saler']; 
            return view('bitcoin.sale')
                    ->with(compact('amount', 'balance', 'errors', 'id', 'token','purchasequote', 'salequote',
                        'amountbuy', 'amountsaler'));  

        }

        $value      = $qtd * $salequote;
        $account    = new CurrentAccount($id); 
        $account -> deposit($value);        // adiciona o valor vendido na conta corrente 
        $bitcoin -> sale($qtd, $salequote, $value);             // subtrai a quantidade dos bitcoins 
        $balance    = $account ->balance_inquiry(); // recupera o valor real 
        $amount     = $bitcoin -> amount_inquiry(); // recupera a quantidade atualizada de bitcoins
        $token      = $this -> token;

        Mail::to($this->email)
                ->send(new InvestmentEmail($value, $amount, 'Venda', $salequote));

        $total          = HistoricInvestment::totalofday($id);
        $amountbuy      = $total['buy'];
        $amountsaler    = $total['saler'];  
        

        return view('bitcoin.sale')
                ->with(compact('amount', 'balance', 'id', 'token', 'purchasequote', 'salequote', 
                    'amountbuy', 'amountsaler'));  

  	

    }
    

    //
    //   Mostra a tela inicial de compra
    //

    public function showpurchase($id){

        $purchasequote      = $this->buy;
        $salequote          = $this->saler;
        $bitcoin            = new AccountBitcoin($id);
        $amount             = $bitcoin -> amount_inquiry();
        $account            =  new CurrentAccount($id);
        $balance            = $account->balance_inquiry();
        $token              = $this -> token;

        $total          = HistoricInvestment::totalofday($id);
        $amountbuy      = $total['buy'];
        $amountsaler    = $total['saler'];  

        return view('bitcoin.purchase')
                ->with(compact('amount', 'balance', 'id', 'token','purchasequote', 'salequote', 'amountbuy', 
                    'amountsaler'));  

    }

    //
    //   Mostra a tela inicial de venda
    //

    public function showsale($id){

        $purchasequote  = $this->buy;
        $salequote      = $this->saler;

        $bitcoin    = new AccountBitcoin($id);
        $amount     = $bitcoin -> amount_inquiry();
        $account    =  new CurrentAccount($id);
        $balance    = $account->balance_inquiry();
        $token = $this -> token;

        $total          = HistoricInvestment::totalofday($id);
        $amountbuy      = $total['buy'];
        $amountsaler    = $total['saler'];  
        return view('bitcoin.sale')
            ->with(compact('amount', 'balance', 'id', 'token', 'purchasequote', 'salequote',  'amountbuy', 
                'amountsaler'));  

    }
}
