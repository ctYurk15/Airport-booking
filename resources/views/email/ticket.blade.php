@component('mail::message')
# Thank you for choosing us!

You bought next ticket:

PS10{{$ticket->Reis_id1}}<br>
Place №{{$ticket->PlaceNumber}}<br>
Departing time: {{$ticket->reis->ReisTimeFrom}}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
