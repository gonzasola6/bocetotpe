<?php
class JSONView{
    public function response($body, $status = 200){//renderiza nuestro recurso como json
        header("Content-Type: application/json"); //dice que le mandamos un json
        $statusText = $this->_requestStatus($status);
        header("HTTP/1.1 $status $statusText");
        echo json_encode($body);
    }

    private function _requestStatus($code){
        $status= array(
            200 => "OK",
            201 => "Created",
            204 => "No Content",
            400 => "Bad Request",
            404 => "Not Found",
            500 => "Internal Server Error"
        );
        if(!isset($status[$code])){
            $code = 500;
        }
        return $status[$code]; //si no existe code en status nos da 500 por default sino nos da el texto de code;
    }
}