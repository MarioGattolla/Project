<x-app-layout>
    <x-slot name="header">
        <x-header>
            {{ __('Create:  ') }}
        </x-header>
    </x-slot>
    <div class="py-12" name="body">
        <x-body-div>
            <x-div-box >
                <form method="POST" action="{{route('services.index')}}">
                    @csrf
                    <x-div-box class=" border-gray-200 border-2 rounded">
                        <x-users.form.label for="name" class="text-lg">Service Name :</x-users.form.label>
                        <x-users.form.imput id="name" name="name"/>
                        <x-users.form.label for="price" class="text-lg">Service Price :</x-users.form.label>
                        <x-users.form.imput id="price" name="price"/>
                        <div class="mt-5">
                            <x-users.form.submit type="submit" value="Submit" name="submit" class="px-5 "/>
                        </div>
                    </x-div-box>
                </form>
            </x-div-box>
        </x-body-div>

    </div>

</x-app-layout>
