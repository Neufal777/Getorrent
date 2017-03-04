<?php
session_start();

if (isset($_SESSION['id'])) {
    $username = $_SESSION['username'];
} else {
    header("location: index.php");
}
?>

<html>
<head>
    <title>Upload Torrent File</title>
    <script src="js/jquery.js"></script>
    <link rel="stylesheet" type="text/css" href="css/upload_css.css">
    <link rel="stylesheet" type="text/css" href="bootstrap-3.3.6-dist/css/bootstrap.css">
</head>
<body>
  <!-- HEADER START -->
    <div id="home_header">
        <a href="home.php"><img id="logo" src="img/logo.png"></a>
    <div id="home_search_person">
<form method="POST" action="search.php">
<input type="text" class="form-control search_input input-sm" name="searched_input" placeholder="Search (Click Enter To Search)"></form></div>
    <div id="home_menu">
<ul>
<li><a href="profile.php?user=<?php echo $username; ?>"> Profile</a></li>
<li><a href="upload.php"> Upload</a></li>
<li><a href="php/log_out.php"> Log Out</a></li></ul></div>

</div>
<!-- HEADER FINAL -->
    <div id="upload_form_container_general">
     <div id="login">
      <form name='form-login' method="POST" enctype="multipart/form-data">
          <label class="white" for="sel1">Choose A Name:</label>
          <input type="text" class="form-control" name="post_name" placeholder="Name (Max 50 Characters)">
<br>
          <div class="form-group">
               <label class="white" for="sel1">Select A Topic:</label>
               <br>
          <select name="topic" class="form-control">
              <option>Topic...</option>
              <option>Movies</option>
              <option>Music</option>
              <option>Books</option>
              <option>Software</option>
              <option>3dModels</option>
              <option>Porn</option>
              <option>Videogames</option>
              <option>Pdf</option>
              <option>Other</option>
          </select>
      </div>
          <br>
           <label class="white" for="sel1">Select Torrent File</label>
          <input class="foo" type="file" id="user" name="torrent_file">
          <br>

        <input name="submit_post" type="submit" value="Upload Torrent File">
    </div>
    </div>

</form>
</body>
</html>

<?php

