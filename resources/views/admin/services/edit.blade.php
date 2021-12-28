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
                <x-div-box class="border-2 border-gray-200 rounded flex">
                    <x-users.form.label class="text-lg">Service current Name : {{$service->name}}</x-users.form.label>
                    <x-users.form.label class="text-lg">Service current Price : €{{$service->price}}</x-users.form.label>
                    <x-users.form.label class="text-lg">Service current Description : {{$service->description}}</x-users.form.label>
                </x-div-box>
                <x-div-box class="border-2 border-gray-200 rounded">
                <form method="POST" action="/admin/services/{{$service->id}}" class="bg-white p-5">
                    @csrf
                    @method('PUT')

                    <x-users.form.label for="name" class="text-lg">Insert new Service Name</x-users.form.label>
                    <x-users.form.imput name="name" class="ml-3" value="{{old('name', $service->name)}}"/>
                    <x-users.form.label for="price" class="text-lg">Insert new Service Price</x-users.form.label>
                    <x-users.form.imput name="price" class="ml-3" value="{{old('name', $service->price)}}"/>
                    <x-users.form.label for="description" class="text-lg">Insert new Service Description</x-users.form.label>
                    <x-users.form.imput name="description" class="ml-3" value="{{old('name', $service->description)}}"/>
                    <div class="px-3 py-12">
                    <x-users.form.submit type="submit" class="px-3" name="submit"/>
                    </div>
                </form>
                </x-div-box>
            </x-div-box>
        </x-body-div>
    </div>

</x-app-layout>
