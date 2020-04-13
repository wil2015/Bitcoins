<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Queue;
use App\Jobs\ClearHistoric;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeEmail;

class sampleController extends Controller
{

public function test_queue() {


		$to = 'wilson.f.alves@gmail.com';
	 Mail::to($to)
                ->send(new WelcomeEmail('wilson.f.alves@gmail.com'));
	for($i=0; $i<=10; $i++){
            $this->dispatch(new ClearHistoric(array('queue' => $i)));
//Queue::dispatch
		echo "successfully push";
    }
   
}

}
