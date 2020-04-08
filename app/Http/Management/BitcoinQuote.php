<?php
namespace App\Http\Management;

/**
 * 
 */

// api para obter a cotacao de bitcoins 
class BitcoinQuote
{
    
    public $buy; 
    public $sell;
  
   

    function __construct()
    {
        
        $handle = curl_init();
     
        $url = "https://www.mercadobitcoin.net/api/BTC/ticker/";
     
        // Set the url
        curl_setopt($handle, CURLOPT_URL, $url);
        // Set the result output to be a string.
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
         
        $output = curl_exec($handle);
         
        curl_close($handle);
         
         $output = json_decode($output);
         //var_dump($output);


        $this->buy = $output->ticker->buy;
        $this->sell = $output->ticker->sell;

    }

    public  function sel(){

        return (float)$this->sell;
    }
        
    public  function buy(){

         return (float)$this->buy; 
    }
 
 


}


