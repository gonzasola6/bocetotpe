<?php

class AutorModel{

    private $db;

    public function __construct(){
        $this->db = new PDO(
            "mysql:host=".MYSQL_HOST .
            ";dbname=".MYSQL_DB.";charset=utf8", 
            MYSQL_USER, MYSQL_PASS);
    }


    public function getAutores(){
        

        // ejecuto la consulta
        $query = $this->db->prepare('SELECT * FROM autores');
        $query->execute();

        // obtengo los datos en un arreglo de objetos
        $autores = $query->fetchAll(PDO::FETCH_OBJ); 

        return $autores;
    }

    

    public function getAutor($id){
      

        $query = $this->db->prepare('SELECT * FROM autores where ID_Autor = ?');
        $query-> execute([$id]);

        $autor = $query->fetch(PDO::FETCH_OBJ);

        return $autor;
    }

     public function insertAutor($name,$pais,$nAlbums){
        $query = $this->db->prepare('INSERT INTO autores(nombre, pais, cantAlbumes) VALUES (?, ?, ?)');
        $query->execute([$name,$pais,$nAlbums]);

        $id = $this->db->lastInsertId();

        return $id;
    }

    public function eraseAutor($id){

        try {
        $query = $this->db->prepare('DELETE FROM autores WHERE ID_Autor = ?');
        $query->execute([$id]);
    } catch (PDOException $e) {
        throw new Exception("No se puede borrar el autor porque tiene álbumes disponibles a la venta.");
    }

        
    }

    public function updateAutor($id, $name, $pais, $nAlbums) {
    $query = $this->db->prepare('UPDATE autores SET nombre = ?, pais = ?, cantAlbumes = ? WHERE ID_Autor = ?');
    $query->execute([$name, $pais, $nAlbums, $id]);
}


}