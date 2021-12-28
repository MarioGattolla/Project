<?php
/** @var \App\Models\Role $role */
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
                <x-div-box class="border-2 border-gray-200 rounded flex">
                    <x-users.form.label class="text-lg">Role current name :</x-users.form.label>
                    <x-users.form.label class="text-lg">{{$role->name}}</x-users.form.label>
                </x-div-box>
                <form method="POST" action="/admin/roles/{{$role->id}}" class="bg-white p-5">
                    @csrf
                    @method('PUT')

                    <x-users.form.label for="name" class="text-lg">Insert new Role Name</x-users.form.label>
                    <x-users.form.imput name="name" class="ml-3" value="{{old('name', $role->name)}}"/>

                    <x-users.form.submit type="submit" class="ml-12" name="submit"/>

                </form>
            </x-div-box>
        </x-body-div>
    </div>

</x-app-layout>
