<?php
namespace App\Http\Management;
use Illuminate\Database\Eloquent\Model;

use App\User;
use App\Account;
/**
 * 
 */

//
// classe responsavel pelas operaçoes de deposito, retirada e consulta  da conta corrente
//
class CurrentAccount 
{
		
		private $account_id;  //identificador da conta corrente.
		private $user_id;     //identificador do cliente

	//	
	// caso nao exista a tabela account ela e criada 		
	//
	function __construct($user_id)
	{
			
		$account 			= Account::firstOrCreate(['user_id' => $user_id]);
		$this -> account_id = $account -> id;
		$this -> user_id 	= $user_id;
	}


	//
	// deposito na conta do investidor
	//
	public  function deposit($value)
	{

		$account 			= Account::find($this ->account_id); 
		$account -> balance =  $account -> balance + $value;
		$account -> save();
		AccountHistoric::store($this->account_id, $value, "C",$this->user_id);
		return true;

	}

	//
	// retirada da conta do investidor 
	//
	public  function withdrawal($value)

	{
		
		$account 			= Account::find($this->account_id); 
		$account -> balance =  $account -> balance - $value;
		$account -> save();
		AccountHistoric::store($this->account_id, $value, "D",$this->user_id);
		return true;

	}
	//
	// consultar o saldo de uma conta
	//
	public  function balance_inquiry()
	{
		$account 			= Account::find($this->account_id); 
		$balance 			= $account-> balance;
		
		return $balance;
	}


}

