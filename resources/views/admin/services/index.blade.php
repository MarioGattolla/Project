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
           <a class="m-5 p-3 hover:bg-gray-50 text-lg" href="{{route('services.create')}}" >Create a new Service:</a>
            <x-div-box class="grid lg:grid-cols-6 md:grid-cols-4 sm:grid-cols-1 max gap-4">
                @foreach($services as $service)
                    <div class="border-2 border-gray-200 rounded col-span-2 p-2 m-2">

                        <x-users.form.label class="text-lg rounded bg-blue-100 ">
                            Service Name : {{$service->name}}
                        </x-users.form.label>

                        <x-users.form.label class="text-lg rounded bg-gray-100 ">
                            Service Price : € {{$service->price}}
                        </x-users.form.label>

                       <x-button href="{{route('services.edit',$service)}}" class="m-2">
                            Modifica
                        </x-button>

                        <form method="POST" action="/admin/services/{{$service->id}}" class="m-2">
                            @csrf
                            @method('DELETE')
                            <x-button>Delete</x-button>

                        </form>
                    </div>
                @endforeach
            </x-div-box>
            </div>
        </x-body-div>
    </div>

</x-app-layout>
