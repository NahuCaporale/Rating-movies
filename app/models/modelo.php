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
    //inserts
    INSERT INTO `categories` (`id`, `nombre`, `descripcion`) VALUES
    (27, 'Accion', 'Género cinematográfico donde prima la espectacularidad de las imágenes por medio de efectos especiales de estilo \"clásico\".'),
    (28, 'Drama', 'Género literario caracterizado por la representación de acciones y situaciones humanas conflictivas, que ha sido concebido para su escenificación, bien sea teatral, bien televisiva o cinematográfica. En este sentido, drama también puede hacer referencia a la obra dramática en sí'),
    (30, 'Suspense', 'El suspense o suspenso es la ansiedad, la inquietud, una combinación de emociones intensas que genera el desarrollo de una trama. Es la impaciencia, la tensión que se produce en el espectador por ver qué es lo que viene, por saber cómo se resolverá una situación o la trama misma de toda la obra cinematográfica, teatral, literaria.'),
    (31, 'Romance', '');

    INSERT INTO `shows` (`id`, `title`, `release_date`, `categorie_id`, `image_url`) VALUES
    (28, 'Paris,Texas', '1985-02-14', 28, 'https://i.pinimg.com/564x/df/48/3f/df483f17a6862d58b883e6bef3ea1d66.jpg'),
    (30, 'Laroy, Texas', '2024-04-17', 30, 'https://a.ltrbxd.com/resized/film-poster/9/0/2/4/7/1/902471-laroy-texas-0-2000-0-3000-crop.jpg?v=7e326b9e39'),
    (31, 'Nueve reinas', '2000-08-31', 30, 'https://i.pinimg.com/originals/5a/99/5b/5a995bc5485e8dd316f43b306f813509.jpg'),
    (32, 'Eyes Wide Shut', '1999-09-03', 30, 'https://i.pinimg.com/474x/c8/c0/f4/c8c0f4e54f655968da3f563a6a5c840b.jpg'),
    (33, 'Never look away', '2018-10-03', 31, 'https://m.media-amazon.com/images/M/MV5BNDQ0MTc0NjctZjA5Mi00MDMwLTkzZTUtYTc3YjFkZDdjMmI3XkEyXkFqcGc@._V1_.jpg');
END;

            $this->db->query($sql);
            $hashedPassword = password_hash('admin', PASSWORD_DEFAULT);
            $this->db->query("INSERT INTO usuario (username, password) VALUES ('webadmin', '$hashedPassword')");
        }
    }
}
