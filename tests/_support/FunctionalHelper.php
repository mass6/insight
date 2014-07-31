<?php
namespace Codeception\Module;

use Laracasts\TestDummy\Factory as TestDummy;

// here you can define custom actions
// all public methods declared in helper class will be available in $I

class FunctionalHelper extends \Codeception\Module
{
    public function signIn($email = 'admin@admin.com', $password = 'secret')
    {
        //$this->haveAnAccount(compact('email', 'password'));

        $I = $this->getModule('Laravel4');

        $I->amOnPage('/login');
        $I->fillField('email', $email);
        $I->fillField('password', $password);
        $I->click('Sign In');
    }

    private function have($model, $overrides = [])
    {
        return TestDummy::createUser($model, $overrides);
    }

    public function haveAnAccount($overrides = [])
    {
        return $this->have('Cartalyst\Sentry\Users\Eloquent\User', $overrides);
    }
}