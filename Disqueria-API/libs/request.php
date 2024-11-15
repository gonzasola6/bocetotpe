<?php
class Request{
    public $body = null;
    public $params = null;
    public $query = null;

    public function __construct(){
        try{
            $this->body = json_decode(file_get_contents(`php://input`), true);
            // file_get_contents función para leer el body en php, el json decode parsea el json y lo devuelve en body
        }
        catch (Exception $e){
            $this->body = null;
        }
        $this->query = (object) $_GET;
    }
}