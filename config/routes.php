<?php


$routes = array(
    '/' => 'ToDoController#index',

	'/createTask' => 'ToDo@createTask',

    '/showTask' => 'ToDo@showTask',

	'/showAllTask' => 'ToDo@showAllTasks',

);
