<?php

class AlbumModel{

    private $db;

    public function __construct(){
        $this->db = new PDO('mysql:host=localhost;dbname=disqueria;charset=utf8', 'root', '');
    }


    public function getAlbums(){
        

        //2 ejecuto la consulta
        $query = $this->db->prepare('SELECT * FROM albumes');
        $query->execute();

        //3 obtengo los datos en un arreglo de objetos
        $albums = $query->fetchAll(PDO::FETCH_OBJ); 

        return $albums;
    }

    public function insertAlbum($name,$launchDate,$nSongs,$genre,$ID_Autor){
        

        $query = $this->db->prepare('INSERT INTO albumes(nombre, lanzamiento, cantCanciones, genero, ID_Autor) VALUES (?, ?, ?, ?, ?)');
        $query->execute([$name,$launchDate,$nSongs,$genre,$ID_Autor]);

        $id = $this->db->lastInsertId();

        return $id;
    }

    public function getAlbum($id){
      

        $query = $this->db->prepare('SELECT * FROM albumes where ID_Album = ?');
        $query-> execute([$id]);

        $album = $query->fetch(PDO::FETCH_OBJ);

        return $album;
    }

    public function eraseAlbum($id){


        $query = $this->db->prepare('DELETE FROM albumes WHERE ID_Album = ?');
        $query->execute([$id]);
    }

    // function modifyAlbum($id){
    //     $db = getConnection();

    //     UPDATE `albumes` SET `lanzamiento` = '1973-03-02' WHERE `albumes`.`ID_Album` = 17;
    //     $query = $db->prepare(' UPDATE albumes WHERE ID_Album = ?');

    // }

    }