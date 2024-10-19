<?php
class Model
{
    protected $db;

    public function __construct()
    {
        $this->db = new PDO(
            "mysql:host=" . MYSQL_HOST .
                ";dbname=" . MYSQL_DB . ";charset=utf8",
            MYSQL_USER,
            MYSQL_PASS
        );
        $this->deploy();
    }

    public function deploy()
    {
        $query = $this->db->query('SHOW TABLES');
        $tables = $query->fetchAll();
        // Copiamos las tablas del archivo exportado de phpmyadmin.

        if (count($tables) == 0) {
            $sql = <<<END
    CREATE TABLE categories (
        id INT AUTO_INCREMENT PRIMARY KEY,
        nombre VARCHAR(255) NOT NULL,
        descripcion TEXT NOT NULL
    );

    CREATE TABLE shows (
        id INT AUTO_INCREMENT PRIMARY KEY,
        title VARCHAR(255) NOT NULL,
        release_date DATE NOT NULL,
        categorie_id INT,
        image_url VARCHAR(255) NOT NULL,
        FOREIGN KEY (categorie_id) REFERENCES categories(id)
    );

    CREATE TABLE usuario (
        id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(255) NOT NULL,
        password VARCHAR(255) NOT NULL
    );
END;

            $this->db->query($sql);
        }
    }
}
