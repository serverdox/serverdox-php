<?php

namespace Serverdox\Objects;

require_once "interfaces/LogsInterface.php";

use Serverdox\Objects\Interfaces\LogsInterface;
use Serverdox\Connection\Exceptions\InvalidArgumentException;

class Logs implements LogsInterface {

	protected $restClient;

	public function __construct($restClient){
		$this->restClient = $restClient;
	}

	//GET
	public function get($object_id){

		if(!isset($object_id)){
			throw new InvalidArgumentException("Missing log ID. Please see https://www.serverdox.com/api-docs");
		}

		return $this->restClient->get("logs", $object_id);
	}

	//ALL
	public function all($object_id, $args = null){
		return $this->restClient->all("monitors/".$object_id."/logs", $args);
	}

}