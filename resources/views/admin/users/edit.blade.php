@php
    use App\Models\Role;
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
        <x-body-div>
                <form method="POST" action="/admin/users/{{$user->id}}" class="px-3">
                    @csrf
                    @method('PUT')

                    <x-users.form.label for="name">Name</x-users.form.label>
                    <x-users.form.imput id="name" name="name" value="{{old('name', $user->name)}}"/>

                    <x-users.form.label for="email">Email</x-users.form.label>
                    <x-users.form.imput name="email" value="{{old('email', $user->email)}}"/>

                    <x-users.form.label for="password">Password</x-users.form.label>
                    <x-users.form.imput name="password"/>

                    <x-users.form.label for="role">
                        Actual role :
                        @php if(!empty($user->role->name))
                        {echo $user->role->name;}@endphp
                    </x-users.form.label>
                    <x-users.form.label for="roles">Choose a role :</x-users.form.label>

                    <select name="role_id" id="role_id">
                        <option value="">--Select--</option>
                        @foreach($available_roles as $role_id => $role_name)
                            <option value="{{$role_id}}" {{old('role_id', $user->role_id) == $role_id ? 'selected' : ''}}>{{$role_name}}</option>
                        @endforeach

                    </select>

                    <x-users.form.submit type="submit" name="submit"/>
                </form>
        </x-body-div>
    </div>

</x-app-layout>


