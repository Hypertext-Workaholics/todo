<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Do List</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom Styles -->
    <style>
        body.dark-mode {
            background-color: #121212;
            color: #ffffff;
        }
        .dark-mode .card {
            background-color: #1e1e1e;
            color: #ffffff;
        }
        .dark-mode .list-group-item {
            background-color: #1e1e1e;
            color: #ffffff;
            border-color: #333;
        }
        .dark-mode .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .dark-mode .btn-success {
            background-color: #28a745;
        }
        .dark-mode .btn-danger {
            background-color: #dc3545;
        }
    </style>
</head>
<body>
    <div class="container py-5">
        <!-- Dark Mode Toggle -->
        <div class="d-flex justify-content-end mb-4">
            <button id="toggle-dark-mode" class="btn btn-outline-secondary">Toggle Dark Mode</button>
        </div>

        <h1 class="text-center mb-4">To-Do List</h1>
        
        <!-- Form to Add Tasks -->
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <form action="add_task.php" method="POST" class="d-flex">
                    <input type="text" name="task" class="form-control me-2" placeholder="Enter a new task" required>
                    <button type="submit" class="btn btn-primary">Add Task</button>
                </form>
            </div>
        </div>
        
        <!-- Display Tasks -->
        <div class="card shadow-sm">
            <div class="card-body">
                <h5 class="card-title">Your Tasks</h5>
                <ul class="list-group">
                    <?php
                    $result = $conn->query("SELECT * FROM tasks ORDER BY id DESC");
                    while ($row = $result->fetch_assoc()) {
                        echo '<li class="list-group-item d-flex justify-content-between align-items-center">
                            <span style="' . ($row['status'] ? 'text-decoration:line-through;' : '') . '">' . $row['task'] . '</span>
                            <div>
                                <a href="complete_task.php?id=' . $row['id'] . '" class="btn btn-sm btn-success me-2">Complete</a>
                                <a href="delete_task.php?id=' . $row['id'] . '" class="btn btn-sm btn-danger">Delete</a>
                            </div>
                        </li>';
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>

    <!-- JavaScript -->
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const isDarkMode = localStorage.getItem("dark-mode") === "true";
            if (isDarkMode) {
                document.body.classList.add("dark-mode");
            }

            const toggleButton = document.getElementById("toggle-dark-mode");
            toggleButton.addEventListener("click", () => {
                document.body.classList.toggle("dark-mode");
                const darkModeEnabled = document.body.classList.contains("dark-mode");
                localStorage.setItem("dark-mode", darkModeEnabled);
            });
        });
    </script>
</body>
</html>
