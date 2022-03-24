@php
    use App\Models\Subscription;use App\Models\User;
    /** @var Subscription[] $subscriptions */
        /** @var User $user */

    $subscriptions = match ($user->role->value){
        'Admin' => Subscription::orderBy('user_id')->paginate(),
        'User','Coach' => Subscription::whereRelation('user','user_id',$user->id)->paginate(),
    }

@endphp

<x-app-layout>
    <x-slot name="header">
        <x-header>
            {{ __('Subscriptions:  ') }}
        </x-header>
    </x-slot>
    <div class="py-12">
        <x-body-div>
            <div class="p-3 m-3">
                <a href="{{route('subscriptions.create', $user)}}" class="text-xl">Create a new Subscription</a>
            </div>
            <div class="grid lg:grid-cols-6 md:grid-cols-4 sm:grid-cols-2 p-3 gap-4">
                @foreach($subscriptions as $subscription)
                    <div class="mb-5 border-2 border-gray-200 rounded col-span-2 p-2 ">
                        <x-users.form.label class=" bg-blue-100 rounded-md px-2 py-2 mb-2">Subscription User
                            : {{$subscription->user->name}} {{$subscription->user->surname}}</x-users.form.label>
                        <div class="bg-gray-100 mb-2 rounded-md p-2 ">
                            <div class=" ">Subscription Start
                                : {{$subscription->start->format('Y-m-d')}}</div>
                            <div class=" ">Subscription End
                                : {{$subscription->end->format('Y-m-d')}}</div>
                        </div>

                        @if($user->role->value == 'Admin')
                            <x-button href="{{route('subscriptions.show', $subscription)}}">Show</x-button>
                        @endif


                    </div>
                @endforeach
            </div>
            {{$subscriptions->links()}}
        </x-body-div>
    </div>

</x-app-layout>

