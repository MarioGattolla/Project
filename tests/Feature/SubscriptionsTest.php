<?php
use App\Enums\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\actingAs;

uses(RefreshDatabase::class);

test('only admin can see subscriptions page', function ($role){

    /** @var User $user */
    $user = User::factory()->role($role)->create();

    $response = actingAs($user)->get('/admin/subscriptions');

    $response->assertStatus(403);
})->with(function(){
    return collect(Role::cases())->keyBy(fn(Role $role) => $role->value)->except('Admin');
});

