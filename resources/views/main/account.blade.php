@extends('layouts.main_layout')

@section('title', 'Аккаунт')

@section('content')
<a href="" id='unloginLink' data-route="{{route('unlogin')}}" data-route2="{{route('login')}}">Вийти з аккаунту</a>
    <div id="purchaseDiv" class="hidden">
        <h1>Квитки</h1>
        <table border='1px' id='ticketsTable'>
            <tr>
                <td>Номер рейсу</td>
                <td>Місце</td>
            </tr>
        </table>
        <h1>Готелі</h1>
        <table border='1px' id='hotelRoomsTable'>
            <tr>
                <td>Готель</td>
                <td>Клас кімнати</td>
            </tr>
        </table>
    </div>
    
    <div class="infoDivContainer hidden" id='passportRequestDiv'>
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
          <button type="submit" class="button button-block">Відправити</button>
         
        </div>
      </form>
       
    </div>
    <h2 id='statusText'></h2>
    <h3 id='errorText'></h3>
@endsection

@section('custom_js')
<script src="{{asset('js/account.js')}}"></script>
@endsection