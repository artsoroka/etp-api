<?php 

class ETP {
	
	protected $timeout; 
	protected $xml; 
	protected $result; 
	protected $connection = false; 
	protected $connection_options; 
	protected $url; 
	protected $http_response = array(); 

	public function __construct($timeout = 10){
		$this->timeout = $timeout; 
	}

	public function getProcedures(){
		$this->url = "https://etp.gpb.ru/api/procedures.php"; 
		$this->setUrlOffset(0); 	
		$xml = $this->makeHTTPRequest(); 
		$this->parseData($xml); 

		return $this->result; 

	}

	public function getCompanyList(){
		$this->url = "https://etp.gpb.ru/api/company_list.php";
		$xml = $this->makeHTTPRequest(); 
		$this->parseData($xml); 
		
		return $this->result; 
	}

	private function setUrlOffset($offset = 0){

		if($offset){
			$this->url .= "?late=" . $offset; 
		}

	}

	private function configureConnection($url = false){
		
		if ( ! $url || empty($url) ) throw new Exception("empty string instead of url", 1);

		$this->connection_options = array(
        	CURLOPT_RETURNTRANSFER => true,     // return web page
        	CURLOPT_HEADER         => false,    // don't return headers
        	CURLOPT_FOLLOWLOCATION => true,     // follow redirects
        	CURLOPT_ENCODING       => "",       // handle all encodings
        	CURLOPT_USERAGENT      => "badlab", // who am i
        	CURLOPT_AUTOREFERER    => true,     // set referer on redirect
        	CURLOPT_CONNECTTIMEOUT => 120,      // timeout on connect
        	CURLOPT_TIMEOUT        => 120,      // timeout on response
        	CURLOPT_MAXREDIRS      => 100,       // stop after 10 redirects
        	CURLOPT_SSL_VERIFYPEER => false     // Disabled SSL Cert checks
    	);

		$this->connection = ($this->connection)?: curl_init($url); 
		curl_setopt_array( $this->connection, $this->connection_options);

	}

	private function makeHTTPRequest(){
		$this->configureConnection($this->url); 

		$content = curl_exec( $this->connection );
    	$err     = curl_errno( $this->connection );
    	$errmsg  = curl_error( $this->connection );
    	$header  = curl_getinfo( $this->connection );
    	curl_close( $this->connection );		
		
    	return $content; 

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
/*
		$this->result = $xml; 
		return true; 

*/		$json = json_encode($xml);
		$this->result = json_decode($json,TRUE);
	}

	private function validate($xml = false){
		if(! $xml || empty($xml) ) throw new Exception("empty string instead of XML ", 1);
		return true; 
	}
}
