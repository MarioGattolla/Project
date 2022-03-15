<?php
/** @var \App\Models\User $user */
?>
@component('mail::message')
    Dear {{$user->surname}} {{$user->name}} , This is an automatic mail delivery. We need to remember
    that there are some debits to pay. You can reply this mail or contact us for more info.
    You can click the button below to login on site and ceck your balance.
    @component('mail::button', ['url' => 'http://127.0.0.1/dashboard'])
        Click Here
    @endcomponent

    Thanks, Mario's Gym SPA
    Phone : 3999999999
    Email : Mariosgym@prova.it
@endcomponent
