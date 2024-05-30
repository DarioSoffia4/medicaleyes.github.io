<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style.css" />
    <script src="jquery.min.js"></script>
    <script src="aos-master/dist/aos.js"></script>
    <link rel="shortcut icon" href="public/favicon.png" type="png" />
      <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
      />
    <link rel="stylesheet" href="aos-master/dist/aos.css" />
    <title>MedicalEyes</title>
  </head>
  <body>
    <div
      class="animate__animated animate__fadeInDown animate__delay-0.5s"
      id="nav-bar"
    >
      <div id="logo-title">
        <div class="blue-text">Medical</div>
        <div class="grey-text">Eyes</div>
      </div>
      <div id="links-bar">
        <ul>
          <li>
            <a
              class="animate__animated animate__fadeInDown animate__delay-0.5s"
              href="#mid-page"
              >Home</a
            >
          </li>
          <li>
            <a
              class="animate__animated animate__fadeInDown animate__delay-0.5s"
              href="#features-page"
              >Features</a
            >
          </li>
          <li>
            <a
              class="animate__animated animate__fadeInDown animate__delay-0.5s"
              href="#aboutus-page"
              >About us</a
            >
          </li>
          <li>
            <a
              class="animate__animated animate__fadeInDown animate__delay-0.5s"
              href="#contact-page"
              >Contacts</a
            >
          </li>
        </ul>
      </div>
      <div>
        <input
          type="button"
          value="Login"
          id="login-button"
          onclick="window.location.href='login'"
        />
        <input
          type="button"
          value="Sign Up"
          id="signup-button"
          onclick="window.location.href='signup'"
        />
      </div>
    </div>
    <div class="animate__animated animate__fadeIn" id="mid-page">
      <div id="mid-left">
        <div id="minititle-mid">
          <img
            src="public/plus28removebgpreview-1@2x.png"
            width="27rem"
            height="27rem"
            id="minimage"
          />
          <div id="text-gray">Powered by</div>
          <div id="text-blue">AI</div>
        </div>
        <div class="title-big-grey">AUTOMATIC</div>
        <div class="title-big-blue">CEPHALOMETRIC</div>
        <div class="title-big-grey">ANALYSIS</div>
        <div class="normal-text-grey">
          MedicalEyes Shaping Health with AI Precision.
        </div>
        <form method="POST" action="signup">
        <div>   
          <input
            type="email"
            placeholder="Enter your email"
            name="emailInput"
            id="input-mid"
            required
          />
        </div>
        <div id="weird-sign">@</div>
        <div id="div-send-button-mid">
          <input  type="submit" value="Send" id="send-button-mid" />
        </div>
        </form>
        <div class="element-ordered">
          <div class="medium-text-grey">Become member of our AI?</div>
          <a class="medium-text-blue" onclick="window.location.href='signup'">Sign up</a>
        </div>
      </div>
      <div id="div-image-mid">
        <img
          src="public/assetsremovebgpreview-1@2x.png"
          width="500px"
          height="510px"
        />
      </div>
    </div>
    <div id="features-page">
      <div class="title-black-bold">Features</div>
      <div class="features-text-normal">
        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
        <br />
        tempor incididunt ut labore et dolore magna aliqua.
      </div>
      <div id="cards-container" data-aos="fade-up">
        <div class="simple-card flip-card">
          <div class="mini-image flip-card-inner">
            <div class="flip-card-front">
              <img
                src="public/icons8editimage96-1-1@2x.png"
                width="53rem"
                height="53rem"
                alt=""
              />
              <div class="card-title">Editing Image</div>
              <div class="text-medium-base">
                Edit your images easily online.
              </div>
              <div class="text-mini-light">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                eiusmod tempor incididunt ut labore et dolore magna aliqua.
              </div>
              <div class="blue-link">
                <a class="blue-link rotate-link">Read more..</a>
              </div>
            </div>
            <div class="flip-card-back">ciao</div>
          </div>
        </div>
        <div class="simple-card flip-card">
          <div class="mini-image flip-card-inner">
            <div class="flip-card-front">
              <img
                src="public/icons8ai96-2-1@2x.png"
                width="53rem"
                height="53rem"
                alt=""
              />
              <div class="card-title">AI Prediction</div>
              <div class="text-medium-base">
                Generate your points with our AI.
              </div>
              <div class="text-mini-light">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                eiusmod tempor incididunt ut labore et dolore magna aliqua.
              </div>
              <div class="blue-link">
                <a class="blue-link rotate-link">Read more..</a>
              </div>
            </div>
            <div class="flip-card-back"></div>
          </div>
        </div>

        <div class="simple-card flip-card">
          <div class="mini-image flip-card-inner">
            <div class="flip-card-front">
              <img
                src="public/icons8privacy96-1-1@2x.png"
                width="52rem"
                height="55rem"
                alt=""
              />
              <div class="card-title">Data Privacy</div>
              <div class="text-medium-base">
                All your data are safe and anonymous
              </div>
              <div class="text-mini-light">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                eiusmod tempor incididunt ut labore et dolore magna aliqua.
              </div>
              <div class="blue-link">
                <a class="blue-link rotate-link">Read more..</a>
              </div>
            </div>
            <div class="flip-card-back"></div>
          </div>
        </div>
      </div>
    </div>
    <div id="aboutus-page">
      <div>
        <img
          src="public/uni-1_2x-removebg.png"
          width="450rem"
          height="450rem"
          alt=""
        />
      </div>
      <div id="container-about-text">
        <div class="title-black-bold" id="aboutus-title-page">About Us</div>
        <div class="mid-text-grey-big">
          Three students,
          <strong>Yassin Allouche, Dario Soffiantini, and Matteo Conte</strong>
          , driven by a passion for computer science, are the promoters of this
          project. <br />
          The concept stems from the rapid development of
          <strong>artificial intelligence and machine learning</strong> in
          recent times, with the need to expand their application to various
          fields, including the one our project focuses on:
          <strong>medicine</strong>. <br />
          Our idea centers around the analysis of
          <strong>cephalometric X-rays</strong>, aiming to identify anatomical
          points and their corresponding tracings without requiring the doctors
          to spend the necessary <strong> time manually </strong>locating them.
        </div>
      </div>
    </div>
    <div id="contact-page">
      <div class="title-black-bold">Contact Us</div>
      <div class="medium-text-grey" id="contact-minititle-text">
        Fill out the form below and we'll put you in touch with the right team.
        For <br />
        technical support and questions, please head over to our
        <a class="blue-text">Help Center</a>.
      </div>
      <form id="contact-page-mid" action="functions/email_sender.php" method="POST">
        <div id="container-form-contact">
          <div class="two-divs-form">
            <input required class="input-mini-form" placeholder="First Name" id="firstName" name="firstName"/>
            <input class="input-mini-form" placeholder="Last Name" id="lastName" name="lastName"/>
          </div>
          <div class="two-divs-form">
            <input
              required
              type="email"
              class="input-mini-form"
              id="workEmail"
              name="workEmail"
              placeholder="Work email"
            />
            <input class="input-mini-form" placeholder="Company name" id="companyName" name="companyName"/>
          </div>
          <div id="one-div-form">
            <!--<input required class="input-big-form" placeholder="How can we help you?">-->
            <textarea
              required
              id="word_count"
              name="word_count"
              maxlength="1000"
              class="input-big-form"
              placeholder="How can we help you?"
            ></textarea>
          </div>
          <div class="words-left"><span id="display_count">0</span>/200</div>
          <div id="button-div-contacts">
            <input
              required
              id="get-touch-button"
              type="submit"
              value="GET IN TOUCH"
              
            />
            <div id="privacy-contact-text">
              By submitting, you agree to MedicalEyes's
              <a href="" class="blue-text"> Privacy Policy</a>.
            </div>
          </div>
        </div>
      </form>
    </div>
    <script>
      AOS.init({   
        duration: 5000,
        once: true,
      });
    </script>
  </body>
  <script src="https://smtpjs.com/v3/smtp.js"></script>
  <script src="index.js"></script>
</html>
