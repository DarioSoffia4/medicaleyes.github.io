<?php

    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
    require('googleApi/vendor/autoload.php');
    require('functions/conf_db.php');
    require('functions/conf_google.php');
    if(isset($_SESSION['email'])){
        header("Location: dashboard");
    }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style.css" />
    <script src="jquery.min.js"></script>
    <script src="app.js"></script>
    <link rel="shortcut icon" href="public/favicon.png" type="png" />
    <title>MedicalEyes</title>
  </head>
  <body>
    <div id="nav-bar-login">
      <div id="logo-title" onclick="window.location.href='home'">
        <div class="blue-text">Medical</div>
        <div class="grey-text">Eyes</div>
      </div>
      <div>
        <input
          type="button"
          value="Sign Up"
          id="signup-button"
          onclick="window.location.href='signup'"
        />
      </div>
    </div>
    <div id="login-mid-page">
      <div>
        <img src="public/login-image.png" width="680px" height="460px" />
      </div>
      <div id="login-input-form">
        <div class="card-title"><strong>Login</strong></div>
        <div class="normal-text-grey" id="grey-text-normal">
          How do i get started in MedicalEyes?
        </div>
        <div>
          <button id="google-button" onclick = "window.location = '<?php echo $login_url; ?>'">
            <img
              id="google-logo"
              src="public/googlelogo.png"
              width="24px"
              height="24px"
            />
            Login with Google
          </button>
        </div>
        <form method="POST" action="functions/login_response.php">
        <div class="mini-title-login">Email</div>
        <input
          type="email"
          class="input-login"
          id="emailLogin"
          name="emailLogin"
          placeholder="Enter your Email"
          required
        />
        <div class="mini-title-login">Password</div>
        <input
          type="password"
          class="input-login"
          id="passwordLogin"
          name="passwordLogin"
          placeholder="Enter your Password"
          required
        />
        <a id="forget-pass">Forget Password?</a>
        <button id="loginpage-button">Login</button>
      </form>
    </div>
  </body>
</html>
