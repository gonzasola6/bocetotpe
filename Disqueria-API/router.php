<?php
require_once 'libs/router.php';
require_once './app/controllers/album.controller.php';
$router = new Router();


//acá cargamos las rutas
                    //endpoint       verbo   controller               metodo
$router->addRoute('albums'     , 'GET',     'AlbumApiController',      'getAll');
$router->addRoute('albums/:id' , 'GET',     'AlbumApiController',      'get');
$router->addRoute ('albums/:id', 'DELETE',  'AlbumApiController',      'delete');
$router->addRoute ('albums',     'POST',    'AlbumApiController',      'add');
$router->addRoute ('albums/:id', 'PUT',    'AlbumApiController',      'update');

//acá lo llamamos. le pasamos el recurso o la ruta
$router->route($_GET['resource'], $SERVER['REQUEST_METHOD']); //busca la que matchea y llama al controlador