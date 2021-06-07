@extends("layouts.reglog_layout")

@section('content')
<div class="form loginDivContainer">
    <div class="top-row">
        <div id="login">   
            <h1>Log in</h1>
            <form action="phpScripts/loginScript.php" method="post" id="loginForm">
                <div class="field-wrap">
                    <label for="emailInp">
                    Email Address
                    </label>

                    <input type="email" required autocomplete="off" id="emailInp">
                </div>
                
                <div class="field-wrap">

                    <label for="passInp">
                    Password
                    </label>
                    <br>
                    <input type="password" required autocomplete="off" id="passInp">
                </div>

                <div class="container">
                    <input type="submit" class="button" value="Log in">
                </div>

                <p class="forgot"><a href="#">Forgot Password?</a></p> 
            </form>
        </div>
        <h3 id='errorText'></h3>

        <div class = "registration">
            <a href="{{route('register')}}">Registration</a>
        </div>
    </div><!-- tab-content -->
</div>
@endsection