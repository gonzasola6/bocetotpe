<?php
// la vista es auth pq es para mostrar las cosas de autenticacion

class AuthView {
    private $user = null; //nunca va a haber un usuario aca, entocnes null


    public function showLogin($error = ''){
        require 'templates/form_login.phtml';
    }
}