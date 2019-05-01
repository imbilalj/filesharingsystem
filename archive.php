<?php
  session_start();
  if(empty($_SESSION['user_id']) && empty($_SESSION['admin_id'])) {
    header('Location: index.php');
    exit();
  }
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
        <h1>Upload a New File!</h1>
        <form action="fileprocess.php" method="POST" enctype="multipart/form-data">
          <input type="file" name="newupload">
          <button type="submit" class="btn">Upload File</button>
        </form>
      </div>
    </section>

    <section id="main">
      <div class="container">
        <div class="file">
          <h3>File name</h3>
          <p>Uploaded by: Bilal</p>
          <p>Date: 21/05/2019</p>
          <a href="#">Download</a>
        </div>
        <div class="file">
          <h3>File name</h3>
          <p>Uploaded by: Bilal</p>
          <p>Date: 21/05/2019</p>
          <a href="#">Download</a>
        </div>
        <div class="file">
          <h3>File name</h3>
          <p>Uploaded by: Bilal</p>
          <p>Date: 21/05/2019</p>
          <a href="#">Download</a>
        </div>
      </div>
    </section>

    <footer id="footer">
      <p>Complete CMS Copyright &copy; 2019</p>
    </footer>
  </body>
</html>