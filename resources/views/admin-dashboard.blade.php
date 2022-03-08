<?php
/** @var User $user */

use App\Models\User;

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
                    <div class="text-lg mb-3 ">This is the Debtors section, you can ceck Debtors count and send them a quick
                        email.
                    </div>
                    @if($user->debtor_count() >0)
                        <div> Actually there are {{$user->debtor_count()}} Debtors,</div>
                        <div> click on the button to send them email.</div>
                        <div class="modal rounded-md bg-blue-200 w-20 mt-2" x-data="{ open: false }" >
                            <button class=" w-full"
                                    @click="open = true">Send Email</button>
                            <div
                                class=" fixed top-0 left-0 flex items-center justify-center w-full h-full bg-indigo-100"
                                style="background-color: rgba(0,0,0,.5);" x-show="open">
                                <div
                                    class="h-auto p-4 mx-2 text-left bg-white rounded shadow-xl md:max-w-xl md:p-6 lg:p-8 md:mx-0"
                                    @click.away="open = false">
                                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                        <div class="text-lg p-3 m-3 text-gray-900 bg-blue-100">
                                            Actually sending the emails, this can require time.
                                            You can close and wait until a Confirm message appair.
                                            Dont refresh the page.
                                        </div>
                                    </div>
                                    <div class="m-3 p-3">
                                        <div class="flex w-full rounded-md ">
                                            <button @click="open = false"
                                                    class=" justify-center w-full px-4 py-2 text-white bg-blue-500 rounded">
                                                CHIUDI
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        prova2
                    @endif
                </div>
            </div>
        </div>
    </div>
    <script src="{{ mix('js/app.js') }}" defer></script>
    </body>
</x-app-layout>
