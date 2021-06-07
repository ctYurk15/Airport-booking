@extends("layouts.reglog_layout")

@section('title', 'Реєстрація')

@section('content')
<div class="form loginDivContainer">
      <div class="tab-content">
        <div id="signup">   
          <h1>Реєстрація</h1>

          <form action="phpScripts/registration.php" method="post" id='regForm'>
              <div class="top-row">
                <div class="field-wrap">
                  <label>
                    Ім'я
                  </label>
                  <br>
                  <input type="text" required autocomplete="off" id="firstnameInp">
                </div>

                <div class="field-wrap">
                  <label>
                    Прізвище
                  </label>
                  <br>
                  <input type="text"required autocomplete="off" id="lastnameInp">
                </div>
              </div>

              <div class="field-wrap">
                <label>
                  Пошта
                </label>
                <br>
                <input type="email"required autocomplete="off" id="emailInp">
              </div>

              <div class="field-wrap">
                <label>
                  Пароль
                </label>
                <br>
                <input type="password" required autocomplete="off" id="passInp">
              </div>

              <button type="submit" class="button button-block">Зареєструватися</button>
          </form>
        </div>
        <h3 id='errorText'></h3>
        
        <div class = "Login">
            <a href="{{route('login')}}">Ввійти</a>
        </div>
      </div>
    </div> 
    @endsection