<?php

namespace Serverdox\Objects\Interfaces;

interface MonitorsInterface {

	public function get($object_id);
	public function create(array $post_params);
	public function update($object_id, $post_params = array());
	public function delete($object_id);
	public function all($args = null);
	public function pause();
	public function start();

}