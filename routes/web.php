<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/
$router->get(
    // La route en question
    '/task',
    [
        // Lecontroller@laméthode
        'uses' => 'TaskController@showAllTasks',
        // Le nom de la route pour le reverse routing
        'as'   => 'task-showAll'
    ]
);

// $router->get('task', 'TaskController@showAllTasks');


$router->get(
    // La route en question
    '/task/{id}',
    [
        // Lecontroller@laméthode
        'uses' => 'TaskController@showOneTask',
        // Le nom de la route pour le reverse routing
        'as'   => 'task-showOne'
    ]
);

// $router->get('task/{id}','TaskController@showOneTask');


$router->post(
    // La route en question
    '/task',
    [
        // 'middleware' => 'auth',
        // Lecontroller@laméthode
        'uses' => 'TaskController@createOneTask',
        // Le nom de la route pour le reverse routing
        'as'   => 'task-createOne'
    ]
);

// $router->post('task', 'TaskController@createOneTask');



$router->get(
    // La route en question
    '/category',
    [
        // Lecontroller@laméthode
        'uses' => 'CategoryController@showAllCategories',
        // Le nom de la route pour le reverse routing
        'as'   => 'category-showAll'
        ]
    );

// $router->get('category', 'CategoryController@showAllCategories');


$router->get(
    // La route en question
    '/category/{id}',
    [
        // Lecontroller@laméthode
        'uses' => 'CategoryController@showOneCategory',
        // Le nom de la route pour le reverse routing
        'as'   => 'category-showOne'
    ]
);

// $router->get('category/{id}', 'CategoryController@showOneCategory');

$router->post(
    '/register',
    [
        'uses' => 'AuthController@register',
        'as' => 'auth-register'
    ]
);
