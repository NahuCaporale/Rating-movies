<?php
class peliculaVista
{
    private $usuario = null;
    public function __construct($usuario)
    {
        $this->usuario = $usuario;
    }
    public function showPeliculas($peliculas, $categorias)
    {
        require_once "templates/header.phtml";

        require "templates/peliculas.phtml";
        require "templates/formPeliculas.phtml";

        require_once "templates/footer.phtml";
    }
    //muestra una peli enconcreto, pasamos categoria para mostrarla
    public function verPelicula($pelicula, $categoria)
    {
        require "templates/header.phtml";
        require "templates/pelicula.phtml"; // Pasa película y la categoria
        require_once "templates/footer.phtml";
    }
    //muestra el formulario para editar una peli
    public function mostrarFormularioEditar($pelicula, $categorias)
    {
        require "templates/header.phtml";

        require 'templates/editarPelicula.phtml';
        require_once "templates/footer.phtml";
    }

    //manejo de errores
    public function mostrarError($error)
    {
        require "templates/header.phtml";
        require "templates/errores.phtml";
        require "templates/footer.phtml";
    }
}
