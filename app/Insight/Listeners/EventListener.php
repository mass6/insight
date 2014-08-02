<?php namespace Insight\Listeners;
use ReflectionClass;

/**
 * Insight Client Management Portal:
 * Date: 8/2/14
 * Time: 1:21 PM
 */

class EventListener 
{
    public function handle($event)
    {
        $eventName = $this->getEventName($event);

        if ($this->listenerIsRegistered($eventName))
        {
            return call_user_func([$this, 'when'.$eventName], $event);
        }
    }

    /**
     * @param $event
     * @return string
     */
    protected function getEventName($event)
    {
        return (new ReflectionClass($event))->getShortName();
    }

    /**
     * @param $eventName
     * @internal param $method
     * @return bool
     */
    protected function listenerIsRegistered($eventName)
    {
        $method = "when{$eventName}";
        return method_exists($this, $method);
    }
} 