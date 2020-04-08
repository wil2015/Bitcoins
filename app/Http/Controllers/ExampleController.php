<?php

namespace App\Http\Controllers;
use App\User;
class ExampleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
            $this -> account_id = User::find(1)->account;
    }

    //
}
$teste = new ExampleController();