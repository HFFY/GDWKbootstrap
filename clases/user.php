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

        $con=mysqli_connect($this->database->getHost(), $this->database->getUsername(), $this->database->getPassword(), $this->database->getDbname());
        echo "asdasd";
        // Check connection
        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }



        // Perform queries
        if (!is_null($this->username)) {
            mysqli_query($con, "INSERT INTO $this->table_name (Nombres, ID_usuarios, Idrango, Apellidos, Contraseña, Usuario, Estado, `Fecha de login`, `Fecha de cambio de clave`, `Fecha de creación`, IDcreador, IPcreación, IPlogin)
  VALUES   ('$this->names', null, '1','$this->lastname','$this->password','$this->username',$this->rol,'','','$this->date',null,'asdasd123','qwqeasda21312')");


            return true;
        } else {
            return false;
        }
        mysqli_close($con);
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

        echo $this->username;
        echo "<br>";


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
    public function getUsername()
    {
        $con=mysqli_connect($this->database->getHost(), $this->database->getUsername(), $this->database->getPassword(), $this->database->getDbname());
        echo "asdasd";
        // Check connection
        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
        mysqli_query($con, "SELECT usuario from usuarios where Usuario=".$this->username);
        mysqli_close($con);
    }
}
