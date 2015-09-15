<?php

namespace Serverdox;

use Serverdox\Connection\RestClient;
use Serverdox\Objects\Monitors;
use Serverdox\Objects\Contacts;
use Serverdox\Objects\Logs;


class Serverdox {

	protected $restClient;

	public $monitors;
	public $contacts;
	public $logs;

	public function __construct($api_key = null, $apiEndpoint = "api.serverdox.com", $apiVersion = "v1", $ssl = true){

		$this->restClient = new RestClient($api_key, $apiEndpoint, $apiVersion, $ssl);

		$this->monitors = new Monitors($this->restClient);
		$this->contacts 	= new Contacts($this->restClient);
		$this->logs 	= new Logs($this->restClient);

	}

}

