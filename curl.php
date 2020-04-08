<?php
        
 /**
  * 
  */
 class curl 
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
   //  var_dump($output);

	//	var_dump($output->ticker->high);
		$this->buy =$output->ticker->buy;
	//	var_dump($output->ticker->sell);
 	}

 	public function buy()
 	{
 		return $this->buy;
 	}
 }

    
$teste = new curl();
$vv = $teste->buy();
var_dump($vv);



     