<?php
	session_start();

	if (isset($_SESSION['id'])) {
		$username = $_SESSION['username'];
	}else{
		header("location:../index.php");
	}
	
?>
<html>
<head>
	<title>Pdf Files</title>
	<link rel="stylesheet" type="text/css" href="../bootstrap-3.3.6-dist/css/bootstrap.css">
	<style type="text/css">
	#menu{
  margin: 10px;
  position: absolute;
  margin-left: 150px;
}
#search_input_container{
	width: 500px;
	height: 50px;
	margin: auto;
}

#top{
	margin-left: 105px;
}
#topic:hover{
	text-decoration: none;
}
#files_container{
	width: 600px;
	margin: auto;
	height: 50px;
	background-color: white;
	border-radius: 3px;
	margin-top: 12px;
}

#title{
	padding: 15px;
	margin-left: 7px;
	margin-top: 7px;
	font-size: 15px;
}

a#title:hover{
	text-decoration: none;
}

a#title{
	color: #26596A;
	margin-top: -10px;
	position: absolute;
}

.white{
	color: #26596A;
	font-size: 20px;
}

#download_torrent{
	float: right;
	padding: 4px;
	margin-right: 15px;
}
p{
	padding: 3px;
	position: absolute;
}

#red{
	color: red;
}

#menu{
	margin: 10px;
	position: absolute;
	margin-left: 150px;
}


#home_header{width: 100%; background-color: #1e1f1f; height: 50px; font-size: 12px; }
#home_menu{width: 200px;position: absolute; margin-top: 15px; margin-left: 60%;}
#home_menu>ul>li{list-style: none; display: inline; padding: 2%;}
#home_menu>ul>li>a:hover{text-decoration: none;}
#home_search_person{width: 26%;  margin-top: .7%; position: absolute;  margin-left: 25%;}

#logo{
	position: absolute;
	margin-left: 10px;
	margin-top: 10px;
}
	</style>
</head>
<body> <!-- HEADER START -->
    <div id="home_header">
    	    	<a href="../home.php"><img id="logo" src="../img/logo.png"></a>

    <div id="home_search_person">
<form method="POST" action="../search.php">
<input type="text" class="form-control search_input input-sm" name="searched_input" placeholder="Search (Click Enter To Search)"></form></div>
    <div id="home_menu">
<ul>
<li><a href="../profile.php?user=<?php echo $username; ?>"> Profile</a></li>
<li><a href="../upload.php"> Upload</a></li>
<li><a href="../php/log_out.php"> Log Out</a></li></ul></div>

</div>
<!-- HEADER FINAL -->
	<br>
	<div id="top"><a id="topic"><h2>/Pdf Files/</h2></a></div>
<?php

include '../php/connection.php';

	$check_results = mysqli_query($db_con,"SELECT * FROM uploads WHERE topic = 'Pdf' order by 1 desc ");

		if (mysqli_num_rows($check_results)>0) {
			while ($row = $check_results->fetch_assoc()) {
					
				$user = $row['user'];
				$upload_name = $row['name'];
				$upload_topic = "pdf";
				$dir = "../uploads/";
				$upload_file = $row['file'];
				$author = $row['author'];

				echo "
	<div id='files_container'>
	<a href='../profile.php?user=$user'><p>$author ($user)</p></a><br>
	<p>$upload_name </p>
		<a id='download_torrent' href='$dir$upload_topic/$upload_file'><span class='glyphicon white glyphicon-cloud-download'></span></a>
	
	<br><hr>
</div>";
			}
		}else{
			echo "We can't Find Any Result";
		}
?>
</body>
</html>