<?php
require_once 'app/models/autor.model.php';
require_once 'app/views/json.view.php';

class AutorApiController{
    private $model;
    private $view;
    
    public function __construct(){
        $this->model = new AutorModel();
        $this->view = new JSONView();
    }

    // /api/autores
    public function getAll($req, $res){
        //obtengo los autores de la db
        $autores = $this->model->getAutores();

        //mando los autores a la vista
        $this->view->response($autores);

    }

    // /api/autores/:id
    public function get($req, $res){
        //obtengo el id
        $id = $req->params->id;

        //obtengo de la db
        $autor = $this->model->getAutor($id);

        if (!$autor){
            return $this->view->response("El autor con el id : $id no existe",404);
        }

        //mando el album a la vista
        return $this->view->response($autor);
    }

}