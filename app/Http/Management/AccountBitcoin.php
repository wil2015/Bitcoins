<?php

/**
 * 
 */

namespace App\Http\Management;
use App\Bitcoin;



class AccountBitcoin
{
	private $biticoin_id;   //identificador da conta bitcoin 
	private $user_id;

	function __construct($user_id)
	{
		# code...

		//$this -> bitcoin_id = User::find($id)->bitcoin;
			$bitcoin = Bitcoin::firstOrCreate(['user_id' => $user_id]);
			$this -> bitcoin_id = $bitcoin -> id;  
			$this -> user_id = $user_id;
	}


	// retorna a quantidade de bitcoins para um determinado cliente
		public function id($id)
	{

		$bitcoin = User::find($id)->bitcoin;
		return $bitcoin;

	}
	//
	//Adiciona bitcoins a conta de cliente e chama historico de investimentos
	//
	public function purchasebitcoin ($amountofbitcoins, $bitcoinsprice, $purchasedvalue)

	{
		$bitcoin = Bitcoin::find($this->bitcoin_id); 
		$bitcoin -> amount =  $bitcoin -> amount + $amountofbitcoins;
		$bitcoin -> save();
		HistoricInvestment::store($amountofbitcoins, $bitcoinsprice, $purchasedvalue,  'C', $this->user_id);
		return $bitcoin;
	}

	//
	// retira bitcoins da conta do cliente e chama historico de investimentos
	//
	public function sale ($amountofbitcoins, $bitcoinsprice, $valuesold)

	{
		$bitcoin = Bitcoin::find($this->bitcoin_id); 
		$bitcoin -> amount =  $bitcoin -> amount - $amountofbitcoins;
		$bitcoin -> save();
		HistoricInvestment::store($amountofbitcoins, $bitcoinsprice, $valuesold,  'D', $this->user_id);


		return true;

	}

	// criar uma conta bitcon
	/*
	public  function create_Bitcoin($user_id)

	{

		$bitcoin = New Bitcoin; 
		$bitcoin -> user_id = $user_id;
		$bitcoin -> save(); 
		return $bitcoin -> id;
	}
	*/
	public function amount_inquiry()
	{
		
		$bitcoin = Bitcoin::find($this->bitcoin_id); 
		$amount = $bitcoin -> amount;
		return $amount;
	}

	
}

