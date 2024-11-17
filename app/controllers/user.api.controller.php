<?php

    require_once 'app/models/user.model.php';
    require_once 'app/views/json.view.php';
    require_once './libs/jwt.php';

    class UserApiController {
        private $model;
        private $view;

        public function __construct() {
            $this->model = new UserModel();
            $this->view = new JSONView();
        }

        public function obtenerToken() {
            $auth_header = $_SERVER['HTTP_AUTHORIZATION'];
            $auth_header = explode(' ', $auth_header);
            if(count($auth_header) != 2) {
                return $this->view->response("Error en los datos ingresados", 400);
            }
            if($auth_header[0] != 'Basic') {
                return $this->view->response("Error en los datos ingresados", 400);
            }
            $user_pass = base64_decode($auth_header[1]);
            $user_pass = explode(':', $user_pass); 
            $usuario = $this->model->getUserByUsername($user_pass[0]);
            if($usuario == null || !password_verify($user_pass[1], $usuario->password)) {
                return $this->view->response("Error en los datos ingresados", 400);
            }
            $token = createJWT(array(
                'sub' => $usuario->ID_User,
                'nombre' => $usuario->username,
                'role' => 'admin',
                'iat' => time(),
                'exp' => time() + 600,
            ));
            return $this->view->response($token);
        }
    }