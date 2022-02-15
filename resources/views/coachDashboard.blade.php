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
                <div class="m-3 p-3 bg-white border-b border-gray-200 text-xl">
                    Welcome Back, {{$user->name}} {{$user->surname}}
                </div>
                <div class="p-3 m-3 text-lg">Here are your course coaching:</div>

                @foreach($skills as $skill)
                    <div class="m-3">
                    <li class="p-3 m-3 bg-indigo-100 border-2 rounded-md text-lg">{{$skill}}</li>
                    <div class="grid grid-cols-6">
                        @foreach($user->showUsersCoachedList($user, $skill ) as $coached_user)
                            <div class="col-span-1 border-2 bg-gray-50 m-2">
                                {{$coached_user->name}} , {{$coached_user->surname}}
                            </div>
                        @endforeach
                    </div>
            </div>
                @endforeach

            </div>
        </div>
    </div>
</x-app-layout>
