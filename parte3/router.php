<?php
    
    require_once 'libs/router.php';
    require_once 'config.php';
    require_once 'app/controllers/album.api.controller.php';
    require_once 'app/controllers/autor.api.controller.php';


    $router = new Router();

    #                 endpoint        verbo     controller             metodo
    $router->addRoute('albumes'      , 'GET',    'AlbumApiController',   'getAll');
    $router->addRoute('albumes/:id'  , 'GET',    'AlbumApiController',   'get');
    $router->addRoute('autores'      , 'GET',    'AutorApiController',   'getAll');
    $router->addRoute('autores/:id'  , 'GET',    'AutorApiController',   'get');
    $router->addRoute ('albumes/:id', 'DELETE',  'AlbumApiController',   'delete');
    $router->addRoute ('albumes'    ,     'POST',    'AlbumApiController',   'add');
    $router->addRoute ('albumes/:id', 'PUT',    'AlbumApiController',    'update');


    $router->route($_GET['resource'], $_SERVER['REQUEST_METHOD']);
