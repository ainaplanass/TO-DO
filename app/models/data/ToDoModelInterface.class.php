<?php

interface ToDoModelInterface {
    public function createTask(string $name, string $user): bool;
    public function getAllTaks(): array;
    public function getSpecificTaks(int $id): ?array;
    public function updateTask(array $data, int $id): bool;
    public function deleteTask(int $id): bool;
}
?>