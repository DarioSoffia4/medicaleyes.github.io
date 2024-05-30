<?php 
    //require 'googleApi/vendor/autoload.php';

    
    $gClient = new Google_Client();
    $gClient->setClientId("613626717646-mtqa42l751r9dvg3tqqsde8h9qefgbmh.apps.googleusercontent.com");
    $gClient->setClientSecret("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");
    $gClient->setApplicationName("medicaleyes");
    $gClient->setRedirectUri("http://localhost/medicalEyes/functions/google_session.php");
    $gClient->addScope("https://www.googleapis.com/auth/userinfo.email https://www.googleapis.com/auth/userinfo.profile");

    $login_url = $gClient->createAuthUrl();
?>