<?php 

class ETP {
	
	protected $timeout; 
	protected $xml; 
	protected $result; 
	public function __construct($timeout = 10){
		$this->timeout = $timeout; 
	}

	public function getCompanyList(){
		$xml = $this->makeHTTPRequest(); 
		$this->parseData($xml); 
		
		return $this->result; 
	}

	private function makeHTTPRequest(){
		
		return 
		'<companies >
			<company>
				<id>65</id>
				<inn>6145010571</inn>
				<kpp>614501001</kpp>
				<date_accept type="customer">2011-11-22 15:43:31+04</date_accept>
			</company>
			<company>
				<id>66</id>
				<inn>2325019880</inn>
				<kpp>772501001</kpp>
				<date_accept type="customer">2012-03-26 16:01:36+04</date_accept>
			</company>
		</companies>';
	}

	private function parseData($xml_string = false){
		$this->validate($xml_string); 

		$xml = simplexml_load_string($xml_string);
		$this->result = $xml; 
		return true; 
		$json = json_encode($xml);
		$this->result = json_decode($json,TRUE);
	}

	private function validate($xml = false){
		if(! $xml || empty($xml) ) throw new Exception("empty string instead of XML ", 1);
		return true; 
	}
}
