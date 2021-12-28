@php
    use App\Models\Service;
    /** @var Service[] $services */
@endphp

<x-app-layout>
    <x-slot name="header">
        <x-header>
            {{ __('Services:  ') }}
        </x-header>
    </x-slot>
    <div name="body" class="py-12">
        <x-body-div>
            <x-div-box>
                @foreach($services as $service)
                    <x-div-box class="mb-5 border-2 border-gray-200 rounded ">
                        <x-users.form.label class="text-lg bg-gray-100 px-3 py-3 mb-3">Service Name : {{$service->name}}  ---   Service Price : €    {{$service->price}}</x-users.form.label>
                        <x-users.form.label class="text-lg bg-gray-100 px-3 py-3 mb-3">Service Description :  {{$service->description}}</x-users.form.label>
                        <x-button type="button"><a href="{{route('services.edit',$service)}}"/>Modifica</x-button>
                        <form method="POST" action="/admin/roles/{{$service->id}}" class="mt-3 mb-3">
                            @csrf
                            @method('DELETE')
                            <x-button>Elimina</x-button>
                        </form>
                    </x-div-box>
                @endforeach
            </x-div-box>
        </x-body-div>
    </div>

</x-app-layout>
