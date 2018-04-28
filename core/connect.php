<?php

	$conn = mysqli_connect("localhost", "root", "", "gudi");

	if (mysqli_connect_errno()) {

		echo "Error on connection with the database ". mysqli_connect_errno();
	
	}
	

   session_start();
?>