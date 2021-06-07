@extends('layouts.main_layout')

@section('content')
<h1>Готелі</h1>
    
    <div class="row">
        <form action="/" method="post" id='filtersForm'>
            <div class="fromToDate">
                <label for="from_to">ГОТЕЛЬ *</label><br>
                <select id='hotel'>
                    
                </select>
            </div>

            <div class="fromToDate">
                <label for="airport">КЛАС КІМНАТИ *</label><br>
                <select id='class'>
                    
                </select>
            </div>
            <div class="show_button">
                <input type='submit' class='button' value='Показати'>
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
                    <th class="opth"></th>
                </tr>
            </thead>
            <tbody id='rooms'>
                
            </tbody>
        </table>
    </div>
    
    <h3 id='errorText'></h3>
@endsection