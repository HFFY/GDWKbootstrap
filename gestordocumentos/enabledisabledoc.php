<?php
include_once '../clases/database.php';
include_once '../clases/user.php';
include_once '../clases/documento.php';
session_start();
$_SESSION['id']=$_GET['id'];
$_SESSION['iddoc']=$_GET['iddoc'];

$database = new Database();
$db = $database->getConnection();
$user = new User($db);
$document= new Documento($db);
// echo $_SESSION['id'];

echo "VIVO";
$iddoc=$_SESSION['iddoc'];
$id=$_SESSION['id'];
$filadoc=$document->getDocument($iddoc);
echo $filadoc['Estado'];
if ($filadoc['Estado']==1) {
    $document->deactivateDocument($iddoc);
} else {
    $document->activateDocument($iddoc);
}
header("Location: gdpaginaprincipal.php?iddoc=".$iddoc."&id=".$id);
