<?php
    if(!isset($_SESSION)){ 
        session_start(); 
    } 
    require('googleApi/vendor/autoload.php');
    require('functions/conf_google.php');
    require('functions/conf_db.php');
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
          value="Login"
          id="signup-button"
          onclick="window.location.href='login'"
        />
      </div>
    </div>
    <div id="login-mid-page">
      <div>
        <img src="public/login-image.png" width="680px" height="460px" />
      </div>
      <!--  -->
       <div name="registration" id="login-input-form" method = "POST" action="signup_response.php"> 
        <div class="card-title"><strong>Sign Up</strong></div>
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
            Sign in with Google
          </button>
        </div>
        <form name="registration" method = "POST" action="functions/signup_response.php"> 
        <div id="signup-name">
          <div>
            <div class="mini-title-login">Name</div>
            <input
              class="input-signup"
              id="nameSignup"
              name="nameSignup"
              placeholder="Enter your Name"
              required
            />
          </div>
          <div>
            <?php
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $insertemail=$_POST['emailInput'];
                echo"<div class='mini-title-login'>Email</div>
                <input
                  type='email'
                  class='input-login'
                  id='input-signup-login'
                  name='emailSignup'
                  value='".$insertemail."'
                  readonly='readonly'
                />
              </div>" ;
            }else{
              echo"<div class='mini-title-login'>Email</div>
              <input
                type='email'
                class='input-login'
                id='input-signup-login'
                name='emailSignup'
                placeholder='Enter your Email'
                required
              />
            </div>" ;
            }
            ?>
        </div>

        <div class="mini-title-login">Password</div>
        <input
          type="password"
           class="input-login"
          id="passwordSignup"
          name="passwordSignup"
          placeholder="Enter your Password"
          required
        />
        <div id="div-policy">
          <div class="checkbox-wrapper-13">
            <input id="c1-13" type="checkbox" required />
          </div>
          <div id="div-policy-text">
            I've read and agree with
            <a class="blue-text" id="normal-link-size">Terms of Services</a> and
            our <a class="blue-text" id="normal-link-size"> Privacy Policy</a>
          </div>
        </div>
        <button type="submit" id="loginpage-button">Sign Up</button>
      </form>
      </div>
    </div>
  </body>
  <script src="jquery.min.js"></script>
  <script src="app.js"></script>
  </html>
