<?php

/**
 * 
 */
namespace App\Http\Management;
use App\Investment;
use App\User;



class HistoricInvestment 
{
	
	
	//
	// grava o historio  de movimentações de compra e venda de bitcoins
	//
	public static function store($amountofbitcoins, $bitcoinsprice, $value,  $operation, $user_id)
	{

		$value = ($operation == "D") ? $value * -1: $value * 1;
		$historic 				= New Investment; 
		$historic -> operation			= $operation;
		$historic -> value 				= $value;
		$historic -> user_id 			= $user_id;
		$historic -> amountofbitcoin		= $amountofbitcoins;
		$historic -> bitcoinsprice 		= $bitcoinsprice;
		$historic -> save(); 
		return true;

	}
	//
	// lista o historico de movimentações de bitcoins 
	// 
	public static function moviment($user_id, $buy, $saler)
	{
		$moviment 				= User::find($user_id)->investment;
		foreach ($moviment as $key => $value) {
			# code...
			if ($value -> operation == "C") {
				# code...
				$quoteday = $buy;
			}else{
				$quoteday = $saler;
			};

			if ($value->bitcoinsprice < $quoteday){
				$percentage = $quoteday - $value -> bitcoinsprice;
				$percentage = $percentage / $value->bitcoinsprice * 100;
				$literal = 'lucro';
			} else{
				$percentage = $value -> bitcoinsprice - $quoteday;
				$percentage = $percentage / $quoteday * -100;
				$literal = 'prejuizo';

			};
			$data[] = [
			 'id' => $value -> id, 
			 'operation' => $value -> operation,
			 'value' => $value -> value, 
			 'amount' => $value -> amountofbitcoin,
			 'quote' => $value -> bitcoinsprice, 
			 'data' => $value -> created_at,
			 'variation' => $percentage,
			 'resultado' => $literal
			];
		}

		return $data;


	}
}
