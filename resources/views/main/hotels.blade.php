@extends('layouts.main_layout')

@section('title', 'Готелі')

@section('content')
<h1>Готелі</h1>
    
    <div class="row">
        <form action="/" method="post" id='filtersForm'>
            <div class="fromToDate">
                <label for="from_to">ГОТЕЛЬ *</label><br>
                <select id='hotel'>
                    <option value='any' selected>Будь-який</option>
                    @foreach($hotels as $hotel)
                        <option value='{{$hotel->Name}}'>{{$hotel->Name}} - {{$hotel->city->Name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="fromToDate">
                <label for="airport">КЛАС КІМНАТИ *</label><br>
                <select id='class'>
                    <option value='any' selected>Будь-який</option>
                    @foreach($roomtypes as $roomtype)
                        <option value='{{$roomtype->Name}}'>{{$roomtype->Name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="show_button">
                <input type='submit' class='button' value='Показати' data-route="{{route('hotels')}}" id="submitButton">
            </div>
        </form>
    </div>

    <div class="depart">
        <table class="dpt">
            <thead>
                <tr class="optr">
                    <th class="opth">МІСТО</th>
                    <th class="opth">ГОТЕЛЬ</th>
                    <th class="opth">КЛАС</th>
                    <th class="opth">КІМНАТ</th>
                    <th class="opth">МІСТКІСТЬ</th>
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
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
    <h3 id='errorText'></h3>
@endsection

@section('custom_js')
<script src="{{asset('js/hotels.js')}}"></script>
@endsection