<?php
    require "conn.php";

    // --- Ambil task yang mau diedit ---
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        $stmt = $conn->prepare("SELECT * FROM tasks WHERE id=:id");
        $stmt->execute([':id' => $id]);
        $task = $stmt->fetch(PDO::FETCH_OBJ);

        if (!$task) {
            header("Location: index.php");
            exit;
        }
    }

    // --- Update task ---
    if (isset($_POST['update'])) {
        $id   = $_POST['id'];
        $name = $_POST['mytask'];

        $update = $conn->prepare("UPDATE tasks SET name=:name WHERE id=:id");
        $update->execute([':name' => $name, ':id' => $id]);

        header("Location: index.php");
        exit;
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Task</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2 class="mb-4 text-center">✏️ Edit Task</h2>

        <form method="POST" action="edit.php" class="mb-3">
            <input type="hidden" name="id" value="<?php echo $task->id; ?>">
            <div class="form-group">
                <label for="taskName">Task Name</label>
                <input type="text" id="taskName" name="mytask" class="form-control" value="<?php echo htmlspecialchars($task->name); ?>" required>
            </div>
            <button type="submit" name="update" class="btn btn-success">Update</button>
            <a href="index.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</body>
</html>
