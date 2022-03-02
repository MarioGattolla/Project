@php
    /** @var \App\Models\User $user */
    /** @var string[] $available_services */
@endphp

<x-app-layout>
    <x-slot name="header">
        <x-header>
            {{ __('Become A Coach:  ') }}{{$user->name}} {{$user->surname}}
        </x-header>
    </x-slot>
    <div class="py-12" name="body">
        <x-body-div class="">
            <div class="border-indigo-100 border-2 rounded m-5 p-5" >
                <form method="POST" action="{{route('beacoach.update',$user)}}" class="px-3">
                    @csrf
                    @method('PUT')


                    <x-users.form.label for="services" class="text-lg">Select the Services to Coach</x-users.form.label>
                    @foreach(\App\Models\Service::pluck('name', 'id') as $service_id => $service_label)
                        <label>
                            <input type="checkbox" name="services[]" value="{{$service_id}}">
                            {{$service_label}}
                        </label>

                    @endforeach

                    <x-users.form.submit type="submit" value="Become A Coach" name="submit"/>
                </form>
            </div>
        </x-body-div>
    </div>

</x-app-layout>


