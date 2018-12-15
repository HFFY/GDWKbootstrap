<?php
include_once 'clases/database.php';
include_once 'clases/user.php';
include_once 'clases/documento.php';
session_start();
$database = new Database();
$db = $database->getConnection();
$user = new User($db);
$document = new Documento($db);
$var=$_GET['search'];
$sql = "SELECT ID_documentos from codigoDocumento where descripcion='$var';";

$result = $db->query($sql);

$result->setFetchMode(PDO::FETCH_ASSOC);
$fila=$result->fetch();
if($fila){
header("Location: gestordocumentos/gdpaginaprincipal.php?iddoc=".$fila['ID_documentos']."&id=".$_SESSION['id']);
}
else{
  header("Location: paginaprincipal.php");
}
?>
