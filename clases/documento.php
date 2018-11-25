<?php
class Documento
{

    // database connection and table name
    private $conn;
    private $table_name = "Documentos";
    private $list;

    // object properties
    public $id;

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
    public $Estado='1';
    public $Proceso;
    public $Subproceso;
    public $Tipodedocumento;
    public $Link;
    //
    public function __construct($db)
    {
        $this->conn = $db;
        $this->database= new Database();
    }
    public function getDocumentLink()
    {
        return;
    }

    public function deactivateDocument($iddocument)
    {
        echo "HOLA";
        $sql = "UPDATE $this->table_name SET Estado='0' WHERE ID_documentos='$iddocument';";
        $result = $this->conn->query($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $fila = $result->fetch();
    }
    public function activateDocument($iddocument)
    {
        // $query = "SELECT
        //           `Link`
        //         FROM
        //         " . $this->table_name . "
        //       WHERE
        //           Proceso='".$this->Proceso."' AND Subproceso='".$this->Subproceso."'"."' AND Tipod de documento='".$this->Tipodedocumento."'";
        //
        // // prepare query statement
        // $stmt = $this->conn->prepare($query);
        // // execute query
        // $stmt->execute();
        //
        // return $stmt;
        echo "HOLA";
        $sql = "UPDATE $this->table_name SET Estado='1' WHERE ID_documentos='$iddocument';";
        $result = $this->conn->query($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $fila = $result->fetch();
    }
    public function getDocument($iddocument)
    {
        // $query = "SELECT
        //             `Proceso`, `Subproceso`, `Tipo de documento`,`Link`, `Numero del documento` ,`Nombre del documento`, `Version` , `Creador` , `Revisor`, `Autorizador` , `Diseño del proceso`, `Fecha de entrada en vigencia` , `Fecha de entrada en caducidad` , `Areas a las que afecta` , `Registros que corresponden` , `Descripcion` , `Estado`
        //         FROM
        //             " . $this->table_name . "
        //         WHERE
        //             Nombre del documento='".$this->Nombredeldocumento."'";
        //
        // // prepare query statement
        // $stmt = $this->conn->prepare($query);
        // // execute query
        // $stmt->execute();
        $sql = 'SELECT * from documentos where ID_documentos='.$iddocument.';';

        $result = $this->conn->query($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $fila = $result->fetch();

        return $fila;
    }
    public function getDocumentsPerUser($roluser)
    {
        if ($roluser=='1'|| $roluser=='0') {
            $sql = 'SELECT * from documentos;';
            $result = $this->conn->query($sql);
            $result->setFetchMode(PDO::FETCH_ASSOC);
            $fila = $result->fetch();

            return $fila;
        } else {
            $sql = 'SELECT * from documentosPorRango where idRangoUsuarios='.$roluser.';';
            $result = $this->conn->query($sql);
            $result->setFetchMode(PDO::FETCH_ASSOC);
            $fila = $result->fetch();

            return $fila;
        }
    }
    public function insertDocument()
    {
        // $query = "SELECT
        //             `Proceso`, `Subproceso`, `Tipo de documento`,`Link`, `Numero del documento` ,`Nombre del documento`, `Version` , `Creador` , `Revisor`, `Autorizador` , `Diseño del proceso`, `Fecha de entrada en vigencia` , `Fecha de entrada en caducidad` , `Areas a las que afecta` , `Registros que corresponden` , `Descripcion` , `Estado`
        //         FROM
        //             " . $this->table_name . "
        //         WHERE
        //             Nombre del documento='".$this->Nombredeldocumento."'";
        $sql = "INSERT into documentos VALUES (null, '$this->Proceso', '$this->Subproceso','$this->Tipodedocumento','$this->Numerodeldocumento','$this->Nombredeldocumento',
          '$this->Version','$this->Creador','$this->Revisor','$this->Autorizador','$this->Disenodelproceso','$this->Fechadeentradavigencia','$this->Fechadeentradaencaducidad','$this->Areasalasqueafecta',
          '$this->Registrosquecorresponden','$this->Descripcion','$this->Estado','$this->Link');";
        // echo $sql;
        $result = $this->conn->query($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $fila = $result->fetch();
        $sqlget="SELECT LAST_INSERT_ID();";
        $resultget = $this->conn->query($sqlget);
        $resultget->setFetchMode(PDO::FETCH_ASSOC);
        $filaget = $resultget->fetch();
        $iddoc= $filaget['LAST_INSERT_ID()'];
        $this->generateCodigoDocument($iddoc);
        // // prepare query statement
        // $stmt = $this->conn->prepare($query);
        // // execute query
        // $stmt->execute();
        // return $file;
    }
    public function getCodeDocument($iddoc)
    {
        $sql = 'select descripcion from codigoDocumento where ID_documentos='.$iddoc.';';
        $result = $this->conn->query($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $fila = $result->fetch();

        return $fila;
    }
    public function generateCodigoDocument($iddoc)
    {
        $sql = "SELECT Proceso, Subproceso, `Tipo de documento` from documentos where ID_documentos='$iddoc';";

        $result = $this->conn->query($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $fila = $result->fetch();
        $codigogenerado=$fila['Proceso'].$fila['Subproceso'].$fila['Tipo de documento'];

        $var1=$fila['Proceso'];
        $var2=$fila['Subproceso'];
        $var3=$fila['Tipo de documento'];
        $sqlinsert = "INSERT into codigoDocumento VALUES (null, '$var1','$var2','$var3','$codigogenerado','$iddoc');";
        echo $sqlinsert;
        $resultinsert = $this->conn->query($sqlinsert);
        $resultinsert->setFetchMode(PDO::FETCH_ASSOC);
        $filainsert = $resultinsert->fetch();
    }
}
