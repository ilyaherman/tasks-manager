<?php

class TaskService {
    private TaskRepository $repository;

    public function __construct(TaskRepository $repository) {
        $this->repository = $repository;
    }

    public function createTask(string $title, string $description, string $deadline): Task {
        $task = new Task($title, $description, $deadline);
        $this->repository->save($task);
        return $task;
    }

    public function getAllTasks(): array {
        return $this->repository->findAll();
    }
}