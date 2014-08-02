<?php namespace Insight\Listeners;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;

/**
 * Insight Client Management Portal:
 * Date: 8/2/14
 * Time: 1:49 PM
 */

class EventingServiceProvider extends ServiceProvider
{

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $listeners = $this->app['config']->get('insight.listeners');

        foreach($listeners as $listener)
        {
            $this->app['events']->listen('Insight.*', $listener);
        }
    }
}