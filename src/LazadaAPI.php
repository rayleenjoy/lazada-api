<?php

namespace rayleenj\lazadaapi;

use Exception;
use rayleenj\lazadaapi\lazada_sdk\LazopClient;
use rayleenj\lazadaapi\lazada_sdk\LazopRequest;

class LazadaAPI {

	protected $apiLink = '';
	protected $apiKey = '';
	protected $apiSecret = '';
	protected $apiAccessToken = '';
	protected $lazopClient = '';

	public function __construct(array $api = [])
	{
		$checkValid = $this->checkValid($api);
		if(!empty($checkValid)){
			throw new Exception($checkValid,0);
		}
		$this->apiLink = $api['apiLink'];
		$this->apiKey = $api['apiKey'];
		$this->apiSecret = $api['apiSecret'];
		$this->apiAccessToken = $api['apiAccessToken'];
		$this->lazopclient =  $this->lazopclient();
		return $this->lazopclient;
	} 

	public function checkValid($api)
	{
		if(!isset($api['apiLink']) || empty($api['apiLink'])){
			return 'apiLink not defined or empty. ';
		}
		if(!isset($api['apiKey']) || empty($api['apiKey'])){
			return  'apiKey not defined or empty. ';
		}
		if(!isset($api['apiSecret']) || empty($api['apiSecret'])){
			return 'apiSecret not defined or empty.';
		}
		if(!isset($api['apiAccessToken']) || empty($api['apiAccessToken'])){
			return  'apiAccessToken not defined or empty.';
		}
		return '';
	}

	public function lazopclient(){
		return new LazopClient($this->apiLink, $this->apiKey, $this->apiSecret);
	}

	public function api_connect($api_name, $httpMethod = 'POST',$parameters = []){
		$request = new LazopRequest($api_name, $httpMethod);
		if(!empty($parameters)){
			foreach ($parameters as $key => $parameter) {
				$request->addApiParam($key, $parameter);
			}
		}
		$result = $this->lazopclient->execute($request, $this->apiAccessToken);
		return json_decode($result);
	}

}

