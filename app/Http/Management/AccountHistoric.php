<?php

/**
 * 
 */
namespace App\Http\Management;
use App\Historic;
use App\User;


class AccountHistoric 
{
	
	

	// grava o historio  de movimentações
	public static function store($account, $value, $operation, $user_id)
	{

		$value = ($operation == "D") ? $value * -1: $value * 1;
		$historic 				= New Historic; 
		$historic -> account_id = $account;
		$historic -> operation	= $operation;
		$historic -> value 		= $value;
		$historic -> user_id 	= $user_id;
		$historic -> save(); 
		return true;

	}

	// lista o historico de movimentações do usuario. 
	public static function moviment($user_id)
	{
		$moviment 				= User::find($user_id)->moviment;

		return $moviment;


	}
}
