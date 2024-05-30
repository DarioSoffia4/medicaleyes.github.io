<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>   
</head>
<body>
    <?php
         session_start();
         if($_SERVER['REQUEST_METHOD'] == 'POST'){
            require('conf_db.php');

            $insertname = $_POST['nameSignup'];
            $insertemail = $_POST['emailSignup'];
            $insertpsw = $_POST['passwordSignup'];

            $stmt = $conn->prepare("SELECT Email,Password FROM user WHERE Email= ?");
            $stmt->bind_param('s',$insertemail);
            $stmt->execute();
            $result = $stmt->get_result();

            if($result->num_rows === 0){
                $insertpsw = md5($insertpsw);
                $stmt1 = $conn->prepare("INSERT INTO user (Id, Name, Email, Password) VALUES (NULL, ?, ?, ?)");
                $stmt1->bind_param('sss',$insertname,$insertemail,$insertpsw);
                $stmt1->execute();
                
                header("Location: ../login");
            }
            else echo "Already exist";
            
            $conn->close();
            
        }
    ?>
</body>
</html>