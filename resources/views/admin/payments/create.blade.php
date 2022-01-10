<x-app-layout>
    <x-slot name="header">
        <x-header>
            {{ __('Create a new Inscription:  ') }}
        </x-header>
    </x-slot>
    <div class="py-12" name="body">
        <x-body-div>
            <x-div-box>

                <form method="POST" action="/admin/payments">
                    @csrf
                    <x-div-box class="border-gray-200 border-2 rounded">

                        <x-users.form.label for="user_id" class="text-lg">Select the User</x-users.form.label>
                        <select name="user_id" id="user_id">
                            <option value="">--Select--</option>
                            @foreach($available_users as $user_id => $user_name)
                                <option value="{{$user_id}}">{{$user_name}}</option>
                            @endforeach
                        </select>

                        <x-users.form.label for="quote" class="text-lg">Insert the Payment Quote</x-users.form.label>
                        <x-users.form.imput id="quote" name="quote"/>

                        <x-users.form.label for="start" class="text-lg">Select the Payment Date</x-users.form.label>
                        <input type="date" id="start" value="2022-01-03" min="2017-01-01" max="2030-01-01">

                        <x-users.form.submit type="submit" name="submit" class="ml-12"/>
                    </x-div-box>
                </form>

            </x-div-box>
        </x-body-div>

    </div>

</x-app-layout>
