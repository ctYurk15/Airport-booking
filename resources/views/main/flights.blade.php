@extends('layouts.main_layout')

@section('title', 'Рейси')

@section('content')
<h1>Табло вильоту і прильоту</h1>
<form action="/" method="post" id='filterForm'>
    <div class="row">
        <div class="fromToDate">
            <label for="airport">ЗВІДКИ *</label><br>
            <select id='fromCity'>
                <option value='any' selected>Будь-де</option>
                @foreach($cities as $city)
                    <option value="{{$city->Name}}">{{$city->Name}}</option>
                @endforeach
            </select>
        </div>

        <div class="fromToDate">
            <label for="from_to">КУДИ *</label><br>
            <select id='toCity'>
                <option value='any' selected>Будь-куди</option>
                @foreach($cities as $city)
                    <option value="{{$city->Name}}">{{$city->Name}}</option>
                @endforeach
            </select>
        </div>

        <div class="fromToDate">
            <label for="airport">ДАТА ВИЛЬОТУ *</label><br>
            <select id='time'>
                <option value="any" selected>Будь-коли</option>
                <option value="today">Цього дня</option>
                <option value="tomorrow">Завтра</option>
                <option value="week">Цього тижня</option>
                <option value="month">Цього місяця</option>
            </select>
        </div>
        
    </div>
    <input type='submit' class='button' value='Показати' data-route="{{route('flights')}}" id="submitButton">
</form><br>

<div id='flightsTable'>
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
                        <th><button data-reis="{{$reis->id}}" data-route="{{ route('purchaseTickets') }}" class="buyButton">Купити квиток</button></th>
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
</div>
<br>
<div id="SinoptikInformer" class="SinoptikInformer type1c1">
    <div class="siHeader">
        <div class="siLh">
            <div class="siMh">
                <a onmousedown="siClickCount();" class="siLogo" href="https://ua.sinoptik.ua/" target="_blank" rel="nofollow" title="Погода"> 
                </a>Погода <span id="siHeader"></span>
            </div>
        </div>
    </div>
    <div class="siBody">
        <a onmousedown="siClickCount();" href="https://ua.sinoptik.ua/погода-львів" title="Погода у Львові" target="_blank">
        <div class="siCity">
            <div class="siCityName">
                <span>Львів</span>
            </div>
            <div id="siCont0" class="siBodyContent">
                <div class="siLeft">
                    <div class="siTerm">
                    </div>
                    <div class="siT" id="siT0">
                    </div>
                    <div id="weatherIco0">
                    </div>
                </div>
                <div class="siInf">
                    <p>вологість: <span id="vl0"></span></p>
                    <p>тиск: <span id="dav0"></span></p>
                    <p>вітер: <span id="wind0"></span></p>
                </div>
            </div>
        </div>
        </a>
        <div class="siLinks">
            Погода на 10 днів від <a href="https://ua.sinoptik.ua/погода-львів/10-днів" title="Погода на 10 днів" target="_blank" onmousedown="siClickCount();">sinoptik.ua</a>
        </div>
    </div>
    <div class="siFooter">
        <div class="siLf">
            <div class="siMf">
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" charset="UTF-8" src="//sinoptik.ua/informers_js.php?title=4&amp;wind=3&amp;cities=303014487&amp;lang=ua"></script>
@endsection

@section('custom_js')
<script src="{{asset('js/flights.js')}}"></script>
@endsection