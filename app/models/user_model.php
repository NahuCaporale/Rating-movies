<?php  
require_once   "modelo.php";

class userModel extends Model{
    public function __construct()
    {
        //hacemos super() al constructor de modelo
        parent::__construct();

    }
    //consulta la db para ver si existe el usuario
    public function getUserByUsername($user){
        $query = $this->db->prepare('SELECT * FROM usuario WHERE username = ?');
        $query->execute([$user]);
        $usuario = $query->fetch(PDO::FETCH_OBJ);
        return $usuario;   
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