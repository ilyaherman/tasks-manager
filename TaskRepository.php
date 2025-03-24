<?php

interface TaskRepository {
    public function save(Task $task): void;
    public function findAll(): array;
    public function findById(string $id): ?Task;
}