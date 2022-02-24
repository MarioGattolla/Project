<?php
/** @var \App\Models\Subscription $subscription */
?>

<x-app-layout>
    <x-slot name="header">
        <x-header>
            {{ __('Edit:  ') }}
        </x-header>
    </x-slot>
    <div name="body" class="py-12">
        <x-body-div>
            <x-div-box>
                <div class="rounded grid grid-cols-4">
                <div class="bg-blue-50 col-span-1 rounded-md mb-3 p-3 text-xl">
                    <x-users.form.label for="">Current Subscription</x-users.form.label>

                    <x-users.form.label for="name" class="text-lg">User Name
                        : {{$subscription->user->name}}
                    </x-users.form.label>

                    <x-users.form.label for="surname" class="text-lg">User Surname
                        : {{$subscription->user->surname}}
                    </x-users.form.label>

                </div>
                <div class="col-span-3 bg-gray-50 rounded-md mb-3 p-3">
                    <x-users.form.label for="name" class="text-lg">Subscrived Services :</x-users.form.label>
                    @foreach($subscription->services()->pluck('name', 'service_id') as $service)
                        <li class="m-3 ">{{$service}}</li>
                    @endforeach

                    <x-users.form.label for="name" class="text-lg">Subscription Start
                        : {{$subscription->start->format('Y-m-d')}}</x-users.form.label>

                    <x-users.form.label for="name" class="text-lg">Subscription End
                        : {{$subscription->end->format('Y-m-d')}}</x-users.form.label>
                </div>
    </div>
    <x-button href="{{route('subscriptions.edit',$subscription)}}">Edit</x-button>

    <form method="POST">
        @csrf
        @method('DELETE')
        <x-button class="mt-3">Delete</x-button>
    </form>
    </x-div-box>
    </x-body-div>
    </div>

</x-app-layout>
