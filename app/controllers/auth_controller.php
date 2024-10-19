<?php
require "./app/models/user_model.php";
require "./app/view/auth_vista.php";

class UserController
{
    private $model;
    private $view;
    public function __construct()
    {
        $this->model = new userModel();
        $this->view = new authView();
    }
    public function showlogin()
    {
        $this->view->showLogin();
    }

    public function login()
    {
        if (!isset($_POST['usuario']) || empty($_POST['usuario'])) {
            return $this->view->showLogin('Completar usuario');
        }
        if (!isset($_POST['password']) || empty($_POST['password'])) {
            return $this->view->showLogin('Completar contraseña');
        }
        $user = $_POST['usuario'];
        $userpassword = $_POST['password'];

        $userFromDB = $this->model->getUserByUsername($user);

        if ($userFromDB && password_verify($userpassword, $userFromDB->password)) {
            session_start();
            $_SESSION['ID_USER'] = $userFromDB->id;
            $_SESSION['USER_NAME'] = $userFromDB->username;
            $_SESSION['LAST_ACTIVITY'] = time();
            header('Location: ' . BASE_URL);
        } else {
            return $this->view->showLogin('Credenciales incorrectos');
        }
    }
    public function logout()
    {
        session_start();
        session_destroy();
        header('Location: ' . BASE_URL);
    }
}
