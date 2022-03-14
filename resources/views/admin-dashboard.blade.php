<?php
/** @var User $user */

use App\Models\User;

$debtorsCount = $user->debtor_count();
?>
<x-app-layout>
    <x-slot name="header">

        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>
    <body>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    You're logged in , {{$user->name}} {{$user->surname}}
                </div>
                <div class="m-3 p-3">
                    <div class="text-lg mb-3 ">This is the Debtors section, you can ceck Debtors count and send them a
                        quick payment reminder email.
                    </div>
                    @if($debtorsCount >0)
                        <div> Actually there are {{$debtorsCount}} Debtors,</div>
                        <div> click on the button to send them email.</div>

                        <div class="modal  w-100 mt-2" x-data="{
                                    open: false,
                                    loading: false,
                        }">
                            <button class="bg-blue-200 hover:bg-blue-500 rounded-md px-2 py-1"

                                    @click="
                                        loading=true;
                                        axios.post('admin/payments/send_payment_reminder_emails')
                                             .then(response => {
                                                loading = false;
                                                open = true;
                                                 })
                                    "
                                    x-bind:disabled="loading"
                            >
                                <svg x-show="loading" xmlns="http://www.w3.org/2000/svg"
                                     class="inline animate-spin h-6 w-6" fill="none" viewBox="0 0 24 24"
                                     stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>
                                </svg>
                                Send Email
                            </button>
                            <div
                                class=" fixed top-0 left-0 flex items-center justify-center w-full h-full bg-indigo-100"
                                style="background-color: rgba(0,0,0,.5);"

                                x-show="open"

                                x-transition:enter="transition ease-out duration-1000"
                                x-transition:enter-start="opacity-0"
                                x-transition:enter-end="opacity-100"

                                x-transition:leave="transition ease-in duration-500"
                                x-transition:leave-start="opacity-100"
                                x-transition:leave-end="opacity-0"
                            >
                                <div
                                    class="h-auto p-4 mx-2 text-left bg-white rounded shadow-xl md:max-w-xl md:p-6 lg:p-8 md:mx-0"
                                    @click.away="open = false">
                                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                        <div class="text-lg p-3 m-3 text-gray-900 bg-blue-100">
                                            Emails Successfully Sent. You can close this window.
                                        </div>
                                    </div>
                                    <div class="m-3 p-3">
                                        <div class="flex w-full rounded-md ">
                                            <button @click="open = false"
                                                    class=" justify-center w-full px-4 py-2 text-white bg-blue-500 rounded">
                                                Close
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        Actually there aren't debtor Users.
                    @endif
                </div>
            </div>
        </div>
    </div>
    </body>
</x-app-layout>
