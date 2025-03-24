<?php

require_once 'legacy_task_manager.php';

class FileTaskRepository implements TaskRepository {
    private string $filePath = 'tasks.txt';

    public function save(Task $task): void {
        $data = [
            'id' => $task->getId(),
            'title' => $task->getTitle(),
            'description' => $task->getDescription(),
            'deadline' => $task->getDeadline()
        ];
        saveTaskToFile($this->filePath, $data);
    }

    public function findAll(): array {
        $rawTasks = getTasksFromFile($this->filePath);
        $tasks = [];

        foreach ($rawTasks as $rawTask) {
            $task = new Task($rawTask['title'], $rawTask['description'], $rawTask['deadline']);
            $tasks[$rawTask['id']] = $task;
        }

        return $tasks;
    }

    public function findById(string $id): ?Task {
        $tasks = $this->findAll();
        return $tasks[$id] ?? null;
    }
}