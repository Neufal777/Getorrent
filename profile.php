<?php
	session_start();

	if (isset($_SESSION['id'])) {
		$username = $_SESSION['username'];
	}else{
		header("location: index.php");
	}
?>
<?php

include 'php/connection.php';
if (isset($_GET['user'])) {
	
	$user = $_GET['user'];

	$validate_user = mysqli_query($db_con,"SELECT * FROM users WHERE username = '$user'");


	if (mysqli_num_rows($validate_user)>0) {
		
		while ($row3 = $validate_user->fetch_assoc()) {
						
						$profile_name = $row3['name'];
						$profile_surname = $row3['surname'];
						$profile_username = $row3['username'];
						$complete_name = $profile_name." ".$profile_surname;
				}	
			
	}else{
		header("location:index.php");
	}

}

?>

<html>
<head>
	<title><?php echo $user; ?></title>
	<link rel="stylesheet" type="text/css" href="css/profile_css.css">
	<link rel="stylesheet" type="text/css" href="js/jquery.css">
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
<li><a href="home.php"> Home</a></li>
<li><a href="upload.php"> Upload</a></li>
<li><a href="php/log_out.php"> Log Out</a></li></ul></div>

</div>
<!-- HEADER FINAL -->
	<br>
	<div id="profile_container">
		<h3 id="name"><?php echo $complete_name; ?> (<?php echo $profile_username; ?>)</h3>
		<br>
		<?php

		$check_uploads = mysqli_query($db_con,"SELECT * FROM uploads WHERE user ='$user' order by 1 desc ");

		if (mysqli_num_rows($check_uploads)>0) {
				
				while ($info = $check_uploads->fetch_assoc()) {
					
					$upload_name = $info['name'];
					$upload_user = $info['user'];
					$upload_topic = $info['topic'];
					$upload_file = $info['file'];
					$upload_id = $info['id'];
					$dir = "uploads/";

					$active_user = $_SESSION['username'];
								
						if ($active_user == $upload_user) {
							echo "
<div id='files_container'>
	<p>__ // $upload_name <a id='red'>($upload_topic)</a></p>
		<a id='download_torrent' href='$dir$upload_topic/$upload_file'><span class='glyphicon white glyphicon-cloud-download'></span></a><a href='delete.php?del=$upload_id'><span id='delete_post' class='glyphicon glyphicon-trash'></span></a>
	
	<br><hr>
</div>";
						}elseif ($active_user != $upload_user) {
							echo "
<div id='files_container'>
	<p>$upload_name <a id='red'>($upload_topic)</a></p>
		<a id='download_torrent' href='$dir$upload_topic/$upload_file'><span class='glyphicon white glyphicon-cloud-download'></span></a>
	
	<br><hr>
</div>";
						}

				}
		}else{
			echo "This User has no torrents yet";
		}

		?>
	</div>
</body>
</html>


