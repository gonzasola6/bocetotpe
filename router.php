<?php
require_once 'libs/response.php';
require_once 'app/middlewares/session.auth.middleware.php';
require_once 'app/controllers/album.controller.php';
require_once 'app/controllers/auth.controller.php';

// base_url para redirecciones y base tag
define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');

$res = new Response(); // lugar dodne guardar el usuario para no dejarlo suelto, empieza  a agrupar distintas cosas q necesitemos pasar por middlewares
//pasa por los middlewares y los middlewares lo modifican, asi cuando llega al controller, puede ver q datos puede usar

$action = 'listar'; //action por def
if (!empty($_GET['action'])){
    $action = $_GET['action'];
}


//tabña de ruteo

//listar -> AlbumController->showAlbum();
// parsea la accion para separar accion real de parametros
$params = explode('/', $action);

switch ($params[0]) {
    case 'listar':
        sessionAuthMiddleware($res); // lo pongo donde quiera tener una sesion iniciada
                                    // verifica q el usuario este logueado y sete $res->user o redirige al login
        $controller = new AlbumController($res);
        $controller->showAlbum();
        break;
    case 'agregar':
        sessionAuthMiddleware($res); 
        $controller = new AlbumController($res);
        $controller->addAlbum();
        break;
    case 'eliminar':
        sessionAuthMiddleware($res); 
        $controller = new AlbumController($res);
        $controller->deleteAlbum($params[1]);
        break;
    case 'showLogin':
        $controller = new AuthController();
        $controller->showLogin(); //muestra el form
        break;
    case 'login':
        $controller = new AuthController();
        $controller->login(); //chequea si lo q mandamos tiene sentido
        break;
    case 'logout':
        $controller = new AuthController();
        $controller->logout();
        break;
    default: 
        echo "404 Page Not Found";
        break;
}