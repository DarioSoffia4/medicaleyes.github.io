<?php

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        require('conf_db.php');

        
        $project_name = $_POST['popup-input-name'];
        $project_description = $_POST['popup-input-description'];


        $stmt = $conn->prepare("INSERT INTO project (name,Description,CreationDate,IdUser,IdState) VALUES (?,?,now(),?,1)");
        $stmt->bind_param('ssi',$project_name, $project_description, $_SESSION['id']);
        $stmt->execute();
        $projectId = $conn->insert_id;

        if (!file_exists('uploads/'.$_SESSION['id'].'/'.$projectId)) {
            mkdir('uploads/'.$_SESSION['id'].'/'.$projectId, 0777, true);
        }

        if (!isset($_FILES["image-upload"]) || $_FILES["image-upload"]["error"] > 0) {
            echo "Error: No file uploaded or an error occurred while uploading.";
        } else {
            $allowed_types = array("image/jpeg", "image/png");
            $file_type = $_FILES["image-upload"]["type"];

            if (!in_array($file_type, $allowed_types)) {
                echo "Error: Only JPG and PNG files are allowed.";
            } else {
                $upload_dir = 'uploads/'.$_SESSION['id'].'/'.$projectId.'/';
                $upload_file = $upload_dir . basename($_FILES["image-upload"]["name"]);

                if (move_uploaded_file($_FILES["image-upload"]["tmp_name"], $upload_file)) {
                    $url = $upload_dir.basename($_FILES["image-upload"]["name"]);
                    $file_name = basename($_FILES["image-upload"]["name"]);
                    $file_name = pathinfo($file_name, PATHINFO_FILENAME);

                    $stmt = $conn->prepare("INSERT INTO image (url,IdProject,name) VALUES (?,?,?);");
                    $stmt->bind_param('sis',$url,$projectId,$file_name);
                    $stmt->execute();
                    
                    header("Location: dashboard");
                } else {
                    echo "Error: Unable to move the uploaded file.";
                }
            }
        }
    } else {
        echo "Error: Access denied.";
    }
?>

