<?php
	require "conn.php";

	if(isset($_GET['id'])) {
		$id = $_GET['id'];

		$delete = $conn->prepare("DELETE FROM tasks WHERE id=:id");
		$delete->execute([':id' => $id]);

		header("Location: index.php");
		exit;
	}
?>
