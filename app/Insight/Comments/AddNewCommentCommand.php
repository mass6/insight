<?php namespace Insight\Comments;

/**
 * Class AddNewCommentCommand
 * @package Insight\Comments
 */
class AddNewCommentCommand
{

    /**
     * @var
     */
    public $commentable_id;
    /**
     * @var
     */
    public $commentable_type;
    /**
     * @var
     */
    public $user_id;
    /**
     * @var
     */
    public $body;

    /**
     * @param $commentable_id
     * @param $commentable_type
     * @param $user_id
     * @param $body
     */
    public function __construct($commentable_id, $commentable_type, $user_id, $body)
    {
        $this->commentable_id = $commentable_id;
        $this->commentable_type = $commentable_type;
        $this->user_id = $user_id;
        $this->body = $body;
    }

}