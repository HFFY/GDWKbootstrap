<?php
include_once 'database.php';
class User implements \Serializable
{

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
  public $Demora;
  public $Creadopor;
  public $IP;
  public $Fechadecreacion;
  public $Estado;                        |
  public $Persona;

}
?>
