<?php

class ToDoModel implements ToDoModelInterface {

    private  $dataFile = ROOT_PATH.'/app/models/data/data.json';


    public function createTask(string $name, string $user): bool {

        $tasks = $this->readTasksFromJson();
        $newId = count($tasks)+1;

        $newTask = [
            'id'=> $newId,
            'name' => $name,
            'status' => 'Pending',
            'startTime' => null,
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
                $task = array_merge($task, $newData); // actualitza els datos si no son iguals
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
        $encodedJson = json_encode($tasks);
        return file_put_contents($this->dataFile, $encodedJson,JSON_PRETTY_PRINT) !== false;
    }
}


?>