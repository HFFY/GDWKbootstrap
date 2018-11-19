<?php
class User implements \Serializable{

    // database connection and table name
    private $conn;
    private $table_name = "Usuarios";

    // object properties
    public $id;
    public $username;
    public $password;
    public $created;

    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
    // signup user
    public function serialize()
    {
        return serialize([
            $this->id,
            $this->username,
            $this->password,
        ]);
    }

    public function unserialize($data)
    {
      echo "hola";
        list(
            $this->id,
            $this->username,
            $this->password
        ) = unserialize($data);
    }
    function signup(){

        if($this->isAlreadyExist()){
            return false;
        }
        // query to insert record
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    username=:username, password=:password, created=:created";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->username=htmlspecialchars(strip_tags($this->username));
        $this->password=htmlspecialchars(strip_tags($this->password));
        $this->created=htmlspecialchars(strip_tags($this->created));

        // bind values
        $stmt->bindParam(":username", $this->username);
        $stmt->bindParam(":password", $this->password);
        $stmt->bindParam(":created", $this->created);

        // execute query
        if($stmt->execute()){
            $this->id = $this->conn->lastInsertId();
            return true;
        }

        return false;

    }
    // login user
    function login(){
        // select all query
        $query = "SELECT
                    `Nombres`, `Apellidos`,`ID_usuarios`, `Contraseña`, `Usuario`
                FROM
                    " . $this->table_name . "
                WHERE
                    Usuario='".$this->username."' AND Contraseña='".$this->password."'";

        // prepare query statement
        $stmt = $this->conn->prepare($query);
        // execute query
        $stmt->execute();

        echo $this->username;
        echo "<br>";


        return $stmt;
    }
    function isAlreadyExist(){
        $query = "SELECT *
            FROM
                " . $this->table_name . "
            WHERE
                username='".$this->username."'";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        // execute query
        $stmt->execute();
        if($stmt->rowCount() > 0){
            return true;
        }
        else{
            return false;
        }
    }
}
