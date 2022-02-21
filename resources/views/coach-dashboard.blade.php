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

                @foreach($user->skill()->pluck('name', 'service_id') as $skill)
                    <div class="m-3">
                        <li class="p-3 m-3 bg-indigo-100 border-2 rounded-md text-lg">{{$skill}}</li>
                        <div class="grid grid-cols-6">
                            @foreach($user->show_users_coached_list_for_skill($skill ) as $coached_user)
                                <?php /** @var \App\Models\User $coached_user */ ?>
                                <div class="modal col-span-1 border-2 bg-gray-50 m-2" x-data="{ open: false }">
                                    <button class=" w-full"
                                            @click="open = true">{{$coached_user->name}} , {{$coached_user->surname}}
                                    </button>
                                    <div
                                        class=" fixed top-0 left-0 flex items-center justify-center w-full h-full bg-indigo-100"
                                        style="background-color: rgba(0,0,0,.5);" x-show="open">
                                        <div
                                            class="h-auto p-4 mx-2 text-left bg-white rounded shadow-xl md:max-w-xl md:p-6 lg:p-8 md:mx-0"
                                            @click.away="open = false">
                                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                                <div class="text-lg p-3 m-3 text-gray-900 bg-blue-100">
                                                    {{$coached_user->name}} {{ $coached_user->surname }}
                                                </div>

                                                <div class="bg-gray-50">
                                                    @foreach($coached_user->show_user_subscribed_services() as $service)
                                                        <li>{{$service}}</li>
                                                    @endforeach
                                                </div>
                                            </div>
                                            <div class="m-3 p-3">
                                                <div class="flex w-full rounded-md ">
                                                    <button @click="open = false"
                                                            class=" justify-center w-full px-4 py-2 text-white bg-blue-500 rounded">
                                                        CHIUDI
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
</x-app-layout>
