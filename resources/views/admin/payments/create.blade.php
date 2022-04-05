<?php

use App\Models\User;

/** @var User $user */

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
                    selectedUserIndex: 0,
                    user: {
                        id: null,
                        name: null,
                        surname: null,
                        email: null,
                    },
                    filteredUser: [],


                    searchUser(event) {

                        if (event.keyCode > 36 && event.keyCode < 41) {
                            return event.preventDefault();
                        }

                        if (this.search === '') {
                            return this.filteredUser = '';
                        }
                        axios.get('{{URL::to('/payments/search')}}', {
                            'params': {'search': this.search}
                        }).then(response => {
                            this.filteredUser = response.data;
                        });

                        this.selectedUserIndex = 0;
                    },


                    reset() {
                        this.search = '';
                        this.filteredUser = '';
                    },

                    selectNextUser() {
                        if (this.selectedUserIndex === '') {
                            this.selectedUserIndex = 0;
                        } else {
                            if (this.selectedUserIndex < this.filteredUser.length - 1) {
                                this.selectedUserIndex++;

                            }
                        }
                    },
                    selectPreviousUser() {
                        if (this.selectedUserIndex === '') {
                            this.selectedUserIndex = 0;
                        } else {

                            if (this.selectedUserIndex > 0) {
                                this.selectedUserIndex--;
                            }
                        }
                    },
                };
            }

        </script>

    </x-slot>
    <div class="py-12">
        <x-body-div>
            <x-div-box>

                <form method="POST" action="{{route('payments.store')}}">
                    @csrf
                    <x-div-box class="border-gray-200 border-2 rounded">

                        @if($user->role->value == 'Admin')
                            <div x-data="filterUser()">
                                <div class=" rounded-md  flex-col w-1/3 p-2 ">
                                    <input class="w-full flex-col "
                                           type="search"
                                           autocomplete="off"
                                           id="search"
                                           x-model="search" placeholder="Search for User"
                                           @click.away="reset()"
                                           x-on:keyup="searchUser"
                                           x-on:keyup.down="selectNextUser()"
                                           x-on:keyup.up="selectPreviousUser()"


                                    />
                                    <div class="overflow-y-auto max-h-52 border-2" x-show="filteredUser.length>0">
                                        <template x-for="(selected_user, index) in filteredUser">
                                            <option class=" p-2   rounded-md hover:bg-indigo-100"
                                                    @click="user = selected_user"
                                                    x-text="selected_user.name + ' ' + selected_user.surname"
                                                    :class="{'bg-indigo-100': index===selectedUserIndex}">
                                            </option>

                                        </template>
                                    </div>
                                </div>


                                <div name="user_form">
                                    <input class="w-1/3 mb-3 hidden h-10" x-model="user.id" name="id" id="id" required />
                                    <div>User Name</div>
                                    <input class="w-1/3 mb-3 h-10 has-validation" x-model="user.name" type="text"
                                           name="name" id="name" required/>
                                    <div>User Surname</div>
                                    <input class="w-1/3 mb-3 h-10" type="text" x-model="user.surname" name="surname"
                                           id="surname" required />
                                    <div>User Email</div>
                                    <input class="w-1/3 mb-3 h-10" type="text" x-model="user.email" name="email"
                                           id="email" required />
                                </div>
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
