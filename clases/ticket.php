<?php
include_once 'database.php';
class Ticket{
    private $conn;
    private $database;
    private $table_name = "tareas";

    // object properties
    public $id;
    public $Prioridad;
    public $Fechaestimada;
    public $Fechaoficial;
    public $Descripción;
    public $Id_usuario;
    public $Tipo;
    public $Estado;
    public $Fechadecreacion;
    //////

    public $Demora=NULL;
    public $Creadopor=NULL;
    public $IP=NULL;
    public $Persona=NULL;
    public $NombreTarea;
    public function __construct($db)
    {
        $this->conn = $db;
        $this->database= new Database();
        $this->Fechadecreacion=date('Y-m-d H:i:s');
        $this->Demora=date('Y-m-d H:i:s');
    }
    public function crearTarea(){
        $sql = "INSERT into Tareas VALUES (null, '$this->Prioridad', '$this->Fechaestimada','$this->Fechaoficial','$this->Descripción','$this->Id_usuario',
          '$this->Tipo','null','null','null','$this->Fechadecreacion','1','null','$this->$NombreTarea');";
        $result = $this->conn->query($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);
    }
    public function validarTarea($idtarea)
    {
        $sql = "UPDATE Tareas SET Estado='2' where id_tareas='$idtarea';";
        // echo $sql;
        $result = $this->conn->query($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);
    }
    public function comprobarDateTarea()
    {
        $sql= "SELECT * from Tareas where Estado = '2';";
        $result = $this->conn->query($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);

        while ($fila=$result->fetch()) {
            $date1 = strtotime(date('Y-m-d'));
            $dumbdate=strtotime($fila['Fechaoficial']);
            if ($dumbdate < $date1 ==1) {
                $dumbvar=$fila['id_tareas'];
                $sqlup = "UPDATE $this->table_name SET Estado='4' WHERE id_tareas='$dumbvar';";
                $resultup = $this->conn->query($sqlup);
                $resultup->setFetchMode(PDO::FETCH_ASSOC);
            }
        }
    }
    public function resolverTarea($idtarea,$newdate)
    {
        $sql = "UPDATE Tareas SET Estado='3' , Fechaoficial ='$newdate' where id_tareas='$idtarea';";
        $result = $this->conn->query($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);
    }
}
