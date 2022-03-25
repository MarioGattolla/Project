<?php

/** @var User $user */

use App\Models\User;

$search_users = User::all()
    ->map(function (User $user) {
        return [$user->id, $user->name, $user->surname, $user->email];
    });

?>

<x-app-layout>
    <x-slot name="header">
        <x-header>
            {{ __('Create a new Subscription:  ') }}
        </x-header>
    </x-slot>
    <div class="py-12" name="body">
        <x-body-div>
            <x-div-box>

                <form method="POST" action="{{route('subscriptions.store')}}">
                    @csrf
                    <x-div-box class="border-gray-200 border-2 rounded">
                        <div class=" rounded-md border-2 flex-col w-1/3" x-data="{
                        open: false,
                        filter:'',
                        toggle(){this.open = ! this.open},
                        close(){this.open = false},
                         }">
                            <input class="w-full flex-col" name="filter" x-model="filter" type="search"
                                   @click="toggle()" placeholder="Search for the user..."/>
                            <div class="flex-col" x-show="open" @click.away="close()">
                                @foreach(\App\Models\User::pluck('name', 'id') as $avaiable_user_id => $avaiable_user_name)
                                    <div name="user_id" class=" p-3 rounded-md hover:bg-blue-100 border-2"
                                         value="{{$avaiable_user_id}}">{{$avaiable_user_name}}</div>
                                @endforeach
                            </div>
                        </div>

                        {{--                        @if($user->role->value == 'Admin')--}}
                        {{--                            <select name="id" >--}}
                        {{--                                @foreach(\App\Models\User::pluck('name', 'id') as $avaiable_user_id => $avaiable_user_name)--}}
                        {{--                                    <option name="user_id" value="{{$avaiable_user_id}}">{{$avaiable_user_name}}</option>--}}
                        {{--                                @endforeach--}}
                        {{--                            </select>--}}
                        {{--                        @else--}}
                        {{--                            <div class="text-lg">{{$user->name}} {{$user->surname}} , create a new Subscription</div>--}}
                        {{--                        @endif--}}


                        <x-users.form.label for="services" class="text-lg">Select the Services</x-users.form.label>
                        @foreach(\App\Models\Service::pluck('name', 'id') as $service_id => $service_label)
                            <label>
                                <input type="checkbox" name="services[]" value="{{$service_id}}">
                                {{$service_label}}
                            </label>
                        @endforeach

                        <x-users.form.label for="start" class="text-lg">Subscription dates</x-users.form.label>
                        <input type="date" id="start" name="start" value="{{today()->format('Y-m-d')}}"
                               min="{{today()->format('Y-m-d')}}">
                        -
                        <input type="date" id="end" name="end" value="{{today()->addMonth()->format('Y-m-d')}}"
                               min="{{today()->format('Y-m-d')}}">

                        <x-users.form.submit type="submit" value="Submit" name="submit" class="ml-12"/>
                    </x-div-box>
                </form>

            </x-div-box>
        </x-body-div>

    </div>

</x-app-layout>

<script>
   var sourceData = @json($search_users);
</script>
