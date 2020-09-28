<?php

namespace rayleenj\lazadaapi;

use Exception;
use rayleenj\lazadaapi\lazada_sdk\LazopClient;
use rayleenj\lazadaapi\lazada_sdk\LazopRequest;

class LazadaAPI {

	public function __construct(array $api = [])
	{
		$apiLink = ($api['apiLink']) ??  '';
		$apiKey = ($api['apiKey']) ??  '';
		$apiSecret = ($api['apiSecret']) ??  '';
		$this->apiAccessToken = ($api['apiAccessToken']) ??  '';
		$this->lazopclient =  new LazopClient($apiLink, $apiKey, $apiSecret);
		return $this->lazopclient;
	} 

	public function api_connect($api_name, $httpMethod = 'POST',$parameters = []){
		$request = new LazopRequest($api_name, $httpMethod);
		if(!empty($parameters)){
			foreach ($parameters as $key => $parameter) {
				$request->addApiParam($key, $parameter);
			}
		}
		$result = $this->lazopclient->execute($request, $this->apiAccessToken);
		$data = json_decode($result);
		return $data;
	}

}

