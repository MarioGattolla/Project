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
            <x-div-box>
                <x-div-box class="border-2 rounded border-gray-200 flex">
                    <x-users.form.label> Nome: {{$user->name}}</x-users.form.label>

                    <x-users.form.label>Email: {{$user->email}}</x-users.form.label>

                    <x-users.form.label>Role: @php if(!empty($user->role->name)){echo $user->role->name;}@endphp</x-users.form.label>
                    <x-div-box class="py-3">
                        <x-button class="mb-3"><a href="{{route('users.edit', $user)}}">Modifica</a></x-button>
                        <form method="POST">
                            @csrf
                            @method('DELETE')
                            <x-button>Delete</x-button>
                        </form>
                    </x-div-box>
                </x-div-box>
            </x-div-box>
        </x-body-div>
    </div>
</x-app-layout>

