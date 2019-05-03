<?php
  session_start();

  if(empty($_SESSION['user_id']) && empty($_SESSION['admin_id'])) {
    header('Location: index.php');
    exit();
  }
  
  if(isset($_POST)) {
    if(isset($_POST)) {

      $uploadOk = true;
    
      if(isset($_FILES)) {
    
        $folder_dir = "user-uploads/";
    
        $base = basename($_FILES['newupload']['name']);
    
        $fileType = pathinfo($base, PATHINFO_EXTENSION); 
    
        $file = uniqid() . "." . $fileType;   
    
        $filename = $folder_dir .$file;  
    
        if(file_exists($_FILES['newupload']['tmp_name'])) { 
          
          if($fileType == "pdf")  {
    
            if($_FILES['newupload']['size'] < 500000) {
    
              move_uploaded_file($_FILES["newupload"]["tmp_name"], $filename);
    
            } else {
              $_SESSION['uploadError'] = "File too large. Max Size Allowed : 5MB";
              header("Location: archive.php");
              exit();
            }
          } else {
            $_SESSION['uploadError'] = "Wrong Format. Only PDF Allowed";
            header("Location: archive.php");
            exit();
          }
        }
      } else {
        $uploadOk = false;
      }

      $date = date('Y-m-d H:i:s');

      if(isset($_SESSION['user_id'])) {
        //SQL query for users
        $sql = "INSERT INTO files(user_id, admin_id, uploaddate, file_name) VALUES('$_SESSION['user_id']', NULL, '$date', ";
      }
      
      if(isset($_SESSION['admin_id'])) {
        //SQL Query for admin
        $sql = "INSERT INTO files(user_id, admin_id, uploaddate, file_name) VALUES(NULL, '$_SESSION['admin_id']','$date', ";
      }
      
    
      if($uploadOk == true) {
        $sql .= "'$file')";
      }
    
      if($conn->query($sql) === TRUE) {
        $_SESSION['uploadSuccess'] = 'File Upload Successfully!';
        header("Location: archive.php");
        exit();
      } else {
        echo "Error ". $sql . "<br>" . $conn->error;
      }
      $conn->close();
    
    } else {
      header("Location: archive.php");
      exit();
    }
  }
?>