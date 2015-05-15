<?php

namespace Serverdox\Objects;

require_once "interfaces/MonitorsInterface.php";

use Serverdox\Objects\Interfaces\MonitorsInterface;
use Serverdox\Connection\Exceptions\InvalidArgumentException;

class Monitors implements MonitorsInterface {

	protected $restClient;

	public function __construct($restClient){
		$this->restClient = $restClient;
	}

	//GET
	public function get($object_id){

		if(!isset($object_id)){
			throw new InvalidArgumentException("Missing monitor ID. Please see https://www.serverdox.com/api-docs");
		}

		return $this->restClient->get("monitors", $object_id);
	}

	//CREATE
	public function create(array $post_params){
		return $this->restClient->create("monitors", $post_params);
	}

	//UPDATE
	public function update($object_id, $post_params = array()){
		return $this->restClient->update("monitors", $object_id, $post_params);
	}

	//DELETE
	public function delete($object_id){
		return $this->restClient->delete("monitors", $object_id);
	}

	//ALL
	public function all($args = null){
		return $this->restClient->all("monitors", $args);
	}

	//PAUSE MONITORS
	public function pause(){
		return $this->restClient->pauseMonitors();
	}

	//START MONITORS
	public function start(){
		return $this->restClient->startMonitors();
	}

}