<?php
class categoriasVista{
    private  $usuario = null;
    public function __construct($usuario){
        $this->usuario = $usuario;
    }
    public function verCategorias($categorias,$form)
    {   //obtener categorias
        require_once "templates/header.phtml";
        require "templates/categorias.phtml";
        if ($form == true) {
            
            require_once "./templates/formCategorias.phtml";
            require_once "templates/footer.phtml";
        }
        require_once "templates/footer.phtml";

    }
    //Pregunta si de verdad queremos eliminar una categoria con peliculas dentro(Como usamos cascade on delete tuvimos que hacer esta confirmacion)
    public function confirmacionEliminacion($categoria){
        require "templates/header.phtml";
        require "templates/eliminar.phtml";
        require_once "templates/footer.phtml";

    }
    //Mostrar la categoria y su descripcion con las peliculas
    public function verCategoria($shows,$desc){
        require "templates/header.phtml" ;

        require "templates/categoria.phtml";
        require "templates/footer.phtml";

    }
    //manejo de errores
    public function mostrarError($error)
    {
        require "templates/header.phtml";
        require "templates/errores.phtml";
        require "templates/footer.phtml";
    }
}
