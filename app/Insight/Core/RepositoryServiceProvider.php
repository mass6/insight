<?php namespace Insight\Core; 
/**
 * Insight Client Management Portal:
 * Date: 7/27/14
 * Time: 2:16 PM
 */

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('Insight\Users\UserRepositoryInterface', 'Insight\Users\UserRepository');
    }
} 