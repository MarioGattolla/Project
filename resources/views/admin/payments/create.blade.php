<?php

use App\Models\User;

/** @var User $user */

$search_users = User::where('role', '=', 'User')->get()
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
            {{ __('Create a new Payment:  ') }}
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

            function setUserFields(item) {
                document.getElementById("id").setAttribute('value', item.user_id);
                document.getElementById("name").setAttribute('value', item.user_name);
                document.getElementById("surname").setAttribute('value', item.user_surname);
                document.getElementById("email").setAttribute('value', item.user_email);
            }

            var sourceData = @json($search_users);

        </script>

    </x-slot>
    <div class="py-12">
        <x-body-div>
            <x-div-box>

                <form method="POST" action="{{route('payments.store')}}">
                    @csrf
                    <x-div-box class="border-gray-200 border-2 rounded">

                        @if($user->role->value == 'Admin')
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
                                    <template x-for="item in filteredUser">
                                        <option class=" p-2   rounded-md hover:bg-indigo-100"
                                                @click="setUserFields(item)"
                                                x-text="item.user_name + ' ' + item.user_surname"
                                                :class="{'bg-indigo-100': index===selectedUserIndex}">
                                        </option>

                                    </template>
                                </div>
                            </div>


                            <div name="user_form">
                                <input class="w-1/3 mb-3 hidden h-10" value="" name="id" id="id" />
                                <div>User Name</div>
                                <input class="w-1/3 mb-3 h-10 has-validation" type="text" name="name" id="name"/>
                                <div>User Surname</div>
                                <input class="w-1/3 mb-3 h-10" type="text" name="surname"
                                       id="surname"/>
                                <div>User Email</div>
                                <input class="w-1/3 mb-3 h-10" type="text" name="email"
                                       id="email"/>
                            </div>

                        @else
                            <div>User Name : {{$user->name}}</div>
                            <div>User Name : {{$user->surname}}</div>
                            <div>User Name : {{$user->email}}</div>

                        @endif

                        <x-users.form.label for="quote" class="text-lg">Insert the Payment Quote</x-users.form.label>
                        <x-users.form.imput id="quote" name="quote" type="number"/>

                        <x-users.form.label for="date" class="text-lg">Select the Payment Date</x-users.form.label>
                        <input type="date" id="date" name="date" value="{{today()->format('Y-m-d')}}" min="{{today()}}">

                        <x-users.form.submit type="submit" name="submit" value="Submit" class="ml-12"/>
                    </x-div-box>
                </form>

            </x-div-box>
        </x-body-div>

    </div>

</x-app-layout>
