<?php
/**
 * Created by PhpStorm.
 * User: dev
 * Date: 27/02/15
 * Time: 18:45
 */

use Repositories\Comments\CommentRepositoryInterface as Comment;

class CommentController extends BaseController {
	protected $comment;
	public function __construct(Comment $comment) {
		$this->comment = $comment;
	}


}