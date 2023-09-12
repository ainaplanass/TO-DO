<?php
class ToDoController extends Controller 
{
    public function indexAction(){
    }
    public function createTaskAction()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["name"]) && isset($_POST["user"])) {
            $name = $_POST['name'];
            $user = $_POST['user'];
    
            $todoModel = $this->setModel();
            $result = $todoModel->createTask($name, $user);
    
            if (is_string($result)) { // esot mira si la tarea se ha podid crear corretamente
                $errorMessage = "No se ha podido crear la tarea: " . $result;
                $this->view->render('createTask', ['errorMessage' => $errorMessage]);
            } else {
                header("Location: showAllTasks");
                exit;
            }
        } 
    }
    
    public function showTaskAction()
    {
        if (isset($_GET['id'])) {
            $taskId = $_GET['id'];
    
            $todoModel = new TodoModel(); 

            $task = $todoModel->getSpecificTask($taskId);
    
    
            if ($task === null) {
                throw new Exception("Tarea no encontrada.");
            }

            $this->view->task = $task;
  
        } else {

            throw new Exception("ID de tarea no proporcionado.");
        }
    }
    public function showAllTasksAction()
    {
        $todoModel = new TodoModel();
        $tasks = $todoModel->getAllTasks();

     
        $this->view->tasks = $tasks;
    }
   public function updateTaskAction()
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST["id"])) {
            $taskId = $_POST['id'];

            $newData['status'] = $_POST['status'];

            if ($newData['status'] === 'Terminada') {
                $newData['endTime'] = date('d-m-Y h:i');
            }
            else 
            {
                $newData['endTime'] = null;
            }
            $todo = $this->setModel();

            $result = $todo->updateTask($newData, $taskId);

            if (is_string($result)) {
                throw new Exception("UpdateTask: " . $result);
            }

            header("Location: showAllTasks");
            exit;
        } else {
            throw new Exception("Task ID, Name, and User fields are required.");
        }
    }
}

    public function deleteTaskAction()
    {
        if (isset($_GET['id'])) {
            $taskId = $_GET['id'];
    
            $todoModel = new TodoModel(); 

            $task = $todoModel->deleteTask($taskId);
    
            if ($task === null) {
                throw new Exception("Tarea no encontrada.");
            }
        } 
    }
    private function setModel(): ToDoModelInterface {

        return new TodoModel();
    }

}

?> 