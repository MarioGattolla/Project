<?php

/** @var User $user */

use App\Models\User;

$search_users = User::all()
    ->map(function (User $user) {
        return [
            'user_id' => $user->id,
            'user_name' => $user->name,
            'user_surname' => $user->surname,
            'user_email' => $user->email
        ];
    });

?>

<x-app-layout>
    <x-slot name="header">
        <x-header>
            {{ __('Create a new Subscription:  ') }}
        </x-header>

        <script>

            function filterUser() {
                return {
                    search: "",
                    data: sourceData,
                    get filteredUser() {
                        if (this.search === "") {
                            return this.data;
                        }
                        return this.data.filter((item) => {
                            return item.user_surname
                                .toLowerCase()
                                .includes(this.search.toLowerCase());
                        });
                    },
                };
            }

            var sourceData = [
                {
                    id: "1",
                    user_surname: "Tiger Nixon",
                },
                {
                    id: "2",
                    user_surname:
                        "Garrett Winters",

                },
            ];

        </script>

    </x-slot>
    <div class="py-12" name="body">
        <x-body-div>
            <x-div-box>

                <form method="POST" action="{{route('subscriptions.store')}}">
                    @csrf
                    <x-div-box class="border-gray-200 border-2 rounded">

                        <div class=" rounded-md border-2 flex-col w-1/3" x-data="filterUser()">
                            <input class="w-full flex-col" type="search" x-model="search"
                                   placeholder="Search for the user..."/>
                            <div class="flex-col">
                                <template x-for="item in filteredUser" :key="item">
                                    <div class="flex">
                                        <p x-text="item.user_surname"></p>
                                    </div>
                                </template>
                            </div>
                        </div>


                        <x-users.form.label for="services" class="text-lg">Select the Services</x-users.form.label>
                        @foreach(\App\Models\Service::pluck('name', 'id') as $service_id => $service_label)
                            <label>
                                <input type="checkbox" name="services[]" value="{{$service_id}}">
                                {{$service_label}}
                            </label>
                        @endforeach

                        <x-users.form.label for="start" class="text-lg">Subscription dates</x-users.form.label>
                        <input type="date" id="start" name="start" value="{{today()->format('Y-m-d')}}"
                               min="{{today()->format('Y-m-d')}}">
                        -
                        <input type="date" id="end" name="end" value="{{today()->addMonth()->format('Y-m-d')}}"
                               min="{{today()->format('Y-m-d')}}">

                        <x-users.form.submit type="submit" value="Submit" name="submit" class="ml-12"/>
                    </x-div-box>
                </form>

            </x-div-box>

        </x-body-div>

    </div>

</x-app-layout>

