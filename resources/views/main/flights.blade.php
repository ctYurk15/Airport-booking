@extends('layouts.main_layout')

@section('content')
<h1>Табло вильоту і прильоту</h1>
<form action="/" method="post" id='filterForm'>
    <div class="row">
        <div class="fromToDate">
            <label for="airport">ЗВІДКИ *</label><br>
            <select id='fromCity'>
                <option value='null' selected>Будь-де</option>
            </select>
        </div>

        <div class="fromToDate">
            <label for="from_to">КУДИ *</label><br>
            <select id='toCity'>
                <option value='null' selected>Будь-куди</option>
            </select>
        </div>

        <div class="fromToDate">
            <label for="airport">ДАТА ВИЛЬОТУ *</label><br>
            <select id='time'>
                <option value="today">Цього дня</option>
                <option value="tomorrow">Завтра</option>
                <option value="week">Цього тижня</option>
                <option value="month">Цього місяця</option>
                <option value="null" selected>Будь-коли</option>
            </select>
        </div>
        
    </div>
    <input type='submit' class='button' value='Показати'>
</form><br>

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
                <th class="opth">ФАКТИЧНИЙ ЧАС</th>
                <th class="opth">КУПИТИ КВИТОК</th>
            </tr>
        </thead>
        <tbody id='availableFlights'>
            
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
                <th class="opth">ФАКТИЧНИЙ ЧАС</th>
            </tr>
        </thead>
        <tbody id='inAirFlights'>
            
        </tbody>
    </table>
</div>
@endsection