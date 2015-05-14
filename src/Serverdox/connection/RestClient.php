<?php

namespace Serverdox\Connection;

use Serverdox\Connection\Exceptions\InvalidCredentials;
use Serverdox\Connection\Exceptions\InvalidRequest;
use Serverdox\Connection\Exceptions\MissingEndpoint;
use Serverdox\Connection\Exceptions\DeniedAccess;
use Serverdox\Connection\Exceptions\ServerdoxError;
use Serverdox\Connection\Exceptions\GenericHTTPError;
use Serverdox\Connection\Exceptions\InvalidArgumentException;

class RestClient {

	protected $api_key;
	protected $apiEndpoint;
	protected $apiVersion;
	protected $ssl;

	protected $curl;

	public function __construct($api_key, $apiEndpoint, $apiVersion, $ssl){

		$this->api_key = $api_key;
		$this->apiEndpoint = $apiEndpoint;
		$this->apiVersion = $apiVersion;
		$this->ssl = $ssl;
		$this->protocol = ($this->ssl) ? "https://" : "http://";

		$this->curl = curl_init();

	}

	//GET 
	public function get($endPointUrl, $object_id){

		$this->buildRequest("GET", $endPointUrl, $object_id);
		return $this->send();
	}

	//CREATE
	public function create($endPointUrl, $post_params){
		$this->buildRequest("POST", $endPointUrl."/create", null, $post_params);
		return $this->send();
	}

	//UPDATE
	public function update($endPointUrl, $object_id, $post_params = array()){

		$this->buildRequest("POST", $endPointUrl."/update", $object_id, $post_params);
		return $this->send();
	}

	//DELETE
	public function delete($endPointUrl, $object_id){
		$this->buildRequest("DELETE", $endPointUrl."/delete", $object_id);
		return $this->send();
	}

	//ALL 
	public function all($endPointUrl, $args = null){

		if($args){
			if(!is_array($args)){
				throw new InvalidArgumentException("Argument 2 passed to ".__CLASS__.":".__FUNCTION__."() must be of the type array, ".gettype($args)." given. Please see https://www.serverdox.com/api-docs");
			}

			$endPointUrl = $endPointUrl."?".http_build_query($args);
		}

		$this->buildRequest("GET", $endPointUrl, null);
		return $this->send();
	}

	//PAUSE MONITORS
	public function pauseMonitors(){
		$this->buildRequest("POST", "monitors/pause", null);
		return $this->send();
	}

	//START MONITORS
	public function startMonitors(){
		$this->buildRequest("POST", "monitors/start", null);
		return $this->send();
	}

	//BUILD REQUEST
	private function buildRequest($method, $endPointUrl, $object_id, $post_params = array()){

		$this->curl = curl_init();
		$object_id = ($object_id) ? "/".$object_id : "";
		$request_string = $this->protocol.$this->api_key.":@".$this->apiEndpoint."/".$this->apiVersion."/".$endPointUrl.$object_id;

		if($method == "POST"){

			$post_params = http_build_query($post_params);

			curl_setopt($this->curl, CURLOPT_POSTFIELDS, $post_params);
			curl_setopt($this->curl, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($this->curl, CURLOPT_POST, true);

		} else if($method == "DELETE"){

			curl_setopt($this->curl, CURLOPT_CUSTOMREQUEST, "DELETE");
		}

		curl_setopt($this->curl, CURLOPT_URL, $request_string);
		curl_setopt($this->curl, CURLOPT_HEADER, 1);
	}


	public function send(){

		curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, 1);
		$response = curl_exec($this->curl);
		return $this->responseHander($response);

	}


	private function responseHander($response){
		
		$header_size = curl_getinfo($this->curl, CURLINFO_HEADER_SIZE);
		$response_header = explode("\n", substr($response, 0, $header_size));
		$repsonse_body = substr($response, $header_size);


		if($response_header[0]){

			$exception_array = json_decode($repsonse_body, true);

			curl_close($this->curl);

			$response_code = explode(" ", $response_header[0])[1];

			if($response_code == 200){

				return $repsonse_body;

			} elseif($response_code == 400) {

				throw new InvalidRequest($exception_array["error"]["message"]);

			} elseif($response_code == 401){

				throw new InvalidCredentials($exception_array["error"]["message"]);
				
			} elseif($response_code == 403){

				throw new DeniedAccess($exception_array["error"]["message"]);

			} elseif($response_code == 404){

				throw new MissingEndpoint($exception_array["error"]["message"]);
				
			} elseif($response_code == 500){

				throw new ServerdoxError($exception_array["error"]["message"]);
				
			} else {

				throw new GenericHTTPError("An HTTP Error has occurred! Check your network connection and try again.", $response_code, $repsonse_body);

			}

		} else {

			throw new ServerdoxError("Unable to connect to the Serverdox API, we are working hard to fix this issue.");

		}
		
	}

}