<?php


interface IDb {
    public function select($query);
    public function insert($query);
    public function update($query);
    public function delete($query);
}



class DbMySQL implements IDb {
    public $mysqli;

    public function __construct($name) {
        $this->mysqli = new mysqli("localhost", "root", "root", $name);
        if($this->mysqli->connect_errno) {
            die("Erreur lors de la connexion : " . $this->mysqli->connect_errno);
        }
    }


    public function select($query) {
        return $this->mysqli->query($query);
    }
    public function insert($values) {
        $date = date("d m Y H:i:s");
        $query = "INSERT INTO tpfinal_user (NOM, PRENOM, PSEUDO, MDP, LAST_MAJ) VALUES ('".$values["nom"]."', '".$values["prenom"]."', '".$values["pseudo"]."', '".md5($values["mdp"])."', STR_TO_DATE('".$date."', '%d %m %Y %T'))";
        echo $query."<br/>";
        $res = $this->mysqli->query($query);
        var_dump($this->mysqli->error);
    }
    public function update($query) {
        $res = $this->mysqli->query($query);
    }
    public function delete($query) {
        $res = $this->mysqli->query($query);
    }


    public function __destruct() {
        $this->mysqli->close();
    }
}



class DbSqlite implements IDb {
    public $handle;
    
    public function __construct($name) {
        $this->handle = new SQLite3($name.'.sqlite');
    }

    public function select($query) {
        return $this->handle->query($query);
    }
    public function insert($values) {
        $date = date("d m Y H:i:s");
        $query = "INSERT INTO tpfinal_user (NOM, PRENOM, PSEUDO, MDP, LAST_MAJ) VALUES ('".$values["nom"]."', '".$values["prenom"]."', '".$values["pseudo"]."', '".md5($values["mdp"])."', STR_TO_DATE('".$date."', '%d %m %Y %T'))";
        echo $query."<br/>";
        $res = $this->handle->exec($query);
    }
    public function update($query) {
        $res = $this->handle->exec($query);
    }
    public function delete($query) {
        $res = $this->handle->exec($query);
    }
    public function __destruct() {
        $this->handle->close();
    }
}




class DbFactory {
    public static function create($type, $name) {
        switch($type) {
            case "mysql" :
                return new DbMySQL($name);
            case "sqlite" :
                return new DbSqlite($name);
        }
    }
}





// $msql = DbFactory::create("mysql", "mysql");
// $msql->insert("INSERT INTO UTILISATEUR (NOM, PRENOM) VALUES ('azzaz', 'azzaza')");

// $sqlite = DbFactory::create("sqlite", "CESI");
// $sqlite->insert("INSERT INTO UTILISATEUR (NOM, PRENOM) VALUES ('azzaz', 'azzaza')");
?>