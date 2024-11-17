<?php

class AutorModel{

    private $db;

    public function __construct(){
        $this->db = new PDO(
            "mysql:host=".MYSQL_HOST .
            ";dbname=".MYSQL_DB.";charset=utf8", 
            MYSQL_USER, MYSQL_PASS);
    }


     public function existeColumna($columna) {
        $query = $this->db->prepare("SHOW COLUMNS FROM autores LIKE :columna");
        $query->bindValue(':columna', $columna);
        $query->execute();
        return $query->rowCount() > 0;
    }
    public function existeValorEnColumna($columna, $valor) {
        $query = $this->db->prepare("SELECT COUNT(*) FROM autores WHERE $columna = :valor");
        $query->bindValue(':valor', $valor);
        $query->execute();
        return $query->fetchColumn() > 0;
    }
    
    public function getAutores($filtrarPor = null, $valor = null,$orderBy = false,$order = 'ASC'){
        $sql = 'SELECT * FROM autores';
        
        $params= [];
        if($filtrarPor) {
            $sql .= ' WHERE '; 
            switch($filtrarPor) {
                case 'nombre':
                    $sql .= 'nombre = :valor';
                    break;
                case 'pais':
                    $sql .= 'pais = :valor';
                    break;
                case 'cantAlbumes':
                    $sql .= 'cantAlbumes = :valor';
                    break;              
            }
        $params[':valor'] = $valor;
        
        }
        if($orderBy) {
            switch($orderBy) {
                case 'nombre':
                    $sql .= " ORDER BY nombre $order";
                    break;
                case 'pais':
                    $sql .= " ORDER BY pais $order";
                    break;
                case 'cantAlbumes':
                    $sql .= " ORDER BY cantAlbumes $order";
                    break;
            }
            
        }

        // ejecuto la consulta
        $query = $this->db->prepare($sql);
        $query = $this->db->prepare($sql);
        if(!empty($params)) {
            foreach($params as $param => $value) {
                $query->bindValue($param, $value);
            }
        }
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