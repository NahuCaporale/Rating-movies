<?php
require_once  "modelo.php";
class peliculaModelo extends Model
{


    public function __construct()
    {        //hacemos super() al constructor de modelo

        parent::__construct();
    }
    //obtiene todas las peliculas consultando la db
    function obtenerPeliculas()
    {
        $query = $this->db->prepare('SELECT * FROM shows');

        $query->execute();

        $peliculas = $query->fetchAll(PDO::FETCH_OBJ);
        return $peliculas;
    }
    //inserta una peli en la db
    function insertarPelicula($titulo, $categoria, $fecha, $imagen)
    {
        $query = $this->db->prepare('INSERT INTO  shows(title,categorie_id, release_date,image_url) values(?,?,?,?)');
        $query->execute([$titulo, $categoria, $fecha, $imagen]);
        //retorna el ultimo id insertado para validar si hubo un error
        return $this->db->lastInsertId();
    }
    //obitne una peli
    public function obtenerPelicula($id)
    {
        $query = $this->db->prepare('SELECT * FROM shows WHERE id = ? ');
        $query->execute([$id]);
        $pelicula = $query->fetch(PDO::FETCH_OBJ);
        return $pelicula;
    }
    //actualiza una peli
    public function actualizarPelicula($id, $titulo, $categoria_id, $fecha, $imagen)
    {
        $query = $this->db->prepare('UPDATE shows SET title = ?, categorie_id = ?, release_date = ?, image_url = ? WHERE id = ?');
        return $query->execute([$titulo, $categoria_id, $fecha, $imagen, $id]);
    }
    //elimina una peli
    public function removerPelicula($id)
    {
        $query = $this->db->prepare('DELETE FROM  shows WHERE  id = ? ');
        $query->execute([$id]);
    }
    private function _deploy()
    {
        $query = $this->db->query('SHOW TABLES');
        $tables = $query->fetchAll();
        if (count($tables) == 0) {
            $sql = <<<END

		END;
            $this->db->query($sql);
        }
    }
}
