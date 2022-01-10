<?php
/** @var \App\Models\Inscription $inscription */
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
                <x-users.form.label for="" class="text-lg">Current Inscription</x-users.form.label>

                <x-users.form.label for="name" class="text-lg">User Name : {{$inscription->user->name}}</x-users.form.label>

                <x-users.form.label for="name" class="text-lg">Service : {{$inscription->service_id}}</x-users.form.label>

                <x-users.form.label for="name" class="text-lg">Inscription Time : {{$inscription->time}}</x-users.form.label>

                <x-users.form.label for="name" class="text-lg">Start Date : {{$inscription->start}}</x-users.form.label>

                <x-users.form.label for="name" class="text-lg">End Date : {{$inscription->end}}</x-users.form.label>

                <x-button class="mb-3"><a href="{{route('inscriptions.edit', $inscription)}}">Modifica</a></x-button>
                <form method="POST">
                    @csrf
                    @method('DELETE')
                    <x-button>Delete</x-button>
                </form>
            </x-div-box>
        </x-body-div>
    </div>

</x-app-layout>
