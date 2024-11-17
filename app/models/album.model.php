<?php

class AlbumModel{

    private $db;

    public function __construct(){
        $this->db = new PDO(
            "mysql:host=".MYSQL_HOST .
            ";dbname=".MYSQL_DB.";charset=utf8", 
            MYSQL_USER, MYSQL_PASS);
            
    }


    public function getAlbums($orderBy = false,$order = 'ASC'){
        $sql ='
        SELECT albumes.*, autores.nombre AS autor_nombre 
        FROM albumes 
        JOIN autores ON albumes.ID_Autor = autores.ID_Autor
        ';

        if($orderBy) {
            switch($orderBy) {
                case 'nombre':
                    $sql .= " ORDER BY nombre $order";
                    break;
                case 'lanzamiento':
                    $sql .= " ORDER BY lanzamiento $order";
                    break;
                case 'cantCanciones':
                    $sql .= " ORDER BY cantCanciones $order";
                    break;
                case 'genero':
                    $sql .= " ORDER BY genero $order";
                    break;
                case 'autor_nombre':
                    $sql .= " ORDER BY autor_nombre $order";
                    break; 
            }
        }

        // ejecuto la consulta
        $query = $this->db->prepare($sql);
        $query->execute();

        // obtengo los datos en un arreglo de objetos
        $albums = $query->fetchAll(PDO::FETCH_OBJ); 

        return $albums;
    }

    public function getAlbumsByAutor($ID_Autor){
        

        // ejecuto la consulta
        $query = $this->db->prepare('
        SELECT albumes.*, autores.nombre AS autor_nombre 
        FROM albumes 
        JOIN autores ON albumes.ID_Autor = autores.ID_Autor
        WHERE albumes.ID_Autor = ?
    ');
        $query->execute([$ID_Autor]);

        // obtengo los datos en un arreglo de objetos
        $albums = $query->fetchAll(PDO::FETCH_OBJ); 

        return $albums;
    }

   

    public function getAlbum($id){
      

        $query = $this->db->prepare('
        SELECT albumes.*, autores.nombre AS autor_nombre 
        FROM albumes 
        JOIN autores ON albumes.ID_Autor = autores.ID_Autor
        WHERE albumes.ID_Album = ?
        ');
        $query-> execute([$id]);

        $album = $query->fetch(PDO::FETCH_OBJ);

        return $album;
    }

     public function insertAlbum($name,$launchDate,$nSongs,$genre,$ID_Autor){
        

        $query = $this->db->prepare('INSERT INTO albumes(nombre, lanzamiento, cantCanciones, genero, ID_Autor) VALUES (?, ?, ?, ?, ?)');
        $query->execute([$name,$launchDate,$nSongs,$genre,$ID_Autor]);

        $id = $this->db->lastInsertId();

        return $id;
    }
    
    public function eraseAlbum($id){


        $query = $this->db->prepare('DELETE FROM albumes WHERE ID_Album = ?');
        $query->execute([$id]);
    }


    public function updateAlbum($id, $name, $launchDate, $nSongs, $genre, $ID_Autor) {
    $query = $this->db->prepare('
        UPDATE albumes 
        SET nombre = ?, lanzamiento = ?, cantCanciones = ?, genero = ?, ID_Autor = ? 
        WHERE ID_Album = ?
    ');
    $query->execute([$name, $launchDate, $nSongs, $genre, $ID_Autor, $id]);
}
}