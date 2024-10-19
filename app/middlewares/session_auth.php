<?php
function sessionAuth($res) {
    session_start();
    // si hay session(existe el usuario) lee los datos de el usuario
    if (isset($_SESSION['ID_USER'])) {
        //guarda info en response
        $res->usuario = new stdClass();
        $res->usuario->id = $_SESSION['ID_USER'];
        $res->usuario->username = $_SESSION['USER_NAME'];
        return;
    }
}
?>