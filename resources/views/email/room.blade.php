@component('mail::message')
# Thank you for choosing us!

You booked next room:

Hotel - {{$room->hotel->Name}}<br>
Class - {{$room->roomtype->Name}}<br>

Thanks,<br>
{{ config('app.name') }}
@endcomponent
