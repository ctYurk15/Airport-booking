@extends("layouts.reglog_layout")

@section('title', 'Вхід')

@section('content')
<div class="form loginDivContainer">
    <div class="top-row">
        <div id="login">   
            <h1>Вхід</h1>
            <form action="/" method="post" id="loginForm">
                <div class="field-wrap">
                    <label for="emailInp">
                    Пошта
                    </label>
                    <br>
                    <input type="email" required autocomplete="off" id="emailInp">
                </div>
                
                <div class="field-wrap">

                    <label for="passInp">
                    Пароль
                    </label>
                    <br>
                    <input type="password" required autocomplete="off" id="passInp">
                </div>

                <div class="container">
                    <input type="submit" class="button" value="Ввійти" id="submitButton" data-route="{{route('authorize')}}" data-route2="{{route('flights')}}">
                </div>

                <p class="forgot"><a href="#">Забули пароль?</a></p> 
            </form>
        </div>
        <h3 id='errorText'></h3>

        <div class = "registration">
            <a href="{{route('registration')}}">Реєстрація</a>
        </div>
    </div><!-- tab-content -->
</div>
@endsection

@section('custom_js')
<script src="{{asset('js/login.js')}}"></script>
@endsection