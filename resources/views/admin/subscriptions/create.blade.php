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
                    search: '',
                    data: sourceData,
                    selectedUserIndex: '',
                    get filteredUser() {
                        if (this.search === '') {
                            return [];
                        }
                        return this.data.filter(search => search.user_surname.toLowerCase().includes(this.search.toLowerCase()));

                    },
                    reset() {
                        this.search = '';
                    },
                    selectNextUser() {
                        if (this.selectedUserIndex === '') {
                            this.selectedUserIndex = 0;
                        } else {
                            this.selectedUserIndex++;
                        }
                    },
                    selectPreviousUser() {
                        if (this.selectedUserIndex === '') {
                            this.selectedUserIndex = 0;
                        } else {
                            this.selectedUserIndex--;
                        }
                    },
                };
            }


            var sourceData = @json($search_users);

        </script>

    </x-slot>
    <div class="py-12" name="body">
        <x-body-div>
            <x-div-box>

                <form method="POST" action="{{route('subscriptions.store')}}">
                    @csrf
                    <x-div-box class="border-gray-200 border-2 rounded">

                        <div class=" rounded-md  flex-col w-1/3 p-2 " x-data="filterUser()">
                            <input class="w-full flex-col "
                                   type="search"
                                   x-model="search" placeholder="Search for User"
                                   @click.away="reset()"
                                   x-on:keyup.escape="reset()"
                                   x-on:keyup.down="selectNextUser()"
                                   x-on:keyup.up="selectPreviousUser()"

                            />
                            <div class="overflow-y-auto max-h-52 border-2" x-show="filteredUser.length>0">
                                <template x-for="(item, index) in filteredUser">
                                    <option class=" p-2   rounded-md hover:bg-indigo-100"
                                            @click="$dispatch('selected-user' , item)"
                                            x-text="item.user_name + ' ' + item.user_surname"
                                            :class="{'bg-indigo-100': index===selectedUserIndex}">
                                    </option>

                                </template>
                            </div>
                            <div class="flex p-2  border-2 rounded-md" x-show="item =! ''">
                                No Users Available
                            </div>
                        </div>


                        <div>
                            <div x-data="{id: ''}" class="w-1/3 mb-3 hidden h-10" @selected-user.window="id = $event.detail.user_id"  id="id" ></div>
                            <div>User Name</div>
                            <div x-data="{name: ''}" class="w-1/3 mb-3 h-10" @selected-user.window="name = $event.detail.user_name" type="text" name="name" x-text="name" ></div>
                            <div>User Surname</div>
                            <div x-data="{surname: ''}" class="w-1/3 mb-3 h-10" @selected-user.window="surname = $event.detail.user_surname" type="text" name="surname" x-text="surname" ></div>
                            <div>User Email</div>
                            <div x-data="{email: ''}" class="w-1/3 mb-3 h-10" @selected-user.window="email = $event.detail.user_email" type="text" name="email" x-text="email" ></div>
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


