<?php
require_once "./app/models/categorias_modelo.php";
require_once "./app/view/categorias_vista.php";

class categoriasControlador
{
    private $vista;
    private $modelo;
    public function __construct($res)
    {
        $this->vista = new categoriasVista($res->usuario);
        $this->modelo = new categoriasModelo();
    }
    //muestra todas las categorias a traves de el modelo
    public function mostrarCategorias($form = false)
    {
        //obtener tareas db
        $categorias = $this->modelo->obtenerCategorias();
        //mostrar tareas en vista

        $this->vista->verCategorias($categorias, $form);
    }
    //muestra una categoria
    public function mostrarCategoria($id)
    {   //obtengo la descripcion de la categoria
        $cat = $this->modelo->obtenerCategoria($id);

        $descripcion = $cat->descripcion;
        //obtengo todas las pelis de la categoria
        $shows = $this->modelo->obtenerPeliculasPorCategoria($id);
        if ($shows) {
            $this->vista->verCategoria($shows, $descripcion);
        } else {
            $this->vista->mostrarError("La categoria no tiene peliculas");
        }
    }
    //agrega una categoria
    public function agregarCategoria()
    {
        //VALIDAR DATOS
        if (!empty($_POST['titulo'])) {
            $titulo = $_POST['titulo'];
            $descripcion = $_POST['descripcion'];
        } else {
            return $this->vista->mostrarError("ingresa los datos");
        }

        //INSERTO EN LA DB
        $id = $this->modelo->insertarCategoria($titulo, $descripcion);

        //si el id es 0 hubo un error y php toma el 0 como false por lo que
        //entra al else
        if ($id) {
            //redirigir al home
            header('Location: ' . BASE_URL);
        } else {
            return $this->vista->mostrarError("Error al insertar");
        }
    }
    //borra una categoria
    public function removerCategoria($id)
    {
        $eliminar = $this->modelo->obtenerCategoria($id);
        if ($eliminar) {
            $pelis = $this->modelo->obtenerPeliculasPorCategoria($id);
            if (!empty($pelis)) {
                $this->vista->confirmacionEliminacion($eliminar);
            } else {
                $this->modelo->eliminarCategoria($id);
                header('Location: ' . BASE_URL);
            }
        } else {
            $this->vista->mostrarError("No existe la categoria  $id");
        }

        exit();
    }
    //si la categoria tiene peliculas te pregunta si estas seguro de querer borrarla
    public function eliminarCategoriaDefinitivo($id)
    {
        $this->modelo->eliminarCategoria($id);
        header('Location: ' . BASE_URL);
    }

    public function editarCategoria($id)
    {
        $cat = $this->modelo->obtenerCategoria($id);

        if (!empty($cat)) {

            $this->vista->mostrarFormEditar($cat);
            if (!empty($_POST['nombre'])) {


                $nombre = $_POST['nombre'];
                $descripcion = $_POST['descripcion'];

                // actualiza la peli
                $editar = $this->modelo->actualizarCategoria($id, $nombre, $descripcion);

                if ($editar) {
                    //si editar es true se edito la pelicula
                    header('Location: ' . BASE_URL . 'categorias');
                    exit();
                } else {
                    //si no salta a este error
                    return $this->vista->mostrarError("Error al actualizar la película.");
                }
            }
        } else {
            $this->vista->mostrarError("Película no encontrada.");
        }
    }
}
