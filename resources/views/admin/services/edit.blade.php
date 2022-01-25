<?php
/** @var \App\Models\Service $service**/
?>

<x-app-layout>
    <x-slot name="header">
        <x-header>
            {{ __('Edit:  ') }}
        </x-header>
    </x-slot>
    <div name="body" class="py-12">
        <x-body-div>
            <x-div-box class=" ">
                <x-div-box class="border-2 border-indigo-100 bg-indigo-100 rounded flex">
                    <x-users.form.label class="text-lg">Service current Name : {{$service->name}}</x-users.form.label>
                    <x-users.form.label class="text-lg">Service current Price : €{{$service->price}}</x-users.form.label>
                </x-div-box>
                <x-div-box class="border-2 border-gray-100 bg-gray-50 rounded">
                <form method="POST" action="/admin/services/{{$service->id}}" class="bg-white border-2 border-gray-100 p-5">
                    @csrf
                    @method('PUT')

                    <x-users.form.label for="name" class="text-lg">Insert the new Service Name</x-users.form.label>
                    <x-users.form.imput name="name" class="ml-3" value="{{old('name', $service->name)}}"/>
                    <x-users.form.label for="price" class="text-lg">Insert the new Service Price</x-users.form.label>
                    <x-users.form.imput name="price" class="ml-3" value="{{old('name', $service->price)}}"/>
                    <div class="px-3 py-12">
                    <x-users.form.submit type="submit" value="Submite" class="px-3" name="submit"/>
                    </div>
                </form>
                </x-div-box>
            </x-div-box>
        </x-body-div>
    </div>

</x-app-layout>
