<?php
    require "conn.php";

    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        // Ambil status saat ini
        $stmt = $conn->prepare("SELECT is_done FROM tasks WHERE id=:id");
        $stmt->execute([':id' => $id]);
        $task = $stmt->fetch(PDO::FETCH_OBJ);

        if ($task) {
            $newStatus = $task->is_done ? 0 : 1;
            $update = $conn->prepare("UPDATE tasks SET is_done=:is_done WHERE id=:id");
            $update->execute([':is_done' => $newStatus, ':id' => $id]);
        }
    }
    header("Location: index.php");
    exit;
?>
