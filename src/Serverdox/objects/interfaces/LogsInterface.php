<?php

namespace Serverdox\Objects\Interfaces;

interface LogsInterface {

	public function get($object_id);
	public function all($object_id, $args = null);

}