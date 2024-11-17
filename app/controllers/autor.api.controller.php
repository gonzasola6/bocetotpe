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
      

        $filterBy = null;
        $value = null;
        if (isset($req->query->filterBy) && isset($req->query->value)) {
            $filterBy = $req->query->filterBy;
            $value = $req->query->value;
        }
        if ($filterBy && !$this->model->columnExists($filterBy)) {
            return $this->view->response(
                "No es posible filtrar por '$filterBy', campo inexistente",
                400
            );
        }
        if ($value && !$this->model->columnValueExists($filterBy, $value)) {
            return $this->view->response(
                "No existen registros con el valor '$value' en el campo '$filterBy'",
                404);
        }

        $order = 'ASC'; //VALOR POR DEFECTO
        $orderBy = false;
        if(isset($req->query->orderBy)){
            $orderBy = $req->query->orderBy;}

        if (isset($req->query->order)){
        $order = strtoupper($req->query->order);} // Convertir a mayúsculas por consistencia

        $page = false;
        $limit = false;
        if (isset($req->query->page) && is_numeric($req->query->page) && isset($req->query->limit) && is_numeric($req->query->limit)) {
            $page = $req->query->page;
            $limit = $req->query->limit;
        }

        //obtengo los autores de la db
        $autores = $this->model->getAutores($filterBy, $value,$orderBy,$order, $page, $limit);

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

        //mando el autor a la vista
        return $this->view->response($autor);
    }

    public function delete($req, $res){
        $id= $req->params->id;

        $autor= $this->model->getAutor($id);

        if(!$autor){
            return $this->view->response("El autor con el id=$id no existe", 404);
        }
        $this->model->eraseAutor($id);
        $this->view->response("El autor con el id =$id se eliminó con éxito");

    }

    public function add($req,$res){

        if (!$res->user) {
            return $this->view->response("No autorizado", 401);
        }
        //valido los datos
        if(empty($req->body->nombre)){
            return $this->view->response('Faltan completar el nombre',400);
        }
        if(empty($req->body->pais)){
            return $this->view->response('Falta completar pais',400);
        }
        if(empty($req->body->cantAlbumes)){
            return $this->view->response('Faltan completar la cantidad de albumes',400);
        }
       
        //obtengo los datos del body del request
        $nombre= $req->body->nombre;
        $pais= $req->body->pais;
        $cantAlbumes= $req->body->cantAlbumes;
        
        //inserto los datos$
        $id= $this->model->insertAutor($nombre, $pais, $cantAlbumes);

        if(!$id){
            return $this->view->response ("Error al insertar autor", 500);
        }
            // buena práctica devuelvo el autor insertado
            $autor= $this->model->getAutor($id);

            return $this->view->response($autor,201);

    }

    public function update($req, $res){

        if (!$res->user) {
            return $this->view->response("No autorizado", 401);
        }

        $id= $req->params->id;//qué autor quiero actualizar

        $autor= $this->model->getAutor($id);

        if(!$autor){ //verifico que exista
            return $this->view->response("El autor con el id= $id no existe", 404);
        }

        if(empty($req->body->nombre)){
            return $this->view->response('Faltan completar el nombre',400);
        }
        if(empty($req->body->pais)){
            return $this->view->response('Falta completar pais',400);
        }
        if(empty($req->body->cantAlbumes)){
            return $this->view->response('Faltan completar la cantidad de albumes',400);
        }
       
        //obtengo los datos del body del request
        $nombre= $req->body->nombre;
        $pais= $req->body->pais;
        $cantAlbumes= $req->body->cantAlbumes;

        //modifico si pasa las validaciones

        $this->model->updateAutor ($id,$nombre, $pais, $cantAlbumes);

        //obtengo el autor modificada y la muestro
        $autor= $this->model->getAutor($id);
        $this->view->response ($autor, 200);

        

    }
}