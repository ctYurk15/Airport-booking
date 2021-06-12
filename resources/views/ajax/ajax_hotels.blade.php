<table class="dpt">
    <thead>
        <tr class="optr">
            <th class="opth">МІСТО</th>
            <th class="opth">ГОТЕЛЬ</th>
            <th class="opth">КЛАС</th>
            <th class="opth">КІМНАТ</th>
            <th class="opth">МІСТКІСТЬ</th>
            <th class="opth"></th>
        </tr>
    </thead>
    <tbody id='rooms'>
        @foreach($rooms as $room)
            <tr>
                <th>{{$room->hotel->city->Name}}</th>
                <th>{{$room->hotel->Name}}</th>
                <th>{{$room->roomtype->Name}}</th>
                <th>{{$room->CountRooms}}</th>
                <th>{{$room->CountUsers}}</th>
                <th><button data-id="{{$room->id}}" data-route="{{route('purchaseRooms')}}" class="orderRoom">Забронювати</button></th>
            </tr>
        @endforeach
    </tbody>
</table>