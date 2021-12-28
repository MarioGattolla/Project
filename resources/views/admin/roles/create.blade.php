<x-app-layout>
    <x-slot name="header">
        <x-header>
            {{ __('Create:  ') }}
        </x-header>
    </x-slot>
    <div class="py-12" name="body">
        <x-body-div>
            <x-div-box>

                <form method="POST" action="/admin/roles" >
                    @csrf
                    <x-div-box class="border-gray-200 border-2 rounded">
                        <x-users.form.label for="name" class="text-lg">Insert the Role Name</x-users.form.label>
                        <x-users.form.imput id="name" name="name"/>
                        <x-users.form.submit type="submit" name="submit" class="ml-12"/>
                    </x-div-box>
                </form>

            </x-div-box>
        </x-body-div>

    </div>

</x-app-layout>
