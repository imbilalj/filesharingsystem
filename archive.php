<?php
  session_start();
  if(empty($_SESSION['user_id']) && empty($_SESSION['admin_id'])) {
    header('Location: index.php');
    exit();
  }

  require_once("functions.php");

  $fileData = getFileData();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complete CMS</title>
    <link rel="stylesheet" href="css/archive.css">
  </head>
  <body>
    <header>
      <div class="container">
        <div id="logo">
          <h1><span class="highlight">Complete</span> CMS</h1>
        </div>
        <nav>
          <ul>
            <li class="current"><a href="index.php">Home</a></li>
            <li><a href="contact.php">Contact</a></li>
            <li class="btn-nav"><a href="logout.php">Logout</a></li>
          </ul>
        </nav>
      </div>
    </header>

    <section id="fileupload">
      <div class="container">
        <!-- Upload Success Message -->
        <?php
          if(isset($_SESSION['uploadSuccess'])) {
        ?>
        <h2 class="success"><?php echo $_SESSION['uploadSuccess']; ?></h2>
        <?php
            unset($_SESSION['uploadSuccess']);
          }
        ?>
        <!-- Upload Failed Message -->
        <?php
          if(isset($_SESSION['uploadFailed'])) {
        ?>
        <h2 class="failed"><?php echo $_SESSION['uploadFailed']; ?></h2>
        <?php
            unset($_SESSION['uploadFailed']);
          }
        ?>
        <h1>Upload a New File!</h1>
        <form action="fileprocess.php" method="POST" enctype="multipart/form-data">
          <input type="text" name="title" placeholder="Enter Title..." required>
          <label for="description">Description: </label>
          <textarea rows="5" cols="35" id="description" name="description" placeholder="Enter Description..." required>
          </textarea>
          <input type="file" name="newupload">
          <input type="submit" class="btn" value="Upload File">
        </form>
      </div>
    </section>

    <section id="main">
      <div class="container">
        <?php
          if($fileData->num_rows > 0) {
            while($row = $fileData->fetch_assoc()) {
        ?>
        <div class="file">
          <h2><?php echo $row['title']; ?></h2>
          <h3><?php echo $row['description']; ?></h3>
          <?php
            if(is_null($row['user_id'])) {
              $user = 'Admin';
            } else {
              $user = getUserNameById($row['user_id']);
            }
          ?>
          <p>Uploaded by: <?php echo $user; ?></p>
          <?php
            $time = strtotime($row['uploaddate']);
            $uploadtime = date("m/d/y g:i A", $time);
          ?>
          <p><?php echo $uploadtime; ?></p>
          <a href="user-uploads/<?php echo $row['file_name']; ?>">Download</a>
        </div>
        <?php
            }
          }
        ?>
      </div>
    </section>

    <footer id="footer">
      <p>File CMS Copyright &copy; 2019</p>
    </footer>
  </body>
</html>