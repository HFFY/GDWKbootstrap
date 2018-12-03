<html>

<head>
        <title>Gestor de documentos pagina principal</title>
        <link rel="stylesheet" type="text/css" href="../css/style.css"/>
        <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<?php

include_once '../clases/database.php';
include_once '../clases/user.php';
include_once '../clases/documento.php';
include_once '../clases/ticket.php';
session_start();
$database = new Database();
$db = $database->getConnection();
$id=$_GET['id'];
$user = new User($db);
$sql = 'select * from usuarios;';
$result = $db->query($sql);
$result->setFetchMode(PDO::FETCH_ASSOC);

if(!empty($id)){//TODO: IMPLEMENTAR SESION INICIADA

$work = $_GET['variable'];

$tarea = new Database($db);
$sqlTarea = "select * from tareas where id_tareas = $work ;";
$resultTarea = $db->query($sqlTarea);
$resultTarea->setFetchMode(PDO::FETCH_ASSOC);
$fila = $resultTarea->fetch();

$tareamodificada = new Ticket($db);

$tareamodificada->Prioridad = !empty($_POST['selectprioridad']) ? $_POST['selectprioridad'] : $tareamodificada->Prioridad;
$tareamodificada->Descripción = !empty($_POST['descripciontarea']) ? $_POST['descripciontarea'] : $tareamodificada->Descripción;
$tareamodificada->Id_usuario = $id;
$tareamodificada->Tipo = !empty($_POST['selecttarea']) ? $_POST['selecttarea'] : $tareamodificada->Tipo;
$tareamodificada->Estado = !empty($_POST['selectestado']) ? $_POST['selectestado'] : $tareamodificada->Estado;

if(!empty($tareamodificada->Prioridad)){
  //Tengo problemas con el envio de datos en fecha y nombre , pero este es el query sin fechas y sin nombre que se implementara
  $sql1 = "UPDATE Tareas SET Prioridad = '$tareamodificada->Prioridad',Descripción='$tareamodificada->Descripción',
    Tipo='$tareamodificada->Tipo' , Estado='$tareamodificada->Estado' WHERE id_tareas ='$work' ;";
  $result1 = $db->query($sql1);
  $result1->setFetchMode(PDO::FETCH_ASSOC);
  header("Location: workflowpaginaprincipal.php?id=".$id);
}
    ?>

<header class="header">

 <nav class="navbar navbar-style">
     <div class="container">
         <div class="navbar-header ">
             <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#micon">
             <span class="icon-bar"></span>
             <span class="icon-bar"></span>
             <span class="icon-bar"></span>
             </button>
             <a href=""> <img class="logo" src="../images/logo.png"></a>
         </div>
         <div class="collapse navbar-collapse" id="micon">
         <ul class="nav navbar-nav navbar-right">
           <li><a href="">Login</a></li>
           <li><a href="../tareas/workflowpaginaprincipal.php?id=<?php echo $id;?>">WorkFlow</a></li>
           <li><a href="../tareas/WorkflowCreacionDeTarea.php?id=<?php echo $id;?>">Crear tarea</a></li>
           <li><a href="">Pagina principal</a></li>

         </ul>
        </div>
     </div>
 </nav>
 <div class="container">
 <div class="row">
 <p class="big-text">Modificar tarea</p>
 </div>
 </div>
 <form method="post">
 <div class="container">
   <div class="row">
     <div class="col-sm-6 banner-info">
 <p>Estado</p>
 <select class="form-control" name="selectestado" method="post">
   <?php if( $fila['Estado'] == 0){?>
   <option value=0 selected>Pendiente de validación</option>
   <option value=1>En ejecución</option>
   <option value=3>Retrasada</option>
   <option value=2>Finalizada</option>
   <?php } ?>

   <?php if( $fila['Estado'] == 1){?>
   <option value=0>Pendiente de validación</option>
   <option value=1 selected>En ejecución</option>
   <option value=3>Retrasada</option>
   <option value=2>Finalizada</option>
   <?php } ?>

   <?php if( $fila['Estado'] == 2){?>
   <option value=0>Pendiente de validación</option>
   <option value=1>En ejecución</option>
   <option value=3>Retrasada</option>
   <option value=2 selected>Finalizada</option>
   <?php } ?>

   <?php if( $fila['Estado'] == 3){?>
   <option value=0>Pendiente de validación</option>
   <option value=1>En ejecución</option>
   <option value=3 selected>Retrasada</option>
   <option value=2>Finalizada</option>
   <?php } ?>

</select>
</div>
</div>
 </div>

 <div class="container">
     <div class="row">
         <div class="col-sm-6 banner-info">
             <p>Tarea</p>
             <select class="form-control" name="selecttarea" method="post">

               <?php if( $fila['Tipo'] == 1){?>
                 <option value=1 selected> Reunión para documento </option>
                 <option value=2> Solicitud de actualización de proceso </option>
                 <option value=3> Solicitud de nuevo proceso </option>
                 <option value=4> Interpretación de normas y procesos </option>
                 <option value=5> Consulta </option>
             <?php } ?>

               <?php if( $fila['Tipo'] == 2){?>
                 <option value=1> Reunión para documento </option>
                 <option value=2 selected> Solicitud de actualización de proceso </option>
                 <option value=3> Solicitud de nuevo proceso </option>
                 <option value=4> Interpretación de normas y procesos </option>
                 <option value=5> Consulta </option>
               <?php } ?>

                 <?php if( $fila['Tipo'] == 3){?>
                   <option value=1> Reunión para documento </option>
                   <option value=2> Solicitud de actualización de proceso </option>
                   <option value=3 selected> Solicitud de nuevo proceso </option>
                   <option value=4> Interpretación de normas y procesos </option>
                   <option value=5> Consulta </option>
                 <?php } ?>

                   <?php if( $fila['Tipo'] == 4){?>
                     <option value=1> Reunión para documento </option>
                     <option value=2> Solicitud de actualización de proceso </option>
                     <option value=3> Solicitud de nuevo proceso </option>
                     <option value=4 selected> Interpretación de normas y procesos </option>
                     <option value=5> Consulta </option>
                   <?php } ?>

                   <?php if( $fila['Tipo'] == 5){?>
                     <option value=1> Reunión para documento </option>
                     <option value=2> Solicitud de actualización de proceso </option>
                     <option value=3> Solicitud de nuevo proceso </option>
                     <option value=4> Interpretación de normas y procesos </option>
                     <option value=5 selected> Consulta </option>
                   <?php } ?>
             </select>
             <p>
                 <br>Fecha inicio</p>
             <form action="/action_page.php" name="fechauno" method="post">
                 <input type="date" name="bday" class="form-control" min ="<?php echo date("Y-m-d") ?>" max="<?php $d=strtotime("+12 Months"); echo date("Y-m-d",$d) ?>">
             </form>
         </div>
         <div class="col-sm-6 banner-image">

             <p>Prioridad</p>

             <select class="form-control" name="selectprioridad" method="post">
             <?php if( $fila['Prioridad'] == 1){?>
               <option value="1" selected >Alta</option>
               <option value="2">Media</option>
               <option value="3">Baja</option>
             <?php } ?>

             <?php if( $fila['Prioridad'] == 2){?>
               <option value="1">Alta</option>
               <option value="2" selected >Media</option>
               <option value="3">Baja</option>
           <?php } ?>

             <?php if( $fila['Prioridad'] == 3){?>
               <option value="1">Alta</option>
               <option value="2">Media</option>
               <option value="3" selected >Baja</option>
             <?php } ?>
              </select>

             <p>
                 <br>Fecha Aceptada</p>
             <form action="/action_page.php" name="fechados" method="post">
                 <input type="date" name="bday" class="form-control" min ="<?php echo date("Y-m-d") ?>" max="<?php $d=strtotime("+12 Months"); echo date("Y-m-d",$d) ?>">
             </form>

         </div>

         <div class="col-sm-6 banner-image">
           <p>Nombre de la tarea</p>
           <input type="text" class="form-control" value="<?php echo $fila['NombreTarea'];?>" name="nombretarea" method="post"> <br>
         </div>

         <div class="form-group">
             <label for="inputlg">
                 <br>
                 <br>
                 <br>
             </label>
             <form action="/action_page.php" name="descripciontarea" method="post">
                 <textarea class="form-control input-lg" name="message" rows="10" cols="30" placeholder="Descripcion"><?php echo $fila['Descripción'];?></textarea>
                 <br>
             </form>
         </div>
         <a class="btn btn-first" href="../tareas/workflowpaginaprincipal.php?id=<?php echo $id;?>">Cancelar</a>
         <button type="submit" class="button" > Modificar </button>

     </div>
 </div>
 </form>
</header>
<?php
} else {
    echo "You don't have permission to acces this page.";
}
 ?>
</body>

</html>
