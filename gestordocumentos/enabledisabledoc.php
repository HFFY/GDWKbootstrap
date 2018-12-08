<?php
include_once '../clases/database.php';
include_once '../clases/user.php';
include_once '../clases/documento.php';
session_start();
//echo $_GET['id'];



$database = new Database();
$db = $database->getConnection();
$user = new User($db);
$document= new Documento($db);


//echo "VIVO";
$iddoc=$_GET['iddoc'];
$id=$_GET['id'];
$filadoc=$document->getDocument($iddoc);
//echo $_GET['id'];
if ($filadoc['Estado']==1) {
    $document->deactivateDocument($iddoc);
} else {
    $document->activateDocument($iddoc);
}

header("Location: gdpaginaprincipal.php?iddoc=".$iddoc."&id=".$id);
