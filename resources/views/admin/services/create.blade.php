<x-app-layout>
    <x-slot name="header">
        <x-header>
            {{ __('Create:  ') }}
        </x-header>
    </x-slot>
    <div class="py-12" name="body">
        <x-body-div>
            <x-div-box >
                <form method="POST" action="/admin/services">
                    @csrf
                    <x-div-box class=" border-gray-200 border-2 rounded">
                        <x-users.form.label for="name" class="text-lg">Insert the Service Name :</x-users.form.label>
                        <x-users.form.imput id="name" name="name"/>
                        <x-users.form.label for="price" class="text-lg">Insert the Service Price :</x-users.form.label>
                        <x-users.form.imput id="price" name="price"/>
                        <x-users.form.label for="description" class="text-lg    ">Insert the Service Description :</x-users.form.label>
                        <input type="text" id="description" class=" bg-gray-100 rounded border-indigo-300" name="description"/>
                        <div class="mt-5">
                            <x-users.form.submit type="submit" name="submit" class="px-5 "/>
                        </div>
                    </x-div-box>
                </form>
            </x-div-box>
        </x-body-div>

    </div>

</x-app-layout>
