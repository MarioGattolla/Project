<?php

use App\Enums\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\actingAs;

test("each role can see his own dashboard", function(Role $role){
    //Prepare

    /** @var User $user */
    $user = User::factory()->role($role)->make();

    actingAs($user);

    $controller = app(\App\Http\Controllers\DashboardController::class);



    //Act
    $view = $controller->dashboard();



    //Assert


    expect($view->name())->toBe("$role->name-dashboard");
})->with(function(){
    return collect(Role::cases())->keyBy(fn(Role $role) => $role->value);
});

