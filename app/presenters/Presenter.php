<?php namespace Presenters;

class Presenter {
	//Returns an instance of a model, wrapped in a presenter
	public function model($model, Presentable $presenter) {
		$object = clone $presenter;
		$object->set($model);
		return $object;
	}
}