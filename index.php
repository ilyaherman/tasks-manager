<?php

require_once 'Task.php';
require_once 'TaskRepository.php';
require_once 'FileTaskRepository.php';
require_once 'TaskService.php';

$repository = new FileTaskRepository();
$taskService = new TaskService($repository);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['create'])) {
    $taskService->createTask($_POST['title'], $_POST['description'], $_POST['deadline']);
}

$tasks = $taskService->getAllTasks();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Task Manager</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f4f7fa;
            color: #333;
        }

        h1 {
            text-align: center;
            color: #2c3e50;
            margin-bottom: 30px;
        }

        h2 {
            color: #34495e;
            border-bottom: 2px solid #ecf0f1;
            padding-bottom: 10px;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
            display: flex;
            gap: 10px;
        }

        input[type="text"],
        input[type="date"] {
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            flex: 1;
            font-size: 14px;
        }

        button[name="create"] {
            padding: 10px 20px;
            background-color: #3498db;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button[name="create"]:hover {
            background-color: #2980b9;
        }

        .task-list {
            list-style: none;
            padding: 0;
        }

        .task {
            background-color: #fff;
            padding: 15px;
            margin-bottom: 10px;
            border-radius: 6px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: transform 0.2s;
        }

        .task:hover {
            transform: translateY(-2px);
        }

        .task strong {
            color: #2c3e50;
        }

        .status {
            padding: 5px 10px;
            border-radius: 12px;
            color: white;
            font-size: 12px;
            font-weight: bold;
            text-transform: uppercase;
        }

        .green { background-color: #2ecc71; }
        .orange { background-color: #e67e22; }
        .red { background-color: #e74c3c; }

        @media (max-width: 600px) {
            form {
                flex-direction: column;
            }
            input[type="text"],
            input[type="date"] {
                margin-bottom: 10px;
                width: 100%;
            }
            .task {
                flex-direction: column;
                align-items: flex-start;
            }
        }
    </style>
</head>
<body>
    <h1>Task Manager</h1>

    <form method="post">
        <input type="text" name="title" placeholder="Title" required>
        <input type="text" name="description" placeholder="Description" required>
        <input type="date" name="deadline" required>
        <button type="submit" name="create">Add Task</button>
    </form>

    <h2>Tasks</h2>
    <ul class="task-list">
        <?php foreach ($tasks as $task): ?>
            <?php $status = $task->getDeadlineStatus(); ?>
            <li class="task">
                <div>
                    <strong><?php echo htmlspecialchars($task->getTitle()); ?></strong> 
                    - <?php echo htmlspecialchars($task->getDescription()); ?> 
                    (Deadline: <?php echo $task->getDeadline(); ?>)
                    <span class="status <?php echo $status['color']; ?>">
                        <?php echo $status['status']; ?>
                    </span>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>