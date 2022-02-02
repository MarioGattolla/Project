<?php
/** @var \App\Models\User $user */
?>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Coach Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    Welcome Back, {{$user->name}} {{$user->surname}}
                </div>
                <div>Here your course coaching:</div>
                @foreach($skills as $skill)
                    <li>{{$skill}}</li>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
