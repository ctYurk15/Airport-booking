@extends('layouts.main_layout')

@section('title', 'Аккаунт')

@section('custom_css')
<link rel="stylesheet" href="{{asset('css/account.css')}}"></link>
@endsection

@section('content')
@if(!is_null($user))
  <a href="" id='unloginLink' data-route="{{route('unlogin')}}" data-route2="{{route('login')}}">Вийти з аккаунту</a>

  @if(is_null($user->PassId) && (is_null($user->passport_request) || (!$user->passport_request->Confirmed && !is_null($user->passport_request->Confirmed))))
    <div class="infoDivContainer" id='passportRequestDiv'>
      <h1>Passport Info</h1>
      <form action="/" method="post" id='passIdForm'>
        <div class="toCenter">
          <div class="inline">
            <div class="field-wrap ">
              <div class="labelSize">
                <label>
                  First Name
                </label>
              </div>
              <input type="text" required autocomplete="off" id='firstname'>
            </div>
            <div class="field-wrap ">
              <div class="labelSize">
                <label>
                  Second Name
                </label>
              </div>
              <input type="text" required autocomplete="off" id='lastname'>
            </div>
            <div class="field-wrap ">
              <div class="labelSize">
                <label>
                  Sex
                </label>
              </div>
              <select id='sex'>
                  <option>Male</option>
                  <option>Female</option>
                </select>
            </div>
          </div>
          <div class="inline">
            <div class="field-wrap">
              <div class="labelSize">
                <label>
                  Passport ID
                </label>
              </div>
              <input type="text"required autocomplete="off" id='passId'>
            </div>
            <div class="field-wrap ">
              <div class="labelSize">
                <label>
                  Date of birth
                </label>
              </div>
              <input type="text" required autocomplete="off" id='birthDate'>
            </div>
            <div class="field-wrap ">
            <div class="labelSize">
              <label>
                Inter. Passport
              </label>
            </div>
            <input type="text" required autocomplete="off" id='interPassId'>
          </div>
          </div>
          
        </div>
        <div>
          <button type="submit" class="button button-block" id="submitButton" data-route="{{route('passport_request')}}">Відправити</button>
          
        </div>
      </form>
        
    </div>
    @if(!is_null($user->passport_request) && !$user->passport_request->Confirmed)
      <h2 id='statusText'>Ваш запит було відхилено. Спробуйте ще раз</h2>
    @endif
  @elseif(!is_null($user->passport_request) && is_null($user->passport_request->Confirmed))
    <h2 id='statusText'>Ваш запит ще обробляється</h2>
  @elseif(!is_null($user->PassId) && $user->passport_request->Confirmed)
    <div id="purchaseDiv"
        <h1>Квитки</h1>
        <table border='1px' id='ticketsTable'>
            <tr>
                <td>Номер рейсу</td>
                <td>Місце</td>
            </tr>
            @foreach($user->tickets as $ticket)
              <tr>
                  <td>{{$ticket->Reis_id1}}</td>
                  <td>{{$ticket->PlaceNumber}}</td>
              </tr>
            @endforeach
        </table>
        <h1>Готелі</h1>
        <table border='1px' id='hotelRoomsTable'>
            <tr>
                <td>Готель</td>
                <td>Клас кімнати</td>
            </tr>
            @foreach($user->rooms as $room)
              <tr>
                  <td>{{$room->hotel->Name}}</td>
                  <td>{{$room->roomtype->Name}}</td>
              </tr>
            @endforeach
        </table>
    </div>
    <h1>
      Ваш аккаунт успішно верифіковано.<br> 
      ID вашого паспорта: {{$user->PassId}}
    </h1>
  @endif
  <h3 id='errorText'></h3>
@endif
@endsection

@section('custom_js')
<script src="{{asset('js/account.js')}}"></script>
@endsection