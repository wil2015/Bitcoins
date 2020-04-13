<?php

/**
 * 
 */
namespace App\Http\Management;
use App\Investment;
use App\User;
use Illuminate\Support\Facades\DB;
use DateTime;



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

	public static function totalofday($user_id){

		$date = date("Y-m-d");

		$totalbuy = DB::table('investments')
			->where('user_id','=', $user_id)
    		->where('operation', '=', 'C') 
	   		->whereDate('created_at', date('Y-m-d'))

			->sum('amountofbitcoin');

		$totalsaler = DB::table('investments')
    		->where('user_id','=', $user_id)
    		->where('operation', '=', 'D') 
    		->whereDate('created_at', date('Y-m-d'))
			->sum('amountofbitcoin');

		$total = ['buy' => $totalbuy, 'saler' => $totalsaler];

		return $total;

	}

	public static function clear(){

		$now = new DateTime;
		$pass = $now->modify('-90 day'); 
		$deleta =  $pass->format('Y-m-d');

		DB::table('investments')->whereDate('created_at', '<=', $deleta)->delete();

	} 
}

//$tt = HistoricInvestment::totalofday(2);
//print_r($tt);
//$tt = HistoricInvestment::clear();
//print_r($tt);
/*
$users = DB::table('users')->where([
    ['status', '=', '1'],
    ['subscribed', '<>', '1'],
])->get();

DB::table('users')->where('votes', '>', 100)->delete();
*/