<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InvestmentEmail extends Mailable
{
    use Queueable, SerializesModels;

    private $user;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($value, $amount, $operation, $price)
    {
        //
        $this->value     = $value;
        $this->amount    = $amount;
        $this->operation = $operation;
        $this->price     = $price;   
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        return $this->markdown('email.bitcoin.operation')
                    ->subject('Seu Investimento!!!')
                    ->with([
                        'value'     => $this->value,
                        'amount'    => $this->amount,
                        'operation' => $this->operation, 
                        'price'     => $this->price
                    ]);

                    
    }
}
