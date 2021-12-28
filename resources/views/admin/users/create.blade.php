<x-app-layout>
    <x-slot name="header">
        <x-header>
            {{ __('Create:  ') }}
        </x-header>
    </x-slot>
    <div class="py-12" name="body">
        <x-body-div>
            <x-div-box>
                <x-div-box class="border-2 border-gray-200 rounded">
                <form method="POST" action="/admin/users" class="bg-white px-3">
                    @csrf

                    <x-users.form.label for="name" >Name</x-users.form.label>
                    <x-users.form.imput id="name" name="name"/>

                    <x-users.form.label for="email">Email</x-users.form.label>
                    <x-users.form.imput id="email" name="email"/>

                    <x-users.form.label for="password">Password</x-users.form.label>
                    <x-users.form.imput id="password" name="password" />

                    <x-users.form.label for="roles">Choose a role : </x-users.form.label>

                    <select name="role_id" id="role_id">
                        <option value="">--Select--</option>
                        @foreach($available_roles as $role_id => $role_name)
                            <option value="{{$role_id}}">{{$role_name}}</option>
                        @endforeach
                    </select>
                    <x-users.form.submit type="submit" name="submit"/>
                </form>
                </x-div-box>
            </x-div-box>
        </x-body-div>

    </div>

</x-app-layout>
