<?php

class Task {
    private string $id;
    private string $title;
    private string $description;
    private string $deadline;

    public function __construct(string $title, string $description, string $deadline) {
        $this->id = uniqid();
        $this->title = $title;
        $this->description = $description;
        $this->deadline = $deadline;
    }

    public function getId(): string {
        return $this->id;
    }

    public function getTitle(): string {
        return $this->title;
    }

    public function getDescription(): string {
        return $this->description;
    }

    public function getDeadline(): string {
        return $this->deadline;
    }

    public function getDeadlineStatus(): array {
        $today = new DateTime();
        $deadline = new DateTime($this->deadline);
        $interval = $today->diff($deadline);

        if ($deadline < $today) {
            return ['status' => 'The deadline has passed', 'color' => 'red'];
        } elseif ($interval->days <= 3) {
            return ['status' => 'The time is approaching', 'color' => 'orange'];
        } else {
            return ['status' => 'In progress', 'color' => 'green'];
        }
    }
}