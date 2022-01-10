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
                <form method="POST" action="/admin/inscriptions/{{$inscription->id}}" class="bg-white p-5">
                    @csrf
                    @method('PUT')

                    <x-users.form.label for="" class="text-lg">Edit the current Inscription</x-users.form.label>

                    <x-users.form.label for="name" class="text-lg">User Name :</x-users.form.label>
                    <select name="user_id" id="user_id">
                        <option value="{{$inscription->user_id}}">{{$inscription->user->name}}</option>
                        @foreach($available_users as $user_id => $user_name)
                            <option value="{{$user_id}}">{{$user_name}}</option>
                        @endforeach
                    </select>

                    <x-users.form.label for="name" class="text-lg">Service :</x-users.form.label>
                    <select name="service_id" id="service_id">
                        <option value="{{$inscription->service_id}}"></option>
                        @foreach($available_services as $service_id => $service_name)
                            <option value="{{$service_id}}">{{$service_name}}</option>
                        @endforeach
                    </select>

                    <x-users.form.label for="name" class="text-lg">Inscription Time :</x-users.form.label>
                    <x-users.form.label for="name" class="text-lg">{{$inscription->time}}</x-users.form.label>

                    <x-users.form.label for="name" class="text-lg">Start Date :</x-users.form.label>
                    <x-users.form.label for="name" class="text-lg">{{$inscription->start}}</x-users.form.label>

                    <x-users.form.label for="name" class="text-lg">End Date :</x-users.form.label>
                    <x-users.form.label for="name" class="text-lg">{{$inscription->end}}</x-users.form.label>

                    <x-users.form.submit type="submit" class="ml-12" name="submit"/>

                </form>
            </x-div-box>
        </x-body-div>
    </div>

</x-app-layout>
