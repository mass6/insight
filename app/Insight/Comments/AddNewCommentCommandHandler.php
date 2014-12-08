<?php namespace Insight\Comments;
use Laracasts\Commander\CommandHandler;
use Laracasts\Commander\Events\DispatchableTrait;

class AddNewCommentCommandHandler implements CommandHandler
{
    use DispatchableTrait;


    public function handle($command)
    {
        // Create the Comment
        try
        {

            $comment = Comment::create([
                'commentable_id' => $command->commentable_id,
                'commentable_type' => $command->commentable_type,
                'user_id' => $command->user_id,
                'body' => $command->body
            ]);

        }
        catch (Exception $e)
        {
            return 'Could not create comment.';
        }

        //$comment->raise(new CommentWasCreated($comment));
        //$this->dispatchEventsFor($comment);

        return $comment;
    }


    /**
     * Determine who the request should be assigned to based on request status
     *
     * @param $status
     * @param $userId
     * @return mixed
     */
    protected function assignUserByStatus($status, $userId)
    {
        switch ($status){
            case "2": // submitted
                $this->wasAssigned = true;
                return Setting::where('name', 'primary-cataloguer')->pluck('value');
            case "3": // processing
                $this->wasAssigned = true;
                return Setting::where('name', 'primary-provisioner')->pluck('value');
            default:
                return $userId;
        }
    }

    protected function wasAssignedBy()
    {

    }

    /**
     * Persist each images to DB product_images table
     *
     * @param $product
     * @param $images
     */
    protected function attachImages($product, Array $images)
    {
        foreach ($images as $image)
        {
            if (! is_null($image))
            {
                ProductImage::create([
                    'imageable_id'      =>  $product->id,
                    'imageable_type'    =>  get_class($product),
                    'image'             =>  $image
                ]);
            }
        }
    }

//    protected function attachImage($product, $image)
//    {
//        if (! is_null($image))
//        {
//            ProductImage::create([
//                'imageable_id'      =>  $product->id,
//                'imageable_type'    =>  get_class($product),
//                'image'             =>  $image
//            ]);
//        }
//    }

    /**
     * Persist each attachment to DB product_attachments table
     *
     * @param $product
     * @param $attachments
     */
    protected function attachAttachments($product, $attachments)
    {
        foreach ($attachments as $attachment)
        {
            if (! is_null($attachment)) {
                ProductAttachment::create([
                    'attachable_id' => $product->id,
                    'attachable_type' => get_class($product),
                    'attachment' => $attachment
                ]);
            }
        }
    }
}