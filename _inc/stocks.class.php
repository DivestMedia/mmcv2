<?php

if(!function_exists('add_quotes')){
	function add_quotes($str) {
		return sprintf('"%s"', $str);
	}
}

class stockMarket{
	
	public function __construct(){
		
		
	}
	
	public function request($_URL = array('APPL','GOOGL','YHOO')){
		
		$_reqURL = self::cleanRequest($_URL);
		$_ret = self::apis($_reqURL);
		
		echo 'heres----------------------------------';
		
		$_stocksData = self::parseStocks($_ret);
		
		
		print_r($_stocksData);
		exit;
		return $_stocksData;
		
		
	}
	
	public function parseStocks($xml_data){
		
		$_datas = array();
		$xml = simplexml_load_string($xml_data, 'SimpleXMLElement', LIBXML_NOCDATA);
		foreach ($xml->results->quote as $item) {
			
			$_symbol = (string)$item['symbol'];
			 
			//$_sym = $item['symbol'];
			$_stockInfo = array(
				'bid' => (string)$item->Bid,
				'change' => (string)$item->Change,
				'change_percent' => (string)$item->PercentChange,
			);
			
			$_datas[$_symbol] = $_stockInfo;
			/* 
			$item->title */
			/* $creator = $item->children('dc', TRUE);
			echo '<h2>' . $item->title . '</h2>';
			echo '<p>Created: ' . $item->pubDate . '</p>';
			echo '<p>Author: ' . $creator . '</p>';
			echo '<p>' . $item->description . '</p>';
			echo '<p><a href="' . $item->link . '">Read more: ' . $item->title . '</a></p>'; */
			
			echo '-------------';
			echo "\n\n\n\n\n";
			
		}
		return $_datas;
		
	}
	
	public function cleanRequest($_URL = array('APPL','GOOGL','YHOO')){
		
		if(empty($_URL)){
			$_URL = array('APPL','GOOGL','YHOO');
		}
		
		if(is_array($_URL)){
			$_req_URL =  implode(',', array_map('add_quotes', $_URL));
		}else{
			$_req_URL = '"'.$_URL.'"';
		}
		return $_req_URL;
		
	}
	
	function apis($_req_URL ){
		$_apiURL = 'http://query.yahooapis.com/v1/public/yql?q='. urlencode('select * from yahoo.finance.quotes where symbol in ('. $_req_URL) .')&env=store://datatables.org/alltableswithkeys';
		$_ret = wp_remote_retrieve_body( wp_remote_get( $_apiURL  ) );
		//$_ret = wp_remote_get( $_apiURL  );
		
		return $_ret;
	}
	
}



