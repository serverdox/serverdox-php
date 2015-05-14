<?php

namespace Serverdox\Objects;

require_once "interfaces/ContactsInterface.php";

use Serverdox\Objects\Interfaces\ContactsInterface;
use Serverdox\Connection\Exceptions\InvalidArgumentException;

class Contacts implements ContactsInterface {

	protected $restClient;

	public function __construct($restClient){
		$this->restClient = $restClient;
	}

	//GET
	public function get($object_id){

		if(!isset($object_id)){
			throw new InvalidArgumentException("Missing contact ID. Please see https://www.serverdox.com/api-docs");
		}

		return $this->restClient->get("contacts", $object_id);
	}

	//CREATE
	public function create(array $post_params){
		return $this->restClient->create("contacts", $post_params);
	}

	//UPDATE
	public function update($object_id, $post_params = array()){
		return $this->restClient->update("contacts", $object_id, $post_params);
	}

	//DELETE
	public function delete($object_id){
		return $this->restClient->delete("contacts", $object_id);
	}

	//ALL
	public function all($args = null){
		return $this->restClient->all("contacts", $args);
	}

}