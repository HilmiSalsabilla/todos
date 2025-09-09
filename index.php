<?php
	require "conn.php";

	$data = $conn->query("SELECT * FROM tasks");
?>

<!DOCTYPE html>
<html>
	<head>
		<title>todos</title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="" crossorigin="">
		<link rel="stylesheet" href="style.css">
	</head>

	<body>
		<div class="container">
			<h2 class="mb-4 text-center">📋 My Todo List</h2>

			<!-- Form Tambah Task -->
			<form method="POST" action="insert.php" class="mb-3 d-flex">
				<input name="mytask" type="text" class="form-control mr-2" placeholder="Input a new task" required>
				<button type="submit" class="btn btn-primary">Add</button>
			</form>

			<!-- Tabel Task -->
			<table class="table table-bordered">
				<thead>
					<tr>
						<th style="width: 50px;">#</th>
						<th style="width: 40px;">Done</th>
						<th>Task Name</th>
						<th style="width: 180px;">Created At</th>
						<th style="width: 160px;">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php while($rows = $data->fetch(PDO::FETCH_OBJ)): ?>   
						<tr>
							<td><?php echo $rows->id; ?></td>
							<td>
								<input type="checkbox" 
									onclick="window.location='toggle.php?id=<?php echo $rows->id; ?>'" 
									<?php echo $rows->is_done ? 'checked' : ''; ?>>
							</td>
							<td class="text-left <?php echo $rows->is_done ? 'text-muted' : ''; ?>">
								<?php echo htmlspecialchars($rows->name); ?>
							</td>
							<td>
								<?php echo $rows->created_at ? date('l, d M Y H:i', strtotime($rows->created_at)) : '—'; ?>
							</td>
							<td>
								<a href="edit.php?id=<?php echo $rows->id; ?>" class="btn btn-sm btn-warning">Edit</a>
								<a href="delete.php?id=<?php echo $rows->id; ?>" class="btn btn-sm btn-danger">Delete</a>
							</td>
						</tr>
					<?php endwhile; ?>
				</tbody>
			</table>
		</div>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</body>