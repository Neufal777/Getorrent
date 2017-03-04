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
	$searched = mysqli_real_escape_string($db_con, $_POST['searched_input']);
	$search_query = mysqli_query($db_con,"SELECT * FROM uploads WHERE name LIKE '%{$searched}%' or author LIKE  '%{$searched}%' order by 1 desc");

	$count = mysqli_num_rows($search_query);
?>
<html>
<head>
	<title>( <?php echo $_POST['searched_input']; ?> ) Searching...</title>
	<link rel="stylesheet" type="text/css" href="css/search_css.css">
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
<li><a href="profile.php?user=<?php echo $username; ?>"> Profile</a></li>
<li><a href="upload.php"> Upload</a></li>
<li><a href="php/log_out.php"> Log Out</a></li></ul></div>
</div>
<!-- HEADER FINAL -->
<?php
	if (mysqli_num_rows($search_query)>0) 
		echo "<h4 id='results_count'>We Found $count Results</h4>";
?>
<br>
</body>
</html>
<?php
	if (isset($_POST['searched_input'])) {
			
	if (mysqli_num_rows($search_query)>0) {
			
		while ($row = $search_query->fetch_assoc()) {
				
				$author = $row['author'];
				$upload_name = $row['name'];
				$upload_topic = $row['topic'];
				$upload_file = $row['file'];
				$user = $row['user'];
				$dir = "uploads/";
				$dir2 = "cat/";
				echo "
<div id='files_container'>
	<a href='profile.php?user=$user'><p>$author ($user)</p></a><br>
	<p>$upload_name <a id='red'>($upload_topic)</a></p>
		<a target='_blank' id='download_torrent' href='$dir$upload_topic/$upload_file'>Download <span class='glyphicon white glyphicon-cloud-download'></span></a>
	
	<br><hr>
</div>";

		}

	}else{
		echo "<div class='alert alerta alert-danger' role='alert'><strong>Fail !</strong> We Found 0 Results!</div>";
	}


	}else{
		header("location:index.php");
	}
?>


