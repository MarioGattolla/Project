<x-app-layout>
    <x-slot name="header">
        <x-header>
            {{ __('Create:  ') }}
        </x-header>
    </x-slot>
    <div class="py-12" name="body">
        <x-body-div class="">
            <x-div-box>
                <x-div-box class="p-2 border-2 border-indigo-100 rounded">
                <form method="POST" action="/admin/users" class="bg-white p-5 ">
                    @csrf

                   <x-users.form.label class="" for="name" >Name</x-users.form.label>
                    <x-users.form.imput  id="name" name="name"/>

                    <x-users.form.label for="surname" >Surname</x-users.form.label>
                    <x-users.form.imput id="surname" name="surname"/>

                    <x-users.form.label for="email">Email</x-users.form.label>
                    <x-users.form.imput id="email" name="email"/>

                    <x-users.form.label for="password">Password</x-users.form.label>
                    <x-users.form.imput id="password" name="password" />

                    <x-users.form.label for="roles">Choose a role : </x-users.form.label>
                    <select name="role" id="role">
                        @foreach(\App\Enums\Role::values() as $role_id => $role_name)
                           <option value="{{$role_name}}" {{($role_id == \App\Enums\Role::user->name ? 'selected' : '')}}>{{$role_name}}</option>
                        @endforeach
                    </select>

                    <x-users.form.submit type="submit" value="Submit" name="submit"/>
                </form>
                </x-div-box>
            </x-div-box>
        </x-body-div>

    </div>

</x-app-layout>
