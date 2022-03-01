<?php
use App\Models\User;
/** @var User[] $users */
$users = User::paginate(20);
?>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Users') }}
        </h2>
    </x-slot>
    <div class="py-12" name="body">
        <x-body-div>
            <x-div-box>
                <x-div-box>
                <x-div-box class="border-2 border-gray-200 rounded">
                    <x-nav-link href="{{route('users.create')}}">
                        Create a new user
                    </x-nav-link>
                </x-div-box>
                <x-users.table :users="$users"/>

                {{$users->links()}}
                    </x-div-box>
            </x-div-box>
        </x-body-div>

    </div>

</x-app-layout>
