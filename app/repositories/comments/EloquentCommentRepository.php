<?php
/**
 * Created by PhpStorm.
 * User: dev
 * Date: 27/02/15
 * Time: 18:17
 */

namespace repositories\comments;


use Repositories\BaseEloquentRepository;

class EloquentCommentRepository extends BaseEloquentRepository implements CommentRepositoryInterface {
	public function __construct(Comment $comment) {
		$this->comment = $comment;
	}

	/**
	 * Stores a comment in the database
	 * @param array $data
	 */
	public function store(array $data) {

	}

	/**
	 * Updates a comment in the database
	 * @param array $data
	 */
	public function update(array $data) {

	}

	/**
	 * Removes a comment from the database
	 * @param array $data
	 */
	public function destroy(array $data) {

	}

}