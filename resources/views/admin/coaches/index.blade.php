@php
    use App\Models\Subscription;
    /** @var Subscription[] $subscriptions */
@endphp

<x-app-layout>
    <x-slot name="header">
        <x-header>
            {{ __('Subscriptions:  ') }}
        </x-header>
    </x-slot>
    <div name="body" class="py-12">
        <x-body-div>
            <div class="p-3 m-3">
                <a href="{{route('subscriptions.create')}}" class="text-xl">Create a new Subscription</a>
            </div>
            <div class="grid lg:grid-cols-6 md:grid-cols-4 sm:grid-cols-2 gap-4">
                @foreach($subscriptions as $subscription)
                    <x-div-box class="mb-5 border-2 border-gray-200 rounded col-span-2 ">
                        <x-users.form.label class="text-lg bg-blue-100 rounded-md px-2 py-2 mb-2">Subscription User
                            : {{$subscription->user->name}} {{$subscription->user->surname}}</x-users.form.label>
                        <div class="bg-gray-100 mb-2     rounded-md">
                            <x-users.form.label class="text-lg ">Incription Start
                                : {{$subscription->start->format('Y-m-d')}}</x-users.form.label>
                            <x-users.form.label class="text-lg ">Incription End
                                : {{$subscription->end->format('Y-m-d')}}</x-users.form.label>
                        </div>
                        <x-button href="{{route('subscriptions.show',$subscription)}}">Show</x-button>

                    </x-div-box>
                @endforeach
            </div>
        </x-body-div>
    </div>

</x-app-layout>

