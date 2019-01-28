<?php
class Documento
{

    // ve el metodoque modifica el documento
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
    public $usuariosauto;
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
    public function getAllProcesos()
    {
        $sql = "SELECT * from Proceso;";

        $result = $this->conn->query($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        return $result;
    }
    public function getAllSubproceso()
    {
        $sql = "SELECT * from subproceso;";
        $result = $this->conn->query($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        return $result;
    }
    public function getAllTipoDeDocumento()
    {
        $sql = "SELECT * from Tipo_de_documento;";
        $result = $this->conn->query($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        return $result;
    }
    public function deactivateDocument($iddocument)
    {

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

        $sql = "UPDATE $this->table_name SET Estado='1' WHERE ID_documentos='$iddocument';";
        $result = $this->conn->query($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $fila = $result->fetch();
    }
    public function getDocument($iddocument)
    {
        // $query = "SELECT
        //             `Proceso`, `Subproceso`, Tipo_de_documento,`Link`, `Numero_del_documento` ,`Nombre_del_documento`, `Version` , `Creador` , `Revisor`, `Autorizador` , `Diseño del proceso`, `Fecha_de_entrada_en_vigencia` , `Fecha_de_entrada_en_caducidad` , `Areas_a_las_que_afecta` , `Registros_que_corresponden` , `Descripcion` , `Estado`
        //         FROM
        //             " . $this->table_name . "
        //         WHERE
        //             Nombre_del_documento='".$this->Nombredeldocumento."'";
        //
        // // prepare query statement
        // $stmt = $this->conn->prepare($query);
        // // execute query
        // $stmt->execute();
        $sql = 'SELECT * from Documentos where ID_documentos='.$iddocument.';';

        $result = $this->conn->query($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $fila = $result->fetch();

        return $fila;
    }
    public function getDocumentsPerUser($roluser)
    {
        if ($roluser=='1'|| $roluser=='666') {
            $sql = 'SELECT * from Documentos;';
            $result = $this->conn->query($sql);
            $result->setFetchMode(PDO::FETCH_ASSOC);


            return $result;
        } else {
            $sql = 'SELECT * from documentosPorRango where idRangoUsuarios='.$roluser.';';

            $result = $this->conn->query($sql);
            $result->setFetchMode(PDO::FETCH_ASSOC);
            $string;
            $contador=0;


            while ($fila=$result->fetch()) {
                if ($contador==0) {
                    $string="ID_documentos=".$fila['ID_documentos'];
                  //  echo $fila['ID_documentos'];
                } else {
                    $string=$string." or ID_documentos=".$fila['ID_documentos'];
                }
                $contador=$contador+1;
            }

            if (!empty($string)) {
                $sql1 = 'SELECT * from Documentos where '.$string.';';
                $result1 = $this->conn->query($sql1);
                $result1->setFetchMode(PDO::FETCH_ASSOC);
                return $result1;
            }
        }
    }
    public function getLatestDocuments()
    {
        $sql = 'SELECT id_documento, fecha, hora, Descripcion FROM DocUsuCambios where fecha IN (SELECT max(fecha) from DocUsuCambios);';

        $result = $this->conn->query($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);


        return $result;
    }
    public function getDifferentVersions($nombredelactual)
    {
        $sql = "SELECT Nombre_del_documento, Version, Link, Descripcion FROM Documentos where Nombre_del_documento='$nombredelactual';";

        $result = $this->conn->query($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);


        return $result;
    }
    public function insertDocument()
    {
        // $query = "SELECT
        //             `Proceso`, `Subproceso`, Tipo_de_documento,`Link`, `Numero_del_documento` ,`Nombre_del_documento`, `Version` , `Creador` , `Revisor`, `Autorizador` , `Diseño del proceso`, `Fecha_de_entrada_en_vigencia` , `Fecha_de_entrada_en_caducidad` , `Areas_a_las_que_afecta` , `Registros_que_corresponden` , `Descripcion` , `Estado`
        //         FROM
        //             " . $this->table_name . "
        //         WHERE
        //             Nombre_del_documento='".$this->Nombredeldocumento."'";
        $sql = "INSERT into Documentos VALUES (null, '$this->Proceso', '$this->Subproceso','$this->Tipodedocumento','$this->Numerodeldocumento','$this->Nombredeldocumento',
          '$this->Version','$this->Creador','$this->Revisor','$this->Autorizador','$this->Disenodelproceso','$this->Fechadeentradavigencia','$this->Fechadeentradaencaducidad','$this->Areasalasqueafecta',
          '$this->Registrosquecorresponden','$this->Descripcion','$this->Estado','$this->Link');";


        $result = $this->conn->query($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $fila = $result->fetch();
        $sqlget="SELECT LAST_INSERT_ID();";

        $resultget = $this->conn->query($sqlget);
        $resultget->setFetchMode(PDO::FETCH_ASSOC);
        $filaget = $resultget->fetch();
        $iddoc= $filaget['LAST_INSERT_ID()'];
        $this->generateCodigoDocument($iddoc);

        $this->getUsuariosAuto($iddoc);

        // // prepare query statement
        // $stmt = $this->conn->prepare($query);
        // // execute query
        // $stmt->execute();
        // return $file;
    }
    public function modifiedDocument($iddoc, $iduser)
    {

        // $query = "SELECT
        //             `Proceso`, `Subproceso`, Tipo_de_documento,`Link`, `Numero_del_documento` ,`Nombre_del_documento`, `Version` , `Creador` , `Revisor`, `Autorizador` , `Diseño del proceso`, `Fecha_de_entrada_en_vigencia` , `Fecha_de_entrada_en_caducidad` , `Areas_a_las_que_afecta` , `Registros_que_corresponden` , `Descripcion` , `Estado`
        //         FROM
        //             " . $this->table_name . "
        //         WHERE
        //             Nombre_del_documento='".$this->Nombredeldocumento."'";
        $sql = "UPDATE Documentos SET Proceso='$this->Proceso', Subproceso='$this->Subproceso', Tipo_de_documento='$this->Tipodedocumento',Numero_del_documento='$this->Numerodeldocumento',Nombre_del_documento='$this->Nombredeldocumento',
          Version='$this->Version',Creador='$this->Creador',Revisor='$this->Revisor',Autorizador='$this->Autorizador',`Diseño del proceso`='$this->Disenodelproceso',Fecha_de_entrada_en_vigencia='$this->Fechadeentradavigencia',Fecha_de_entrada_en_caducidad='$this->Fechadeentradaencaducidad',Areas_a_las_que_afecta='$this->Areasalasqueafecta',
          Registros_que_corresponden='$this->Registrosquecorresponden',`Descripcion`='$this->Descripcion',Estado='$this->Estado',Link='$this->Link' WHERE ID_documentos=$iddoc;";


        $result = $this->conn->query($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);

        $fila = $result->fetch();

        $sqlget="SELECT LAST_INSERT_ID();";
        $resultget = $this->conn->query($sqlget);
        $resultget->setFetchMode(PDO::FETCH_ASSOC);
        $filaget = $resultget->fetch();


        $this->modifiedCodigoDocument($iddoc);

        $this->modifiedUsuariosAuto($iddoc);
        $this->addChangeToDocument($iddoc, $iduser, $this->Descripcion);
        // // prepare query statement
        // $stmt = $this->conn->prepare($query);
        // // execute query
        // $stmt->execute();
        // return $file;
    }
    public function addChangeToDocument($iddoc, $iduser, $descrip)
    {
        $date=date('Y-m-d H:i:s');
        $sql = "INSERT into DocUsuCambios VALUES (null,'$iddoc','$iduser','$date','$date','$descrip',null)";

        $result = $this->conn->query($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);
    }
    public function getUsuariosAuto($iddoc)
    {
        $dumbvar=$this->usuariosauto;
        foreach ($dumbvar as $usuario) {
            $sql = "INSERT into documentosPorRango VALUES (null,'$usuario','$iddoc')";

            $result = $this->conn->query($sql);
            $result->setFetchMode(PDO::FETCH_ASSOC);
            $fila = $result->fetch();
        }
    }
    public function getArrayUsuariosAuto($iddoc)
    {
        $sql = "SELECT * from documentosPorRango where ID_documentos='$iddoc';";

        $result = $this->conn->query($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);

        $resvar=array();

        $contador=0;

        while ($fila = $result->fetch()) {
            $resvar[$contador]=$fila['idRangoUsuarios'];
            $contador=$contador+1;
        }
        return $resvar;
    }

    public function modifiedUsuariosAuto($iddoc)
    {
        $dumbvar=$this->usuariosauto;
        $idvardumb=0;
        $sqlres = "DELETE from documentosPorRango where ID_documentos='$iddoc';";

        $resultres = $this->conn->query($sqlres);
        $resultres->setFetchMode(PDO::FETCH_ASSOC);
        $filares = $resultres->fetch();
        foreach ($dumbvar as $usuario) {
            $sql = "INSERT into documentosPorRango VALUES (null,'$usuario','$iddoc')";

            $result = $this->conn->query($sql);
            $result->setFetchMode(PDO::FETCH_ASSOC);
            $fila = $result->fetch();
        }
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
        $sql = "SELECT Proceso, Subproceso, Tipo_de_documento from Documentos where ID_documentos='$iddoc';";
        $result = $this->conn->query($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $fila = $result->fetch();
        $dumbvarsql1=$fila['Proceso'];
        $sql1 = "SELECT Codigo from Proceso where idProceso='$dumbvarsql1';";

        $result1 = $this->conn->query($sql1);
        $result1->setFetchMode(PDO::FETCH_ASSOC);
        $fila1 = $result1->fetch();
        $dumbvarsql2=$fila['Subproceso'];
        $sql2 = "SELECT Codigo from subproceso where idsubproceso='$dumbvarsql2';";
        $result2 = $this->conn->query($sql2);
        $result2->setFetchMode(PDO::FETCH_ASSOC);
        $fila2 = $result2->fetch();
        $dumbvarsql3=$fila['Tipo_de_documento'];
        $sql3 = "SELECT Codigo from Tipo_de_documento where `idtipo_de_documento`='$dumbvarsql3';";
        $result3 = $this->conn->query($sql3);
        $result3->setFetchMode(PDO::FETCH_ASSOC);
        $fila3 = $result3->fetch();

        $codigogenerado=$fila1['Codigo']."-".$fila2['Codigo']."-".$fila3['Codigo'];

        $var1=$fila['Proceso'];
        $var2=$fila['Subproceso'];
        $var3=$fila['Tipo_de_documento'];

        $sqlinsert = "INSERT into codigoDocumento VALUES (null, '$var1','$var2','$var3','$codigogenerado','$iddoc');";


        $resultinsert = $this->conn->query($sqlinsert);

        $resultinsert->setFetchMode(PDO::FETCH_ASSOC);
        $filainsert = $resultinsert->fetch();
    }
    public function modifiedCodigoDocument($iddoc)
    {
        $sql = "SELECT Proceso, Subproceso, Tipo_de_documento from Documentos where ID_documentos='$iddoc';";
        $result = $this->conn->query($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $fila = $result->fetch();
        $dumbvarsql1=$fila['Proceso'];
        $sql1 = "SELECT Codigo from Proceso where idProceso='$dumbvarsql1';";
        $result1 = $this->conn->query($sql1);
        $result1->setFetchMode(PDO::FETCH_ASSOC);
        $fila1 = $result1->fetch();
        $dumbvarsql2=$fila['Subproceso'];
        $sql2 = "SELECT Codigo from subproceso where idsubproceso='$dumbvarsql2';";
        $result2 = $this->conn->query($sql2);
        $result2->setFetchMode(PDO::FETCH_ASSOC);
        $fila2 = $result2->fetch();
        $dumbvarsql3=$fila['Tipo_de_documento'];
        $sql3 = "SELECT Codigo from Tipo_de_documento where `idtipo_de_documento`='$dumbvarsql3';";
        $result3 = $this->conn->query($sql3);
        $result3->setFetchMode(PDO::FETCH_ASSOC);
        $fila3 = $result3->fetch();
        $codigogenerado=$fila1['Codigo']."-".$fila2['Codigo']."-".$fila3['Codigo'];

        $var1=$fila['Proceso'];
        $var2=$fila['Subproceso'];
        $var3=$fila['Tipo_de_documento'];
        $sqlinsert = "UPDATE codigoDocumento SET idproceso='$var1',idsubproceso='$var2',idtipodedocumento='$var3',descripcion='$codigogenerado' where ID_documentos='$iddoc';";

        $resultinsert = $this->conn->query($sqlinsert);
        $resultinsert->setFetchMode(PDO::FETCH_ASSOC);
        $filainsert = $resultinsert->fetch();
    }
}
