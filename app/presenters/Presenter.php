<?php namespace Presenters;
/**
 * Service class to facilitate presentation
 * Class Presenter
 * @package Presenters
 */

use Illuminate\Database\Eloquent\Model;

class Presenter {
	/**
	 * Returns an instance of a model, wrapped in a presenter
	 * @param $model - the model we want to wrap
	 * @param Presentable $presenter - the presenter we want to wrap it in
	 * @return Presentable - returns the presented model
	 */
	public function model(Model $model, Presentable $presenter) {
		$object = clone $presenter;
		$object->set($model);
		return $object;
	}
}