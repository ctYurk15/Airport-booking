@extends("layouts.reglog_layout")

@section('content')
<div class="form loginDivContainer">
      <div class="tab-content">
        <div id="signup">   
          <h1>Registration</h1>

          <form action="phpScripts/registration.php" method="post" id='regForm'>
              <div class="top-row">
                <div class="field-wrap">
                  <label>
                    First Name
                  </label>
                  <input type="text" required autocomplete="off" id="firstnameInp">
                </div>

                <div class="field-wrap">
                  <label>
                    Last Name
                  </label>
                  <input type="text"required autocomplete="off" id="lastnameInp">
                </div>
              </div>

              <div class="field-wrap">
                <label>
                  Email Address
                </label>
                <input type="email"required autocomplete="off" id="emailInp">
              </div>

              <div class="field-wrap">
                <label>
                  Set A Password
                </label>
                <input type="password" required autocomplete="off" id="passInp">
              </div>

              <button type="submit" class="button button-block">Get Started</button>
          </form>
        </div>
        <h3 id='errorText'></h3>
        
        <div class = "Login">
            <a href="{{route('login')}}">Log In</a>
        </div>
      </div>
    </div> 
    @endsection