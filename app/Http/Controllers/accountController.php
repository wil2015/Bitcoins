<?php

namespace App\Http\Controllers;
use App\Http\Management\CurrentAccount;
use App\Http\Management\AccountHistoric;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use  App\User;


class AccountController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
  
    private $token;

    //
     public function __construct()
    {
        $this->middleware('auth');
        
        $user = User::find(Auth::id());

        if ($user == NULL) return;


        $this -> token = $user->remember_token;


    }

    // saldo da conta
    public function balance(Request $request, $id)
    {
            $account    =  new CurrentAccount($id);

            $value      = $account->balance_inquiry();
        
    }
    //
    // retirada da conta
    //
    public function withdrawal(Request $request, $id)
    {
            $value      = $request -> input('value');
            $account    =  new CurrentAccount($id);
            $balance    = $account -> balance_inquiry();
            $token = $this ->token;

            if ($value > $balance) {

                $errors = [];
                $errors[] = 'Sem saldo';
                $value = $balance;
                return view('account.withdrawl')->with(compact('value','errors','id', 'token'));

            } else  {
                
                $account -> withdrawal($value);
            }
    
            $value      = $account->balance_inquiry();
            $token = $this -> token;
          
            return view('account.withdrawl')->with(compact('value', 'id', 'token')); 

    }

    // deposito na conta 
    public function deposit(Request $request, $id)

    {


            $token = $this ->token;
            $value      = $request -> input('value');
            $account    =  new CurrentAccount($id);
            $account -> deposit($value);
            $value      = $account->balance_inquiry(); 
         
            return view('account.deposit')->with(compact('value', 'id', 'token')); 

    }

    public function transactions(Request $request, $id)
    {

            $transaction = AccountHistoric::moviment(id);

            return $transaction;
    }

    public function showdeposit($id){

            
            $account    =  new CurrentAccount($id);

            $value      = $account->balance_inquiry();

            $user = User::find($id);

            $token = $this -> token;
          
            return view('account.deposit')->with(compact('value','id','token')); 
    }

     public function showwithdrawal($id){

            
            $account    =  new CurrentAccount($id);

            $value      = $account->balance_inquiry();



            $token = $this-> token;
          
            return view('account.withdrawl')->with(compact('value','id','token')); 
    }

    

}
