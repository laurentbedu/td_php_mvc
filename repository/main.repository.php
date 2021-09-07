<?php

class MainRepository{
    
    function __construct($table){
        $this->table = $table;
        $this->entity = ucfirst($this->table);
        $this->db = null;

        $this->relations = [];
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
        $rows = $resp->fetchAll(PDO::FETCH_CLASS, $this->entity);
        if(count($rows) == 0){
            return $rows;
        }
        foreach($this->relations as $relation){
            if($relation['type'] == 'hasMany'){
                $repo = new MainRepository($relation['table']);
                $results = $repo->getAll();
                foreach($rows as $row){
                    $currentResults = array_filter($results, function($item) use ($row, $relation){
                        return $item->{$relation['foreignKey']} == $row->id;
                    });
                    $row->{$relation['attribute']} = $currentResults;
                } 
            }
            if($relation['type'] == 'hasOne'){
                $repo = new MainRepository($relation['table']);
                $results = $repo->getAll();
                foreach($rows as $row){
                    $currentResults = array_filter($results, function($item) use ($row, $relation){
                        return $item->id == $row->{$relation['foreignKey']};
                    });
                    $row->{$relation['attribute']} = count($currentResults) == 1 ? $currentResults[0] : null;
                }
            }
        }
        return $rows;
    }

    function getOne($id){
        $sql = "SELECT * FROM $this->table WHERE id=$id";
        $resp = $this->connect()->query($sql);
        $rows = $resp->fetchAll(PDO::FETCH_CLASS, $this->entity);
        $row = count($rows) == 1 ? $rows[0] : null;
        if($row == null){
            return null;
        }

        foreach($this->relations as $relation){
            if($relation['type'] == 'hasMany'){
                $repo = new MainRepository($relation['table']);
                $results = $repo->getAll($relation['foreignKey']." = $row->id");
                $row->{$relation['attribute']} = $results;
            }
            if($relation['type'] == 'hasOne'){
                $repo = new MainRepository($relation['table']);
                $results = $repo->getAll("id = ".$row->{$relation['foreignKey']});
                $row->{$relation['attribute']} = count($results) == 1 ? $results[0] : null;
            }
        }

        return $row;
    }

    function with($name){
        $relationToAdd = $this->entity::$relations[$name];
        array_push($this->relations, $relationToAdd);
        return $this;
    }

    // function with($relations = []){
    //     $this->relations = $relations;
    //     //['type'=>'hasMany', 'table'=>'product', 'attribute'=>'products', 'foreignKey'='category_id']
    //     //['type'=>'hasOne', 'table'=>'categroy', 'attribute'=>'category', 'foreignKey'='category_id']
    //     return $this;
    // }

}
