<div class="depart">
    <div class="text-center">
        <i>ВИЛІТ</i>
    </div>
    <table class="dpt">
        <thead>
        <tr class="optr">
            <th class="opth buyTicket">МАРШРУТ</th>
            <th class="opth">РЕЙС №</th>
            <th class="opth">ЧАС ЗА РОЗКЛАДОМ</th>
            <th class="opth">ОЧІКУЄТЬСЯ</th>
            <th class="opth">КУПИТИ КВИТОК</th>
        </tr>
        </thead>
        <tbody id='availableFlights'>
            @foreach($available_flights as $reis)
                <tr>
                    <th>{{$reis->departureAirport->city->Name}} - {{$reis->arrivalAirport->city->Name}}</th>
                    <th>PS10{{$reis->id}}</th>
                    <th>{{$reis->ReisTimeFrom}}</th>
                    <th>{{$reis->ReisTimeTo}} </th>
                    <th><button>Купити квиток</button></th>
                </tr>
            @endforeach
        </tbody>
    </table>
    <h3 id='errorText'></h3>
</div>

<div class="arrival">
    <div class="text-center">
        <i>ПРИЛІТ</i>
    </div>
    <table class="arrt">
        <thead>
            <tr class="optr">
                <th class="opth">МАРШРУТ</th>
                <th class="opth">РЕЙС №</th>
                <th class="opth">ЧАС ЗА РОЗКЛАДОМ</th>
                <th class="opth">ОЧІКУЄТЬСЯ</th>
            </tr>
        </thead>
        <tbody id='inAirFlights'>
            @foreach($arriving_flights as $reis)
                <tr>
                    <th>{{$reis->departureAirport->city->Name}} - {{$reis->arrivalAirport->city->Name}}</th>
                    <th>PS10{{$reis->id}}</th>
                    <th>{{$reis->ReisTimeFrom}}</th>
                    <th>{{$reis->ReisTimeTo}} </th>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>