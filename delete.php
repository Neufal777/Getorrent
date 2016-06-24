<?php
	session_start();
	include 'php/connection.php';
	if (isset($_GET['del'])) {
	
		$id = $_GET['del'];
		$check_item_to_delete = mysqli_query($db_con,"SELECT * FROM uploads WHERE id='$id'");

		if (mysqli_num_rows($check_item_to_delete)>0) {
				while ($row = $check_item_to_delete->fetch_assoc()) {
						
						$user_author = $row['user'];
						$active = $_SESSION['username'];
						if ($user_author == $active) {

							mysqli_query($db_con,"DELETE  FROM uploads WHERE id = '$id'");
							header("location: profile.php?user=$active");

						}else{
							header("location:index.php");
						}
				}
		}

	}else{
		header("location:index.php");
	}
?>