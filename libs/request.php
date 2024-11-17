<?php
    class Request {
        public $body = null; # { nombre: 'Artaud', genero: 'Rock' }
        public $params = null; # /api/autores/:id
        public $query = null; # ?ordenBy=nombre

        public function __construct() {
            try {
                # file_get_contents('php://input') lee el body de la request
                $this->body = json_decode(file_get_contents('php://input'), false);
            }   # json decode parsea el json y lo devuelve en body
            catch (Exception $e) {
                $this->body = null;
            }
            $this->query = (object) $_GET;
        }
    }
