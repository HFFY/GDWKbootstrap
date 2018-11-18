<?php
class documento{

    // database connection and table name
    private $conn;
    private $table_name = "Documentos";
    private $list_

    // object properties
    public $id;
    public $Nombre;
    public $Version;
    public $Creador;
    public $Numerodeldocumento;
    public $Nombredeldocumento;
    public $Revisor;
    public $Autorizador;
    public $Disenodelproceso;
    public $Fechadeentradavigencia;
    public $Fechadeentradaencaducidad;
    public $Areasalasqueafecta;
    public $Registrosquecorresponden;
    public $Descripcion;
    public $Estado;
    public $Proceso;
    public $Subproceso;
    public $Tipodedocumento;
    //

    function getDocumentLink(){
      $query = "SELECT
                  `Link`
                FROM
                " . $this->table_name . "
              WHERE
                  Proceso='".$this->Proceso."' AND Subproceso='".$this->Subproceso."'"."' AND Tipod de documento='".$this->Tipodedocumento."'";

      // prepare query statement
      $stmt = $this->conn->prepare($query);
      // execute query
      $stmt->execute();

      return $stmt;
    }
    function getDocument(){
      $query = "SELECT
                  `Proceso`, `Subproceso`, `Tipo de documento`,`Link`, `Numero del documento` ,`Nombre del documento`, `Version` , `Creador` , `Revisor`, `Autorizador` , `Diseño del proceso`, `Fecha de entrada en vigencia` , `Fecha de entrada en caducidad` , `Areas a las que afecta` , `Registros que corresponden` , `Descripcion` , `Estado`
              FROM
                  " . $this->table_name . "
              WHERE
                  Nombre del documento='".$this->Nombredeldocumento."'";

      // prepare query statement
      $stmt = $this->conn->prepare($query);
      // execute query
      $stmt->execute();

      return $stmt;
    }


}
?>
