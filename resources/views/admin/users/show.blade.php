<?php
/** @var \App\Models\User $user */
?>

<x-app-layout>
    <x-slot name="header">
        <x-header>
            {{ __('User') }}
        </x-header>
    </x-slot>
    <div class="py-12 " name="body">
        <x-body-div class="px-3">
            <div class="grid grid-cols-4 text-xl">
                <div class="bg-gray-100  m-3 p-5 rounded float-left col-span-1 ">
                    <x-users.form.label> USER DETAIL</x-users.form.label>
                    <x-users.form.label> User Photo :</x-users.form.label>

                </div>
                <div class="bg-blue-100   m-3 p-5 rounded float-left  col-span-3 ">
                    <x-users.form.label> User Name : {{$user->name}}</x-users.form.label>
                    <x-users.form.label> User Surname : {{$user->surname}}</x-users.form.label>

                    <x-users.form.label> User Role : {{$user->role->value}}</x-users.form.label>
                    <x-users.form.label> User Email : {{$user->email}}</x-users.form.label>
    {{--                    <x-users.form.label> User Balance : {{$user->balance($user)}}</x-users.form.label>--}}
                </div>


            </div>
            <div class="m-5">
            <x-button class="mb-3"><a href="{{route('users.edit', $user)}}">Edit</a></x-button>
            <form method="POST">
                @csrf
                @method('DELETE')
                <x-button>Delete</x-button>
            </form>
            </div>
        </x-body-div>

    </div>

</x-app-layout>

