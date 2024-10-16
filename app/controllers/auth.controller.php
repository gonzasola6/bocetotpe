<?php
require_once './app/models/user.model.php'; //modelo de usuario pq usamos la tabla usuarios
require_once './app/views/auth.view.php';

class AuthController  {
    private $model;
    private $view;

    public function __construct(){
        $this->model=new UserModel();
        $this->view=new AuthView();
    }

    public function showLogin(){
        //muestro el form de login
        return $this->view->showLogin();
    }

    public function login(){
        if (!isset($_POST['email']) || empty($_POST['email'])){
            return $this->view->showLogin("falta completar el email");
        }
        if (!isset($_POST['password']) || empty($_POST['password'])){
            return $this->view->showLogin("falta completar la contraseña");
        }
        $email = $_POST['email'];
        $password = $_POST['password'];

        //verificar que el usuario esta en la base de datos
        $userFromDB = $this->model->getUserByEmail($email);

        if ($userFromDB && password_verify($password, $userFromDB->password)) {
            //tiene que exisitr userfromdb porque sino el verify va a dar error
            // chequea la contraseña que nos dio el usuario coincide con el hash q tenemos
            session_start();
            $_SESSION['ID_USER'] = $userFromDB->ID_User;
            $_SESSION['EMAIL_USER'] = $userFromDB->email;
            $_SESSION['LAST_ACTIVITY'] = time();
            
            //redirijo al home
            header('Location: ' . BASE_URL);
        } else{
            return $this->view->showLogin('Credenciales incorrectas');
        }
    }

    public function logout(){
        session_start(); //va a buscar la cookie //INICIALICA EL MANEJO DE SESIONES, SE FIJA SI HAY COOKIES Y EL CHEQUEO DE COSAS
        session_destroy(); //borra la cookie q se busco
        header('Location: ' . BASE_URL);
    }
}