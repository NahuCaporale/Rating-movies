<?php 
//verifica si hay usuario para hacer acciones
function verifyAuth($res) {
    if ($res->usuario) {
        return;
    }else{
        header(('Location: ' . BASE_URL . 'showLogin'));
        die();
    }}