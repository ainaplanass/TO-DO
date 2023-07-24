<?php


$routes = array(
    '/' => 'ToDoController#index',

	'/createTaskAction' => 'ToDoController@createTaskAction',

    '/showTask' => 'ToDoController@showTaskAction',

	'/showAllTask' => 'ToDoController@showAllTasksAction',

);
