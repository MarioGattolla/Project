<?php
/** @var \App\Models\User $user */

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
                    You're logged in! {{$user}}
                </div>


                <div class="m-3 p-3" x-data="{ open: false }">
                    <button class="px-4 py-2 text-white bg-blue-500 rounded "
                            @click="open = true">Modale di prova
                    </button>
                    <div class="absolute top-0 left-0 flex items-center justify-center w-full h-full bg-indigo-100"
                         style="background-color: rgba(0,0,0,.5);" x-show="open">
                        <div
                            class="h-auto p-4 mx-2 text-left bg-white rounded shadow-xl md:max-w-xl md:p-6 lg:p-8 md:mx-0"
                            @click.away="open = false">
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                <h3 class="text-lg p-3 m-3 text-gray-900">
                                    Titolo
                                </h3>
                                <div class="mt-2">
                                    <p class="text-sm p-3 m-3  text-gray-500">
                                        Prova del contenuto
                                    </p>
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

            </div>
        </div>
    </div>
    <script src="{{ mix('js/app.js') }}" defer></script>
    </body>
</x-app-layout>
