<?php
include_once "app/models/pelicula_modelo.php";
include_once "app/view/pelicula_vista.php";
include_once "app/models/categorias_modelo.php";
class peliculaControlador
{
    private $modelo;
    private $vista;
    private $modeloCategorias;

    function __construct($res)
    {

        $this->vista = new peliculaVista($res->usuario);
        $this->modelo = new peliculaModelo();
        $this->modeloCategorias = new categoriasModelo();
    }


    function mostrarPeliculas()
    { //Muestra todas las pelis

        $peliculas = $this->modelo->obtenerPeliculas();
        $categorias = $this->modeloCategorias->obtenerCategorias();
        $this->vista->showPeliculas($peliculas, $categorias);
    }

    function agregarPelicula()
    { //agrega una peli
        if (!empty($_POST['titulo']) && !empty($_POST['categoria_id'])) {
            $titulo = $_POST['titulo'];
            $categoria = $_POST['categoria_id']; // Este debe coincidir con el nombre del campo en el formulario
            $fecha = $_POST['fecha'];
            $imagen = $_POST['imagen'];


            // INSERTO EN LA DB
            $id = $this->modelo->insertarPelicula($titulo, $categoria, $fecha, $imagen);
            //si devuelve id se agrego sino salta al else
            if ($id) {
                header('Location: ' . BASE_URL . 'verPeliculas');
            } else {
                return $this->vista->mostrarError("Error al insertar");
            }
        } else {
            return $this->vista->mostrarError("Ingresa todos los datos");
        }
    }

    //obtiene la peli de el modelo y su respectiva categoria  y las muestra
    public function obtenerPelicula($id)
    {
        //obtener pelicula db
        $pelicula = $this->modelo->obtenerPelicula($id);
        $categoria = $this->modeloCategorias->obtenerCategoria($pelicula->categorie_id);
        if ($pelicula) {
            $this->vista->verPelicula($pelicula, $categoria);
        } else {
            $this->vista->mostrarError("No existe la pelicula" + $pelicula->title);
        }
    }

    //borra una peli
    public function removerPelicula($id)
    {
        $eliminar = $this->modelo->removerPelicula($id);
        header('Location: ' . BASE_URL . 'verPeliculas');
        if (!$eliminar) {
            return $this->vista->mostrarError("No existe la pelicula  $id");
        }
        exit();
    }
    //edita la peli, a veces muestra un error pero se actualiza igual 
    public function editarPelicula($id)
    {
        $peli = $this->modelo->obtenerPelicula($id);

        if (!empty($peli)) {
            //tuvimos que incluir esta linea de codigo, porque el footer se enviaba antes de hacer el redirect y 
            //nos causaba un error en pantalla aunque se actualizaba correctamente la pelicula
            ob_start();

            $categorias = $this->modeloCategorias->obtenerCategorias(); // Obtener categorías para el formulario

            $this->vista->mostrarFormularioEditar($peli, $categorias);
            if (!empty($_POST['titulo']) && !empty($_POST['categoria_id']) && !empty($_POST['imagen'])) {


                $titulo = $_POST['titulo'];
                $categoria_id = $_POST['categoria_id'];
                $fecha = $_POST['fecha'];
                $imagen = $_POST['imagen'];

                // actualiza la peli
                $editar = $this->modelo->actualizarPelicula($id, $titulo, $categoria_id, $fecha, $imagen);

                if ($editar) {
                    //si editar es true se edito la pelicula
                    header('Location: ' . BASE_URL . 'verPeliculas');
                } else {
                    //si no salta a este error
                    return $this->vista->mostrarError("Error al actualizar la película.");
                }
                ob_end_flush();
            }
        } else {
            $this->vista->mostrarError("Película no encontrada.");
        }
    }
}
