@php

    /** @var \App\Models\User $user */
    /** @var string[] $available_roles */
@endphp

<x-app-layout>
    <x-slot name="header">
        <x-header>
            {{ __('Edit:  ') }}{{$user->name}}
        </x-header>
    </x-slot>
    <div class="py-12" name="body">
        <x-body-div class="">
            <div class="border-indigo-100 border-2 rounded m-5 p-5" >
                <form method="POST" action="/admin/users/{{$user->id}}" class="px-3">
                    @csrf
                    @method('PUT')

                    <x-users.form.label for="name">Name</x-users.form.label>
                    <x-users.form.imput id="name" name="name" value="{{old('name', $user->name)}}"/>

                    <x-users.form.label for="surname">Surname</x-users.form.label>
                    <x-users.form.imput id="surname" name="surname" value="{{old('surname', $user->surname)}}"/>

                    <x-users.form.label for="email">Email</x-users.form.label>
                    <x-users.form.imput name="email" value="{{old('email', $user->email)}}"/>

                    <x-users.form.label for="password">Password</x-users.form.label>
                    <x-users.form.imput name="password"/>

                    <x-users.form.label for="roles">Choose a role :</x-users.form.label>

                    <select name="role" id="role">
                        <option value="">{{$user->role->value}}</option>
                        @foreach(\App\Enums\Role::values() as $role_id => $role_name)
                            <option id="role" name="role" value="{{$role_name}}" {{($role_id == \App\Enums\Role::user->name ? 'selected' : '')}}>{{$role_name}}</option>
                        @endforeach

                    </select>

                    <x-users.form.submit type="submit" value="Submite" name="submit"/>
                </form>
            </div>
        </x-body-div>
    </div>

</x-app-layout>


