<x-app-layout>
    <x-slot name="header">
        <x-header>
            {{ __('Create a new Subscription:  ') }}
        </x-header>
    </x-slot>
    <div class="py-12" name="body">
        <x-body-div>
            <x-div-box>

                <form method="POST" action="{{route('subscriptions.index')}}">
                    @csrf
                    <x-div-box class="border-gray-200 border-2 rounded">

                        <x-users.form.label for="user_id" class="text-lg">Select the User</x-users.form.label>
                        <select name="user_id" id="user_id">
                            <option value="">--Select--</option>
                            @foreach(\App\Models\User::pluck('surname', 'id') as $user_id => $user_name)
                                <option value="{{$user_id}}">{{$user_name}}</option>
                            @endforeach
                        </select>

                        <x-users.form.label for="services" class="text-lg">Select the Services</x-users.form.label>
                        @foreach(\App\Models\Service::pluck('name', 'id') as $service_id => $service_label)
                            <label>
                                <input type="checkbox" name="services[]" value="{{$service_id}}">
                                {{$service_label}}
                            </label>

                        @endforeach


                        <x-users.form.label for="start" class="text-lg">Subscription dates</x-users.form.label>
                        <input type="date" id="start" name="start" value="{{today()->format('Y-m-d')}}" min="{{today()->format('Y-m-d')}}">
                        -
                        <input type="date" id="end" name="end" value="{{today()->addMonth()->format('Y-m-d')}}" min="{{today()->format('Y-m-d')}}">

                        <x-users.form.submit type="submit" value="Submit" name="submit" class="ml-12"/>
                    </x-div-box>
                </form>

            </x-div-box>
        </x-body-div>

    </div>

</x-app-layout>
