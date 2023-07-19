<?php
// Define enum type for task status
enum statusTask 
{
    case Pending;
    case Ongoing;
    case Finished;
}

class Task {
    private static $id_counter = 1;
    private int $id;
    private string $name;
    private statusTask $status;
    private string $start_time;
    private string $end_time;
    private string $author;

    public function __construct(string $name, string $author) {
        $this->id = Task::$id_counter++;
        $this->name = $name;
        $this->status = statusTask::Pending;
        $this->start_time = date("Y-m-d H:i:s", time());
        $this->end_time = "";
        $this->author = $author;
    }
}
//funciones "helper"

// Helper function to read all tasks from JSON file
function readTasks_json(): array {

    $jsonFilePath = 'data/tasks.json';

    $jsonContent = file_get_contents($jsonFilePath);

    $tasksJson = json_decode($jsonContent, true);

    return $tasksJson;
}

function getAllTasks(): array {

    $tasksArray = readTasks_json();

    return $tasksArray;
}

?>