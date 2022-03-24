<?php
/** @var Subscription $subscription */
/** @var User $user */
use App\Models\Subscription;
use App\Models\User;

?>

<x-app-layout>
    <x-slot name="header">
        <x-header>
            {{ __('Edit:  ') }}
        </x-header>
    </x-slot>
    <div name="body" class="py-12">
        <x-body-div>
            <x-div-box class="border-2 border-gray-200 rounded">
                <form method="POST" action="/subscriptions/{{$subscription->id}}" class="bg-white p-5">
                    @csrf
                    @method('PUT')

                    <x-users.form.label for="" class="text-lg bg-blue-100 rounded-md">
                        Edit the current Subscription
                    </x-users.form.label>
                    <div class="p-3 bg-gray-50">
                        <x-users.form.label for="name" class="text-lg bg">
                            User Name :  {{$subscription->user->name}} {{$subscription->user->surname}}
                        </x-users.form.label>

                        <x-users.form.label for="services" class="text-lg">Select the Services</x-users.form.label>
                        @foreach(\App\Models\Service::pluck('name', 'id') as $service_id => $service_label)
                            <label class="ml-3">
                                <input type="checkbox" name="services[]" value="{{$service_id}}">
                                {{$service_label}}
                            </label>

                        @endforeach

                        <x-users.form.label for="start" class="text-lg">Subscription dates</x-users.form.label>
                        <input type="date" id="start" name="start" value="{{$subscription->start->format('Y-m-d')}}"
                               min="{{today()->format('Y-m-d')}}">
                        -
                        <input type="date" id="end" name="end" value="{{$subscription->end->format('Y-m-d')}}"
                               min="{{today()->format('Y-m-d')}}">

                        <x-users.form.submit type="submit" value="Submit" class="ml-12" name="submit"/>
                    </div>
                </form>
            </x-div-box>
        </x-body-div>
    </div>

</x-app-layout>
