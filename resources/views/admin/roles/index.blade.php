@php
    use App\Models\Role;
    /** @var Role[] $roles */
@endphp

<x-app-layout>
    <x-slot name="header">
        <x-header>
            {{ __('Roles:  ') }}
        </x-header>
    </x-slot>
    <div name="body" class="py-12">
        <x-body-div>
            @foreach($roles as $role)
                <x-div-box class="mb-5 border-2 border-gray-200 rounded ">
                    <x-users.form.label class="text-lg bg-gray-100 px-3 py-3 mb-3">Service Name : {{$role->name}}</x-users.form.label>
                    <x-button type="button"><a href="{{route('roles.edit',$role)}}"/>Modifica</x-button>
                    <form method="POST" action="/admin/roles/{{$role->id}}" class="mt-3 mb-3">
                        @csrf
                        @method('DELETE')
                        <x-button>Elimina</x-button>
                    </form>
                </x-div-box>
            @endforeach
        </x-body-div>
    </div>

</x-app-layout>
