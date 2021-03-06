<?php
include_once 'database.php';
class User implements \Serializable
{

    // database connection and table name

    private $conn;
    private $database;
    private $table_name = "Usuarios";

    // object properties
    public $id;
    public $username;
    public $password;
    public $names;
    public $lastname;
    public $rol;
    public $date;


    // constructor with $db as database connection
    public function __construct($db)
    {
        $this->conn = $db;
        $this->database= new Database();
        $this->date=date('Y-m-d H:i:s');
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
        list(
            $this->id,
            $this->username,
            $this->password
        ) = unserialize($data);
    }
    public function signup()
    {
        if ($this->isAlreadyExist()) {
            return false;
        }

        // Check connection
        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }




        // Perform queries
        if (!is_null($this->username)) {
            $sql= "INSERT INTO $this->table_name VALUES ('$this->names', null, '$this->rol','$this->lastname','$this->password','$this->username',1,null,null,'$this->date',null,null,null);";
            // echo $sql;
            $result = $this->conn->query($sql);
            $result->setFetchMode(PDO::FETCH_ASSOC);

            return true;
        } else {
            return false;
        }
    }
    // login user
    public function login()
    {
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




        return $stmt;
    }
    public function isAlreadyExist()
    {
        $query = "SELECT *
            FROM
                " . $this->table_name . "
            WHERE
                Usuario='".$this->username."'";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        // execute query
        $stmt->execute();
        if ($stmt->rowCount() > 0) {

            return true;
        } else {
            return false;
        }
    }
    public function getUser($iduser)
    {
        $sql = 'SELECT * from Usuarios where ID_usuarios='.$iduser.';';
        $result = $this->conn->query($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $fila = $result->fetch();

        return $fila;
    }
    public function setUserDeactivated($iduser)
    {
        $sql = "UPDATE $this->table_name SET Estado=0 WHERE ID_usuarios='$iduser';";

        $result = $this->conn->query($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $fila = $result->fetch();
    }
    public function setUserActivated($iduser)
    {
        $sql = "UPDATE $this->table_name SET Estado='1' WHERE ID_usuarios='$iduser';";
        $result = $this->conn->query($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $fila = $result->fetch();
    }


    public function modifiedUser($iduser)
    {
        // if ($this->isAlreadyExist()) {
        //     return false;
        // }

        $this->date=date('Y-m-d H:i:s');
        $sql = "UPDATE $this->table_name SET Nombres='$this->names', Apellidos='$this->lastname', Contraseña='$this->password', Usuario='$this->username', Idrango='$this->rol', Fecha_de_cambio_de_clave='$this->date'  WHERE ID_usuarios='$iduser';";

        $result = $this->conn->query($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $fila = $result->fetch();
    }
    public function getRealIpAddr()
    {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {   //check ip from share internet
            $ip=$_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {   //to check ip is pass from proxy
            $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip=$_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }
    public function getDescriptionRango($idrango)
    {
        $sql = 'select Descripcion from RangoUsuarios where idRangoUsuarios='.$idrango.';';
        $result = $this->conn->query($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $fila = $result->fetch();

        return $fila;
    }
    public function getAllRols()
    {
        $sql = "SELECT * from RangoUsuarios;";

        $result = $this->conn->query($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        return $result;
    }
}