if (isset($_POST['submit_post'])) {
    include 'php/connection.php';
    
    
    /*GENERATE RANDOM CHARACTERS*/
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
    $gen        = '';
    for ($i = 0; $i < 5; $i++)
        $gen .= $characters[mt_rand(0, 61)];
    /*FINAL GENERATE RANDOM CHARACTERS*/
    
    $name         = mysqli_real_escape_string($db_con, $_POST['post_name']);
    $topic        = mysqli_real_escape_string($db_con, $_POST['topic']);
    $torrent_file = $gen . $_FILES['torrent_file']['name'];
    $ext_file     = pathinfo($torrent_file, PATHINFO_EXTENSION);
    $author       = $_SESSION['name'] . " " . $_SESSION['surname'];
    $user         = $_SESSION['username'];
    if ($ext_file == "torrent") {
        
        if ($topic == "Topic...") {
            echo "<div class='alert alerta alert-danger' role='alert'><strong>FAIL !</strong> Please Select A Topic!</div>";
        } elseif ($topic == "Movies") {
            $check_movies = mysqli_query($db_con, "SELECT * FROM uploads WHERE name = '$name'");
            if (mysqli_num_rows($check_movies) > 0) {
                echo "<div class='alert alerta alert-danger' role='alert'><strong>FAIL !</strong> This Name Alredy Exists!</div>";
            } else {
                mysqli_query($db_con, "INSERT INTO uploads(name,topic,file,author,user) values ('$name','$topic','$torrent_file','$author','$user')");
                move_uploaded_file($_FILES['torrent_file']['tmp_name'], "uploads/Movies/$torrent_file");
                echo "<div class='alert alerta alert-Success' role='alert'><strong>NICE !</strong> Uploaded Correctly!</div>";
            }
        } elseif ($topic == "Other") {
            
            $check_other = mysqli_query($db_con, "SELECT * FROM uploads WHERE name = '$name'");
            if (mysqli_num_rows($check_other) > 0) {
                echo "<div class='alert alerta alert-danger' role='alert'><strong>FAIL !</strong> This Name Alredy Exists!</div>";
            } else {
                mysqli_query($db_con, "INSERT INTO uploads(name,topic,file,author,user) values ('$name','$topic','$torrent_file','$author','$user')");
                move_uploaded_file($_FILES['torrent_file']['tmp_name'], "uploads/Other/$torrent_file");
                echo "<div class='alert alerta alert-Success' role='alert'><strong>NICE !</strong> Uploaded Correctly!</div>";
            }
        } elseif ($topic == "Music") {
            $check_music = mysqli_query($db_con, "SELECT * FROM uploads WHERE name = '$name'");
            if (mysqli_num_rows($check_music) > 0) {
                echo "<div class='alert alerta alert-danger' role='alert'><strong>FAIL !</strong> This Name Alredy Exists!</div>";
            } else {
                mysqli_query($db_con, "INSERT INTO uploads(name,topic,file,author,user) values ('$name','$topic','$torrent_file','$author','$user')");
                move_uploaded_file($_FILES['torrent_file']['tmp_name'], "uploads/Music/$torrent_file");
                echo "<div class='alert alerta alert-Success' role='alert'><strong>NICE !</strong> Uploaded Correctly!</div>";
            }
        } elseif ($topic == "Videogames") {
            $check_videogames = mysqli_query($db_con, "SELECT * FROM uploads WHERE name = '$name'");
            if (mysqli_num_rows($check_videogames) > 0) {
                echo "<div class='alert alerta alert-danger' role='alert'><strong>FAIL !</strong> This Name Alredy Exists!</div>";
            } else {
                mysqli_query($db_con, "INSERT INTO uploads(name,topic,file,author,user) values ('$name','$topic','$torrent_file','$author','$user')");
                move_uploaded_file($_FILES['torrent_file']['tmp_name'], "uploads/Videogames/$torrent_file");
                echo "<div class='alert alerta alert-Success' role='alert'><strong>NICE !</strong> Uploaded Correctly!</div>";
            }
        } elseif ($topic == "Books") {
            $check_books = mysqli_query($db_con, "SELECT * FROM uploads WHERE name = '$name'");
            if (mysqli_num_rows($check_books) > 0) {
                echo "<div class='alert alerta alert-danger' role='alert'><strong>FAIL !</strong> This Name Alredy Exists!</div>";
            } else {
                mysqli_query($db_con, "INSERT INTO uploads(name,topic,file,author,user) values ('$name','$topic','$torrent_file','$author','$user')");
                move_uploaded_file($_FILES['torrent_file']['tmp_name'], "uploads/Books/$torrent_file");
                echo "<div class='alert alerta alert-Success' role='alert'><strong>NICE !</strong> Uploaded Correctly!</div>";
            }
        } elseif ($topic == "Software") {
            $check_software = mysqli_query($db_con, "SELECT * FROM uploads WHERE name = '$name'");
            if (mysqli_num_rows($check_software) > 0) {
                echo "<div class='alert alerta alert-danger' role='alert'><strong>FAIL !</strong> This Name Alredy Exists!</div>";
            } else {
                mysqli_query($db_con, "INSERT INTO uploads(name,topic,file,author,user) values ('$name','$topic','$torrent_file','$author','$user')");
                move_uploaded_file($_FILES['torrent_file']['tmp_name'], "uploads/Software/$torrent_file");
                echo "<div class='alert alerta alert-Success' role='alert'><strong>NICE !</strong> Uploaded Correctly!</div>";
            }
        } elseif ($topic == "3dModels") {
            $check_3dmodels = mysqli_query($db_con, "SELECT * FROM uploads WHERE name = '$name'");
            if (mysqli_num_rows($check_3dmodels) > 0) {
                echo "<div class='alert alerta alert-danger' role='alert'><strong>FAIL !</strong> This Name Alredy Exists!</div>";
            } else {
                mysqli_query($db_con, "INSERT INTO uploads(name,topic,file,author,user) values ('$name','$topic','$torrent_file','$author','$user')");
                move_uploaded_file($_FILES['torrent_file']['tmp_name'], "uploads/3dmodels/$torrent_file");
                echo "<div class='alert alerta alert-Success' role='alert'><strong>NICE !</strong> Uploaded Correctly!</div>";
            }
        } elseif ($topic == "Porn") {
            $check_PornAdult = mysqli_query($db_con, "SELECT * FROM uploads WHERE name = '$name'");
            if (mysqli_num_rows($check_PornAdult) > 0) {
                echo "<div class='alert alerta alert-danger' role='alert'><strong>FAIL !</strong> This Name Alredy Exists!</div>";
            } else {
                mysqli_query($db_con, "INSERT INTO uploads(name,topic,file,author,user) values ('$name','$topic','$torrent_file','$author','$user')");
                move_uploaded_file($_FILES['torrent_file']['tmp_name'], "uploads/Porn/$torrent_file");
                echo "<div class='alert alerta alert-Success' role='alert'><strong>NICE !</strong> Uploaded Correctly!</div>";
            }
        } elseif ($topic == "Pdf") {
            
            $check_pdf = mysqli_query($db_con, "SELECT * FROM uploads WHERE name = '$name'");
            if (mysqli_num_rows($check_pdf) > 0) {
                echo "<div class='alert alerta alert-danger' role='alert'><strong>FAIL !</strong> This Name Alredy Exists!</div>";
            } else {
                mysqli_query($db_con, "INSERT INTO uploads(name,topic,file,author,user) values ('$name','$topic','$torrent_file','$author','$user')");
                move_uploaded_file($_FILES['torrent_file']['tmp_name'], "uploads/pdf/$torrent_file");
                echo "<div class='alert alerta alert-Success' role='alert'><strong>NICE !</strong> Uploaded Correctly!</div>";
            }
        }
        
    } elseif ($ext_file != "torrent") {
        echo "<div class='alert alerta alert-danger' role='alert'><strong>FAIL !</strong> Incorrect File Extension!</div>";
    }
}
?>