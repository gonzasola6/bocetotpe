<?php
    
    require_once 'libs/router.php';
    require_once 'config.php';
    require_once 'app/controllers/autor.api.controller.php';
    require_once 'app/controllers/user.api.controller.php';
    require_once 'app/middlewares/jwt.auth.middleware.php';

    
    $router = new Router();
    $router-> addMiddleware(new JWTAuthMiddleware());

    #                 endpoint              verbo       controller              metodo
    
    $router->addRoute('autores'      ,      'GET',      'AutorApiController',   'getAll');
    $router->addRoute('autores/:id'  ,      'GET',      'AutorApiController',   'get');
    $router->addRoute ('autores/:id',       'DELETE',   'AutorApiController',   'delete');
    $router->addRoute ('autores'    ,       'POST',     'AutorApiController',   'add');
    $router->addRoute ('autores/:id',       'PUT',      'AutorApiController',    'update');


    $router->addRoute('usuarios/token'    ,  'GET',     'UserApiController',     'obtenerToken'); 


    $router->route($_GET['resource'], $_SERVER['REQUEST_METHOD']);
