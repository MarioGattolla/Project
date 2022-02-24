<?php

/*
|--------------------------------------------------------------------------
| Test Case
|--------------------------------------------------------------------------
|
| The closure you provide to your test functions is always bound to a specific PHPUnit test
| case class. By default, that class is "PHPUnit\Framework\TestCase". Of course, you may
| need to change it using the "uses()" function to bind a different classes or traits.
|
*/

use Illuminate\Auth\Access\AuthorizationException;

uses(Tests\TestCase::class)->in('Feature');
uses(Tests\TestCase::class)->in('Unit');


expect()->extend('toBeView', function(string $name, string ...$parameters){
    expect($this->value)->toBeInstanceOf(\Illuminate\View\View::class);

    $view = $this->value;

    /** @var \Illuminate\View\View::class $view */
    expect($view->name())->toBe($name);

    if(count($parameters)>0){
        expect($view->data())->toHaveKeys($parameters);
    }
});



/*
|--------------------------------------------------------------------------
| Functions
|--------------------------------------------------------------------------
|
| While Pest is very powerful out-of-the-box, you may have some testing code specific to your
| project that you don't want to repeat in every file. Here you can also expose helpers as
| global functions to help you to reduce the number of lines of code in your test files.
|
*/

function allow_authorize(string $ability, mixed ...$params){
    Gate::shouldReceive('authorize')
        ->with($ability, ...$params)
        ->atLeast()->once()
        ->andReturn(\Illuminate\Auth\Access\Response::allow());
}

function deny_authorize(string $ability, mixed ...$params){
    Gate::shouldReceive('authorize')
        ->with($ability, ...$params)
        ->atLeast()->once()
        ->andThrow(new AuthorizationException());
}
