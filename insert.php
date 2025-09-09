<?php
	require "conn.php";

	if(isset($_POST['mytask'])) {
		$task = $_POST['mytask'];

		$insert = $conn->prepare('INSERT INTO tasks (name) VALUES (:name)');
		$insert->execute([':name'=>$task]);
        
		header("Location: index.php"); // redirect supaya tidak double insert saat refresh
        exit;
	}	
?>