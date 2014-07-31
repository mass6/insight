<?php namespace Insight\Permissions;
use Laracasts\Commander\CommandHandler;
use Laracasts\Commander\Events\DispatchableTrait;
/**
 * Insight Client Management Portal:
 * Date: 7/29/14
 * Time: 1:35 AM
 */

abstract class GroupCommandHandler implements CommandHandler
{
    use DispatchableTrait;

    /**
     * @var GroupRepository
     */
    protected $group;

    public function __construct(GroupRepository $group)
    {
        $this->group = $group;
    }

    protected function serializePermissions($permissions)
    {
        if (! empty($permissions)){
            $serialized = [];
            foreach ($permissions as $permission)
            {
                $serialized[$permission] = 1;
            }
            return $serialized;

        } else
            return [];

    }


} 