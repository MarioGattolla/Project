<?php
/** @var \App\Models\Payment $payment */
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
                <form method="POST" action="/admin/payments/{{$payment->id}}" class="bg-white p-5">
                    @csrf
                    @method('PUT')

                    <x-users.form.label for="" class="text-lg">Edit the current Payment</x-users.form.label>

                    <x-users.form.label for="name" class="text-lg">User Name :</x-users.form.label>
                    <select name="user_id" id="user_id">
                        <option value="{{$payment->user_id}}">{{$payment->user->name}}</option>
                        @foreach($available_users as $user_id => $user_name)
                            <option value="{{$user_id}}">{{$user_name}}</option>
                        @endforeach
                    </select>

                    <x-users.form.label for="name" class="text-lg">Start Date :</x-users.form.label>
                    <x-users.form.label for="name" class="text-lg">{{$payment->date}}</x-users.form.label>

                    <x-users.form.label for="name" class="text-lg">Payment Quote :</x-users.form.label>
                    <x-users.form.label for="name" class="text-lg">{{$payment->quote}}</x-users.form.label>

                    <x-users.form.submit type="submit" class="ml-12" name="submit"/>

                </form>
            </x-div-box>
        </x-body-div>
    </div>

</x-app-layout>
