<?php
require_once 'app/models/album.model.php';
require_once 'app/views/json.view.php';

class AlbumApiController{
    private $model;
    private $view;
    
    public function __construct(){
        $this->model = new AlbumModel();
        $this->view = new JSONView();
    }

    // /api/albumes
    public function getAll($req, $res){
        //obtengo los albumes de la db
        $albums = $this->model->getAlbums();

        //mando los albumes a la vista
        $this->view->response($albums);

    }

    // /api/albumes/:id
    public function get($req, $res){
        //obtengo el id
        $id = $req->params->id;

        //obtengo de la db
        $album = $this->model->getAlbum($id);

        if (!$album){
            return $this->view->response("El album con el id : $id no existe",404);
        }

        //mando el album a la vista
        return $this->view->response($album);
    }

    public function delete($req, $res){
        $id= $req->params->id;

        $albums= $this->model->getAlbum($id);

        if(!$albums){
            return $this->view->response("El album con el id=$id no existe", 404);
        }
        $this->model->eraseAlbum($id);
        $this->view->response("El album con el id =$id se eliminó con éxito");

    }

    public function add($req,$res){
        //valido los datos
        if(empty($req->body->nombre)){
            return $this->view->response('Faltan completar el nombre',400);
        }
        if(empty($req->body->lanzamiento)){
            return $this->view->response('Faltan completar los lanzamientos',400);
        }
        if(empty($req->body->cantCanciones)){
            return $this->view->response('Faltan completar la cantidad de canciones',400);
        }
        if(empty($req->body->genero)){
            return $this->view->response('Faltan completar el género',400);
        }
        if(empty($req->body->ID_Autor)){
            return $this->view->response('Faltan completar autor',400);
        }
        //obtengo los datos del body del request
        $nombre= $req->body->nombre;
        $lanzamiento= $req->body->lanzamiento;
        $cantCanciones= $req->body->cantCanciones;
        $genero= $req->body->genero;
        $ID_Autor= $req->body->ID_Autor;
        
        //inserto los datos$
        $id= $this->model->insertAlbum($nombre, $lanzamiento, $cantCanciones, $genero, $ID_Autor);

        if(!$id){
            return $this->view->response ("Error al insertar album", 500);
        }
            // buena práctica devuelvo la tarea insertada
            $album= $this->model->getAlbum($id);

            return $this->view->response($album,201);

    }

    public function update($req, $res){
        $id= $req->params->id;//qué tarea quiero actualizar

        $album= $this->model->getAlbum($id);

        if(!$album){ //verifico que exista
            return $this->view->response("La tarea con el id= $id no existe", 404);
        }

        if(empty($req->body->nombre)){
            return $this->view->response('Faltan completar el nombre',400);
        }
        if(empty($req->body->lanzamiento)){
            return $this->view->response('Faltan completar los lanzamientos',400);
        }
        if(empty($req->body->cantCanciones)){
            return $this->view->response('Faltan completar la cantidad de canciones',400);
        }
        if(empty($req->body->genero)){
            return $this->view->response('Faltan completar el género',400);
        }
        if(empty($req->body->ID_Autor)){
            return $this->view->response('Faltan completar autor',400);
        }

        $nombre= $req->body->nombre;
        $lanzamiento= $req->body->lanzamiento;
        $cantCanciones= $req->body->cantCanciones;
        $genero= $req->body->genero;
        $ID_Autor= $req->body->ID_Autor;

        //modifico si pasa las validaciones

        $this->model->updateAlbum ($id,$nombre, $lanzamiento, $cantCanciones, $genero, $ID_Autor);

        //obtengo la tarea modificada y la muestro
        $album= $this->model->getAlbum($id);
        $this->view->response ($album, 200);

        

    }


}