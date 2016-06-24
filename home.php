<?php
	session_start();

	if (isset($_SESSION['id'])) {
		
		$id = $_SESSION['id'];
		$name = $_SESSION['name'];
		$surname = $_SESSION['surname'];
		$username = $_SESSION['username'];
		$email = $_SESSION['email'];
		$password = $_SESSION['password'];
		$complete_name = $name." ".$surname;
	}else{
		header("location:index.php");
	}
?>

<html>
<head>
	<title>Get Torrent </title>
	<link rel="stylesheet" type="text/css" href="css/home_css.css">
	<script src="js/jquery.js"></script>
    <link rel="stylesheet" type="text/css" href="bootstrap-3.3.6-dist/css/bootstrap.css">
</head>
<body>
<div id="body1">

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
<div class='alert alerta alert-Success' role='alert'><strong> WELCOME !</strong> This Website Allows You To Publish And Download Torrent Files!!</div>
<div id="show_menu_icon"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAkElEQVRIS+2VMQoCMRBF/4f0HmHHE+hRbTZeK95g9wbRFNsEZlEELYQU4RdCUk/+m5/PTAjxoVgfeoDN5QLiJHKSeIyPDPCgAfiddt0MqKYBhEWfgabzj+pw0HxhWiyJ0MyBO5IWANxGyO2QmxWdBfoMXsvO69TZ6O/rDKt0Xbt75vvDOUscPAdNIvwl+v+AHZLrJURKrO0DAAAAAElFTkSuQmCC"/></div>
<div id="hide_menu_icon"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAA+klEQVRIS62WwRGCMBBF/3K2iJRACZZgCd69WAIleME6KMESLMESnIEzcYITJsZsdgPhlMmQ95bA/kCmHweAutfl8ETFy/RTC9iO3IAwDxbNqZYkZJIruqYkZi2CWpJUoatgr4TbhR/BVklui/8EpRLp/SUFWokEdxxWIEk0cFHASbRwlSCWfBfpGzO7RWFy+KrdXEnXlwjORPMNFu/qAtNPC9za5gig9WNNdolPEMI9MDXHBbH0ma6Vx9VqJblGY+FBQIr3cFEhLtRKUmGnhmskcVwXwyVJeOBshuck/sjcDeck7tCvBk9JyNzHByxdNV1Z8lfjCgds+wGq0UFqRqjg5gAAAABJRU5ErkJggg=="/></div>
<br>
<br>
<br>
<div id="categories_container">
	<a href="cat/movies.php" target="_blank"><ul><li><span class="fa-heart"></span> Movies</li></ul></a>
	<a href="cat/music.php" target="_blank"><ul><li> Music</li></ul></a>
	<a href="cat/videogames.php" target="_blank"><ul><li> Videogames</li></ul></a>
	<a href="cat/software.php" target="_blank"><ul><li> Software</li></ul></a>
	<a href="cat/3dmodels.php" target="_blank"><ul><li> 3d Models</li></ul></a>
	<a href="cat/pdf.php" target="_blank"><ul><li> Pdf Files</li></ul></a>
	<a href="cat/books.php" target="_blank"><ul><li> Books</li></ul></a>
	<a href="cat/other.php" target="_blank"><ul><li> Others..</li></ul></a>
	<a href="cat/porn.php" target="_blank"><ul><li> Porn (Adult Content)</li></ul></a>
</div>
</div>
   <script type="text/javascript">
   	$(document).ready(function(){
   		$('#show_menu_icon').click(function(){
   			$('#categories_container').fadeIn();
   			$('#show_menu_icon').hide();
   			$('#hide_menu_icon').fadeIn();
   		});

   		$('#hide_menu_icon').click(function(){
   			$('#show_menu_icon').fadeIn();
   			$('#hide_menu_icon').hide();
   			$('#categories_container').fadeOut();
   		})
   	})
   </script>                                                                   
</body>
</html>

