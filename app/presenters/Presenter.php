<?php namespace Presenters;

class Presenter {

	//Returns an instance of a model, wrapped in a presenter
	public function model(Model $model, Presentable $presenter) {
		$object = clone $presenter;
		$object->set($model);
		return $object;
	}

	//Returns an instance of a collection with each value wrapped in a presenter
	public function collection(Collection $collection, Presentable $presenter) {
		//iterate through the collection resetting the key with the wrapped value
		foreach($collection as $key => $value) {
			$collection->put($key, $this->model($value, $presenter));
		}
		return $collection;
	}

	//Returns a instance of a paginator with each value wrapped in a presenter
	public function paginator(Paginator $paginator, Presentable $presenter) {
		$items = array();
		//iterate through the paginator resetting the key with the wrapped value
		foreach($paginator->getItems() as $item) {
			$items[] = $this->model($item, $presenter);
		}
		$paginator->setItems($items);
		return $paginator;
	}



}