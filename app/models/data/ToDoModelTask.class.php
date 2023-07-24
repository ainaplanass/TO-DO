<?php
/*enum statusTask 
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
    private string $startTime;
    private string $endTime;
    private string $user;

    public function __construct(string $name, string $user) {
        $this->id = Task::$id_counter++;
        $this->name = $name;
        $this->status = statusTask::Pending;
        $this->startTime = date("Y-m-d H:i:s", time());
        $this->endTime = "";
        $this->user = $user;
    }
}


function getTasks_json(): array { //esta funcion devuelve la infoo de data.json convertida en array

    $jsonFilePath = 'data/tasks.json';

    $jsonContent = file_get_contents($jsonFilePath);

    $tasksJson = json_decode($jsonContent, true);

    return $tasksJson;
}
*/
?>
