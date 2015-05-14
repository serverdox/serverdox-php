<?php

namespace Serverdox;

//require_once "autoload.php";

use Serverdox\Connection\RestClient;
use Serverdox\Objects\Monitors;
use Serverdox\Objects\Contacts;
use Serverdox\Objects\Logs;


class Serverdox {

	protected $restClient;

	public $monitors;
	public $contacts;
	public $logs;

	public function __construct($api_key = null, $apiEndpoint = "serverdox-api.dev", $apiVersion = "v1", $ssl = false){

		$this->api_key = $api_key;
		$this->api_key = $apiEndpoint;
		$this->api_key = $apiVersion;

		$this->restClient = new RestClient($api_key, $apiEndpoint, $apiVersion, $ssl);

		$this->monitors = new Monitors($this->restClient);
		$this->contact 	= new Contacts($this->restClient);
		$this->logs 	= new Logs($this->restClient);

	}

}

