<?php

class ToDoModel implements ToDoModelInterface {

    private  $dataFile = ROOT_PATH.'/app/models/data/data.json';


    public function createTask(string $name, string $user): bool {

        $tasks = $this->readTasksFromJson();
        $maxId = 0;
        foreach ($tasks as $task) {
            $maxId = max($maxId, $task['id']);
        }
    
        $newId = $maxId + 1;
        $newTask = [
            'id'=> $newId,
            'name' => $name,
            'status' => 'Pendiente',
            'startTime' => date('d-m-Y h:i'),
            'endTime' => null,
            'user' => $user
        ];
        $tasks[] = $newTask;
    
        return $this->saveTasksToJson($tasks);
    }
    

    public function getAllTasks(): array {
        return $this->readTasksFromJson();
    }

    public function getSpecificTask(int $idTask): ?array {

        $tasks = $this->readTasksFromJson();
        foreach ($tasks as $tak) {
            if ($tak['id'] == $idTask) {
                return $tak;
            }
        }
        return null;
    }
    public function updateTask(array $newData, int $idTask): bool {
        $tasks = $this->readTasksFromJson();
    
        foreach ($tasks as &$task) {
            if ($task['id'] == $idTask) {
                foreach ($newData as $index => $value) {
                    $task[$index] = $value;
                }
                return $this->saveTasksToJson($tasks);
            }
        }
        return false;
    }
    
    public function deleteTask(int $idTask): bool {
        $tasks = $this->readTasksFromJson();
    
        foreach ($tasks as $index => $task) {

            if ($task['id'] == $idTask) {
                unset($tasks[$index]); 
                return $this->saveTasksToJson($tasks);
            }
        }
        return false; 
    }
    
    private function readTasksFromJson(): array {
        $jsonFile = file_get_contents($this->dataFile);
        $takss = json_decode($jsonFile, true); //torna el data json en arrays
    
        if (empty($takss)) { //si no hi ha torna que no hi iha res ne
            return[];
        }
    
        return $takss;
    }
    private function saveTasksToJson(array $tasks): bool {
        $encodedJson = json_encode($tasks,JSON_PRETTY_PRINT);
        return file_put_contents($this->dataFile, $encodedJson) !== false;
    }
}


?>