<?php
require_once "app/controllers/categorias_controlador.php";
require_once "app/controllers/auth_controller.php";
require_once "app/libs/response.php";
require_once "app/middlewares/session_auth.php";
require_once "app/middlewares/verify_auth.php";
require_once "app/controllers/pelicula_controlador.php";


define('BASE_URL', '//' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']) . '/');

if (!empty($_GET['action'])) {
    $action = $_GET['action'];
} else {
    $action = 'home';
}

$res = new Response();

//home > mostrarCategorias
//agregar > agregarCategoria
//eliminar[id] > removerCategoria
//categorias > verCategorias
//categoria >
$params = explode('/', $action);

switch ($params[0]) {
    case 'showLogin':
        $controlador = new  UserController();
        $controlador->showlogin();
        break;
    case 'login':
        $controlador = new  UserController();
        $controlador->login();
        break;
    case 'home':
        sessionAuth($res);
        $controlador = new categoriasControlador($res);
        $controlador->mostrarCategorias();
        break;

    case 'categorias':
        sessionAuth($res);
        $controlador = new categoriasControlador($res);
        $controlador->mostrarCategorias(true);
        break;
    case 'categoria':
        sessionAuth($res);
        $controlador = new categoriasControlador($res);
        $controlador->mostrarCategoria($params[1]);
        break;
    case 'agregarCategoria':
        sessionAuth($res);
        verifyAuth($res);
        $controlador = new categoriasControlador($res);
        $controlador->agregarCategoria();
        break;
    case 'eliminarCategoria':
        sessionAuth($res);
        verifyAuth($res);
        $controlador = new categoriasControlador($res);
        $controlador->removerCategoria($params[1]);
        break;
    case 'eliminarCategoriaDefinitivo':
        sessionAuth($res);
        verifyAuth($res);
        $controlador = new categoriasControlador($res);
        $controlador->eliminarCategoriaDefinitivo($params[1]);
        break;
    case 'verPeliculas':
        sessionAuth($res);
        $controlador = new peliculaControlador($res);
        $controlador->mostrarPeliculas();
        break;
    case 'agregarPelicula':
        sessionAuth($res);
        verifyAuth($res);
        $controlador = new peliculaControlador($res);
        $controlador->agregarPelicula();
        break;
    case 'editarPelicula':
        sessionAuth($res);
        verifyAuth($res);
        $controller = new peliculaControlador($res);
        $controller->editarPelicula($params[1]);
        break;

    case 'eliminarPelicula':
        sessionAuth($res);
        verifyAuth($res);
        $controlador = new peliculaControlador($res);
        $controlador->removerPelicula($params[1]);
        break;
    case 'pelicula':
        sessionAuth($res);
        $controlador = new peliculaControlador($res);
        $controlador->obtenerPelicula($params[1]);
        break;
    case 'logout':
        $controlador = new  UserController();
        $controlador->logout();
        break;
    default:
        echo "404";
        break;
}
