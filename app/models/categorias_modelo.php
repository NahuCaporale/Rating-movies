<?php
require_once 'config.php';
require_once "modelo.php";
class categoriasModelo extends Model

{
    public function __construct()
    {        //hacemos super() al constructor de modelo

        parent::__construct();
    }
    //obtiene todas las categorias
    public function obtenerCategorias()
    {
        $query = $this->db->prepare('SELECT * FROM categories');
        $query->execute();
        $categorias = $query->fetchAll(PDO::FETCH_OBJ);
        return $categorias;
    }
    //obtiene todas las peliculas de una categoria
    public function obtenerPeliculasPorCategoria($id)
    {
        $query = $this->db->prepare('SELECT * FROM shows WHERE categorie_id = ? ');
        $query->execute([$id]);
        $categoria = $query->fetchAll(PDO::FETCH_OBJ);
        return $categoria;
    }
    //obtiene la categoria
    public function obtenerCategoria($id)
    {
        $query = $this->db->prepare('SELECT * FROM categories WHERE id = ? ');
        $query->execute([$id]);
        $categoria = $query->fetch(PDO::FETCH_OBJ);
        return $categoria;
    }
    //inserta cat en la db
    public function insertarCategoria($titulo, $descripcion,)
    {
        $query = $this->db->prepare('INSERT INTO  categories(nombre,descripcion) values(?,?)');
        $query->execute([$titulo, $descripcion]);
        //retorna el ultimo id insertado para validar si hubo un error
        return $this->db->lastInsertId();
    }
    //eliminar cat en la db
    public function eliminarCategoria($id)
    {
        $query = $this->db->prepare('DELETE FROM  categories WHERE  id = ?');
        $query->execute([$id]);
    }
    public function actualizarCategoria($id, $nombre, $descripcion)
    {
        $query = $this->db->prepare('UPDATE  categories SET nombre = ?,  descripcion= ? WHERE id = ?');
        return $query->execute([$nombre, $descripcion,$id]);
    }
}
