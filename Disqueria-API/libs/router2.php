<?php
//esto hace lo mismo que el switch de la 2 entrega pero lo construye dinamicamente.

require_once '../libs/request.php';
require_once '../libs/response.php';

class Route{
    private $url;
    private $verb;
    private $controller;
    private $method;
    private $params;

    public function __construct($url, $verb, $controller, $method){
        $this->url = $url;
        $this->verb = $verb;
        $this->controller = $controller;
        $this->method = $method;
        $this->params = [];
    }

    public function match ($url, $verb){ //se fija si coincide el verbo, si no coincide no matchea
        if($this->verb != $verb){
            return false;
        }                        //trim elimina las barras de más
        $partsURL = explode("/", trim($url,'/'));//separa las partes de la ruta
        $partsRoute = explode("/", trim($this->url,'/'));
        if(count($partsRoute) != count($partsURL)){ //se fija parte por parte, primero si la cantidad de partes es la misma
            return false;
        }//si coincide el verbo y la cantidad de partes, se empieza fijar si cada parte coincide
        foreach($partsRoute as $key => $part){
            if($part[0] != ":"){//si empieza con : asume que es una variable
                if($part[0] != $partsURL[$key]){//si no es una variable se fija que sea exactamente igual
                return false;
            }
            else// si es una variable ya directamente lo guarda como parametro
            $this->params[''.substr($part,1)] = $partsURL[$key];
        }
        return true;
    }
    }

    //despues ese parametro lo mete en este objeto request para poder accederlo
    public function run ($request, $response){
        $controller = $this->controller;
        $method = $this->method;
        $request->params = (object) $this->params;

        (new $controller())->$method($request,$response);
    }

}

class Router{
    private $routerTable = [];
    private $middlewares = [];
    private $defaultRoute;
    private $request;
    private $response;

    public function __construct(){
        $this->defaultRoute = null;
        $this->request = new Request();
        $this->response = new Response();
    }

    public function route ($url, $verb){
        foreach($this->middlewares as $middleware) {
            $middleware->run($this->request, $this->response);
        }
        foreach($this->routeTable as $route){
            if($route->match($url,$verb)){
                $route->run($this->request, $this->response);
                return;
            }
        }
        if($this->defaultRoute != null)
        $this->defaultRoute->run($this->request, $this->response);
    }

    public function adMiddleware($middleware){
        $this->routeTable[] = $middleware;
    }

    public function addRoute ($url, $verb, $controller, $method){
        $this-> routeTable[] = new Route ($url, $verb, $controller, $method);
    }

    public function setDefaultRoute ($controller, $method){
        $this-> defaultRoute[] = new Route ("", "", $controller, $method);
    }

}
