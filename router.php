<?php
    
    require_once 'libs/router.php';
    require_once 'config.php';
    require_once 'app/controllers/autor.api.controller.php';


    $router = new Router();

    #                 endpoint        verbo     controller             metodo
    
    $router->addRoute('autores'      , 'GET',    'AutorApiController',   'getAll');
    $router->addRoute('autores/:id'  , 'GET',    'AutorApiController',   'get');
    $router->addRoute ('autores/:id', 'DELETE',  'AutorApiController',   'delete');
    $router->addRoute ('autores'    ,  'POST', 'AutorApiController',   'add');
    $router->addRoute ('autores/:id', 'PUT',    'AutorApiController',    'update');


    $router->route($_GET['resource'], $_SERVER['REQUEST_METHOD']);
