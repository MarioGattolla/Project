<?php

use App\Http\Controllers\Auth\CeckUserController;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('ceck user id ',function (){
$user = User::factory()->make();

$response = app(CeckUserController::class)->show($user->id);

expect($response)->toBe('id');
});
