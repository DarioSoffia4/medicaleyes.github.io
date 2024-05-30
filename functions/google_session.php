<?php
    session_start();
    require('conf_db.php');
    require ('../googleApi/vendor/autoload.php');
    require('conf_google.php');

    if(isset($_GET["code"])){
        $token = $gClient->fetchAccessTokenWithAuthCode($_GET["code"]);
    }else{
        header("Location: home");
        exit();
    }

    $oAuth = new Google_Service_OAuth2($gClient);
    $userData = $oAuth->userinfo_v2_me->get();
    $nome = $userData['givenName'];
    $mail = $userData['email'];

    $stmt = $conn->prepare("SELECT Email,Password FROM user WHERE Email= ?");
    $stmt->bind_param('s',$mail);
    $stmt->execute();
    $result = $stmt->get_result();


    if($result->num_rows === 0){
        $stmt1 = $conn->prepare("INSERT INTO user (Id, Name, Email, googleSign) VALUES (NULL, ?, ?, ?)");
        $true = 1;
        $stmt1->bind_param('ssi',$nome,$mail,$true);
        $stmt1->execute();

        $_SESSION['name'] = $nome;
        $_SESSION['email'] = $mail;
    }
    else{
        $_SESSION['name'] = $nome;
        $_SESSION['email'] = $mail;
    }

    $stmt = $conn->prepare("SELECT user.Id FROM user WHERE user.Email=?");
    $stmt->bind_param('s',$_SESSION['email']);
    $stmt->execute();
    $result = $stmt->get_result();
    $row_no = $result->num_rows - 1;
    $result->data_seek($row_no);
    $array = $result->fetch_array();
    $_SESSION['id'] = $array['Id'];

    header("Location: ../dashboard");
    $conn->close();
    //echo "<pre>";
    //var_dump($userData);
    //echo "</pre>";

?>