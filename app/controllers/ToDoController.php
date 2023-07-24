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
    
            if (is_string($result)) {
                $errorMessage = "No se ha podido crear la tarea: " . $result;
                $this->view->render('createTask', ['errorMessage' => $errorMessage]);
            } else {
                // Redireccionar al índice o a la página que muestre todas las tareas
                header("Location: /");
                exit;
            }
        } else {
            $this->view->render('createTask');
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
            $this->view->render('showTask');
        } else {

            throw new Exception("ID de tarea no proporcionado.");
        }
    }
    public function showAllTasksAction()
    {
        $todoModel = new TodoModel();
        $tasks = $todoModel->getAllTasks();

        if (empty($tasks)) {
        throw new Exception("No hay tareas disponibles.");
        }

        $this->view->tasks = $tasks;
        $this->view->render('showAllTasks');
    }

    private function setModel(): ToDoModelInterface {

        return new TodoModel();

    }
    

}

?> 