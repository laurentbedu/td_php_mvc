<?php

class MainRepository{
    
    function __construct($table){
        $this->table = $table;
        $this->entity = ucfirst($this->table);
        $this->db = null;
    }

    private function connect(){
        if ($this->db === null) {
            //Connexion à la DB
            $host = "localhost";
            $port = "3306";
            $dbName = "tdphpmvc_db";
            $dsn = "mysql:host=$host;port=$port;dbname=$dbName";
            $user = "root";
            $pass = "";
            $db = null;
            try {
                $db = new PDO(
                    $dsn,
                    $user,
                    $pass,
                    array(
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
                    )
                );
            } catch (PDOException $e) {
                die("Erreur de connexion à la base de données : $e->getMessage()");
            }
            $this->db = $db;
        }
        return $this->db;
    }

    function getAll($where = "1"){
        $sql = "SELECT * FROM $this->table WHERE $where";
        $resp = $this->connect()->query($sql);
        return $resp->fetchAll(PDO::FETCH_CLASS, $this->entity);
    }

    function getOne($id){
        $sql = "SELECT * FROM $this->table WHERE id=$id";
        $resp = $this->connect()->query($sql);
        $rows = $resp->fetchAll(PDO::FETCH_CLASS, $this->entity);
        return count($rows) == 1 ? $rows[0] : null;
    }

}
