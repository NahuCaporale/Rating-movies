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

        require_once  "templates/peliculas.phtml";
        require_once  "templates/formPeliculas.phtml";

        require_once "templates/footer.phtml";
    }
    //muestra una peli enconcreto, pasamos categoria para mostrarla
    public function verPelicula($pelicula, $categoria)
    {
        require_once  "templates/header.phtml";
        require_once  "templates/pelicula.phtml"; // Pasa película y la categoria
        require_once "templates/footer.phtml";
    }
    //muestra el formulario para editar una peli
    public function mostrarFormularioEditar($pelicula, $categorias)
    {
        require_once  "templates/header.phtml";

        require_once  'templates/editarPelicula.phtml';
        require_once "templates/footer.phtml";
    }

    //manejo de errores
    public function mostrarError($error)
    {
        require_once  "templates/header.phtml";
        require_once  "templates/errores.phtml";
        require_once  "templates/footer.phtml";
    }
}
