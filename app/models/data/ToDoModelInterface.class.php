<?php

interface ToDoModelInterface {
    public function createTask(string $name, string $user): bool;
    public function getAllTasks(): array; // Corrected method name
    public function getSpecificTask(int $idTask): ?array; // Corrected method name
    public function updateTask(array $newData, int $idTask): bool;
    public function deleteTask(int $idTask): bool;
}

?>