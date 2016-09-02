<?php

if(!function_exists('add_quotes')){
	function add_quotes($str) {
		return sprintf('"%s"', $str);
	}
}

class stockMarket{
	
	public function __construct(){
		
		
	}
	
	public function request($_URL = array('APPL','GOOGL','YHOO'),$_from='',$_to=''){
		
		$_reqURL = self::cleanRequest($_URL);
		$_ret = self::apis($_reqURL,$_from,$_to);
		$_stocksData = self::parseStocks($_ret,$_from);
		
		return $_stocksData;
		
	}
	
	public function parseStocks($xml_data,$_from=''){
		$_datas = array();
		$xml = simplexml_load_string($xml_data, 'SimpleXMLElement', LIBXML_NOCDATA);
		
		foreach ($xml->results->quote as $item) {
			
			//range date
			if(!empty($_from)){
				
				
			}else{
			
				
				$_symbol = (string)$item['symbol'];
				 
				//$_sym = $item['symbol'];
				$_stockInfo = array(
					'bid' => (string)$item->Bid,
					'change' => (string)$item->Change,
					'change_percent' => (string)$item->PercentChange,
				);
				
				$_datas[$_symbol] = $_stockInfo;
				
			}
			
			/* 
			$item->title */
			/* $creator = $item->children('dc', TRUE);
			echo '<h2>' . $item->title . '</h2>';
			echo '<p>Created: ' . $item->pubDate . '</p>';
			echo '<p>Author: ' . $creator . '</p>';
			echo '<p>' . $item->description . '</p>';
			echo '<p><a href="' . $item->link . '">Read more: ' . $item->title . '</a></p>'; */
			
			//echo '-------------';
			//echo "\n\n\n\n\n";
			
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
	
	function apis($_req_URL ,$_from='',$_to=''){
		
		if(!empty($_from)){
			$_req_URL = self::stockDateRange($_req_URL,$_from,$_to);
		}else{
			$_req_URL = self::stockURL($_req_URL);
		}
		
		$_apiURL = 'http://query.yahooapis.com/v1/public/yql?q='. $_req_URL .'&env=store://datatables.org/alltableswithkeys';
		//echo $_apiURL ;
		$_ret = wp_remote_retrieve_body( wp_remote_get($_apiURL) );
		//$_ret = wp_remote_get( $_apiURL  );
		
		return $_ret;
	}
	
	function stockURL($_req_URL){
		$_apiURL = rawurlencode('select * from yahoo.finance.quotes where symbol in ').'('. $_req_URL .')';
		return $_apiURL;
	}
	function stockDateRange($_req_URL, $_from = '',$_to =''){
		
		if(empty($_from)){
			$_from = (string)date('Y-m-d');
		}
		if(empty($_to)){
			$_to = (string)date('Y-m-d', strtotime('-7 days'));
		}
		$_apiURL = rawurlencode('select * from yahoo.finance.historicaldata where symbol in ').'('. $_req_URL .')'
			. rawurlencode(' and startDate').'='.urlencode('"'.$_to . '"')
			. rawurlencode(' and endDate').'='.urlencode('"'.$_from . '"');
		
		return $_apiURL;
	}
}



