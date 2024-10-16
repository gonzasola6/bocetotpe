<?php

        function sessionAuthMiddleware($res){
            session_start(); //leer si hay una cookie, si no hay le da una vacia
            if (isset($_SESSION['ID_USER'])){ //se fija si esta seteado el usuario
                $res->user = new stdClass();
                $res->user->id = $_SESSION['ID_USER'];
                $res->user->email = $_SESSION['EMAIL_USER'];
                return;
            } else {
                header('Location: ' . BASE_URL . 'showLogin'); //si no esta seteado nos dirige al login
                die(); //para que no siga la ejecucion, termina la ejecucion completa del llamado
            }
        }
?>