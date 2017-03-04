<?php

	//Starting the session
	session_start();

	//include the connection file
	include 'php/connection.php';

	//if the user want to delete a file
	if (isset($_GET['del'])) {
		
		//check if the file actually exists
		$id = $_GET['del'];

		//check the item status
		$check_item_to_delete = mysqli_query($db_con,"SELECT * FROM uploads WHERE id='$id'");

		if (mysqli_num_rows($check_item_to_delete)>0) {

				while ($row = $check_item_to_delete->fetch_assoc()) {
						
						$user_author = $row['user'];
						$active = $_SESSION['username'];

						if ($user_author == $active) {

							//Delete the file from the user's acoount
							mysqli_query($db_con,"DELETE  FROM uploads WHERE id = '$id'");

							//redirect to the user's profile page
							header("location: profile.php?user=$active");

						}else{

							//if the file id doesn't exist, redirect the user to the index page
							header("location:index.php");
						}
				}
		}

	}else{
		header("location:index.php");
	}
?>