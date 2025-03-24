<?php

function saveTaskToFile(string $filePath, array $taskData): void {
    $line = implode('|', [
        $taskData['id'],
        $taskData['title'],
        $taskData['description'],
        $taskData['deadline']
    ]) . PHP_EOL;

    // Добавляем задачу в конец файла
    file_put_contents($filePath, $line, FILE_APPEND);
}

function getTasksFromFile(string $filePath): array {
    if (!file_exists($filePath)) {
        return [];
    }

    $lines = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    $tasks = [];

    foreach ($lines as $line) {
        $parts = explode('|', $line);
        if (count($parts) === 4) {
            $tasks[$parts[0]] = [
                'id' => $parts[0],
                'title' => $parts[1],
                'description' => $parts[2],
                'deadline' => $parts[3]
            ];
        }
    }

    return $tasks;
}