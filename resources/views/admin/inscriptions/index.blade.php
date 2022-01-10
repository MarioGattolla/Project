@php
    use App\Models\Inscription;
    /** @var Inscription[] $inscriptions */
@endphp

<x-app-layout>
    <x-slot name="header">
        <x-header>
            {{ __('Inscriptions:  ') }}
        </x-header>
    </x-slot>
    <div name="body" class="py-12">
        <x-body-div>
            @foreach($inscriptions as $inscription)
                <x-div-box class="mb-5 border-2 border-gray-200 rounded ">
                        <x-users.form.label class="text-lg bg-gray-100 px-3 py-3 mb-3">Incription User : {{$inscription->user->name}}</x-users.form.label>
                    <x-users.form.label class="text-lg bg-gray-100 px-3 py-3 mb-3">Incription Service : {{$inscription->service}}</x-users.form.label>
                    <x-users.form.label class="text-lg bg-gray-100 px-3 py-3 mb-3">Incription Start : {{$inscription->start}}</x-users.form.label>
                    <x-users.form.label class="text-lg bg-gray-100 px-3 py-3 mb-3">Incription Time : {{$inscription->time}}</x-users.form.label>
                    <x-users.form.label class="text-lg bg-gray-100 px-3 py-3 mb-3">Incription End : {{$inscription->end}}</x-users.form.label>
                    <x-button type="button"><a href="{{route('inscriptions.show',$inscription)}}"/>Modifica</x-button>

                </x-div-box>
            @endforeach
        </x-body-div>
    </div>

</x-app-layout>
