<?php
require_once 'app/models/album.model.php';
require_once 'app/views/album.view.php';

class AlbumController{
    private $model;
    private $view;

    public function __construct($res){
        $this->model = new AlbumModel();
        $this->view = new AlbumView($res->user);
    }

    public function showAlbum(){
        //obtengo los albumes de la db
        $albums = $this->model->getAlbums();

        //mando las tareas a la vista
        $this->view->showAlbums($albums);

}
    public function addAlbum(){
         if (!isset($_POST['name']) || empty($_POST['name'])) {
            return $this->view->showError("Falta completar el nombre");
        
        }

        if (!isset($_POST['launchDate']) || empty($_POST['launchDate'])) {
            return $this->view->showError("falta completar la fecha lanzamiento");
        }
        if (!isset($_POST['nSongs']) || empty($_POST['nSongs'])) {
            return $this->view->showError("falta completar la cantidad de canciones");
        }

        if (!isset($_POST['genre']) || empty($_POST['genre'])) {
            return $this->view->showError("falta completar el genero");
        }

        if (!isset($_POST['ID_Autor']) || empty($_POST['ID_Autor'])) {
            return $this->view->showError("falta completar el id del autor");
        }
       
        
        $name = $_POST['name'];
        $launchDate = $_POST['launchDate'];
        $nSongs = $_POST['nSongs'];
        $genre = $_POST['genre'];
        $ID_Autor = $_POST['ID_Autor'];

        $id = $this->model->insertAlbum($name,$launchDate,$nSongs,$genre,$ID_Autor);

        // redirijo al home
        header('Location: ' . BASE_URL);

    }

    public function deleteAlbum($id){
    //obtener el album por id
    $album = $this->model->getAlbum($id); 

    if (!$album) {
        return $this->view->showError("No existe el album con el id=$id");
    }

    //borro el album y redirijo
    $this->model->eraseAlbum($id);

    header('Location: ' . BASE_URL);
}
}