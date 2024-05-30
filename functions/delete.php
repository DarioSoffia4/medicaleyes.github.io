<?php

    function deleteDirectory($dirPath) {
        if (is_dir($dirPath)) {
        $files = scandir($dirPath);
        foreach ($files as $file) {
            if ($file !== '.' && $file !== '..') {
                $filePath = $dirPath . '/' . $file;
                if (is_dir($filePath)) {
                    deleteDirectory($filePath);
                } else {
                    unlink($filePath);
                }
            }
        }
        rmdir($dirPath);
        }
    }

    if(isset($_GET['id'])){
        require('functions/conf_db.php');
        
        $dir = 'uploads/'.$_SESSION['id'].'/'.$_GET['id'].'/';

        $stmt = $conn->prepare("DELETE FROM project WHERE id=?" );
        $stmt->bind_param('i',$_GET['id']);
        $stmt->execute();

        deleteDirectory($dir);
        
        header("Location: dashboard");
    }



?>