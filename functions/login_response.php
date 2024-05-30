
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
</head>
<body>
    <?php
         if($_SERVER['REQUEST_METHOD'] == 'POST'){
            
            require('conf_db.php');

            $insertemail = $_POST['emailLogin'];
            $insertpsw = $_POST['passwordLogin'];

            $stmt = $conn->prepare("SELECT * FROM user WHERE Email=? AND Password=?");
            $insertpsw = md5($insertpsw);
            $stmt->bind_param('ss',$insertemail, $insertpsw);
            $stmt->execute();
            $result = $stmt->get_result();
            if($result->num_rows !== 0){
                session_start();
                $row = $result->fetch_assoc();
                for ($row_no = $result->num_rows - 1; $row_no >= 0; $row_no--) {
                    $result->data_seek($row_no);
                    $array = $result->fetch_array();
                    $_SESSION['name'] = $array['Name'];
                }
                $_SESSION['email'] = $_POST['emailLogin'];


                $stmt = $conn->prepare("SELECT user.Id FROM user WHERE user.Email=?");
                $stmt->bind_param('s',$_SESSION['email']);
                $stmt->execute();
                $result = $stmt->get_result();
                $row_no = $result->num_rows - 1;
                $result->data_seek($row_no);
                $array = $result->fetch_array();
                $_SESSION['id'] = $array['Id'];

                if (!file_exists('../uploads/'.$_SESSION['id'])) {
                    mkdir('../uploads/'.$_SESSION['id'], 0777, true);
                }

                header("Location: ../dashboard");
            }
            else echo "Wrong Credential";
            $conn->close();
            
        }
    ?>
</body>
</html>