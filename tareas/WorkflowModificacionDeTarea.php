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

$user = new User($db);
$sql = 'select * from usuarios;';
$result = $db->query($sql);
$result->setFetchMode(PDO::FETCH_ASSOC);

$work = $_GET['variable'];

$tarea = new Database($db);
$sqlTarea = "select * from tareas where id_tareas = $work ;";
$resultTarea = $db->query($sqlTarea);
$resultTarea->setFetchMode(PDO::FETCH_ASSOC);
$fila = $resultTarea->fetch();

$tareamodificada = new Ticket($db);

$tareamodificada->Prioridad = $_GET['selectprioridad'];
$tareamodificada->Fechaestimada = $_GET['fechauno'];
$tareamodificada->Fechaoficial = $_GET['fechados'];
$tareamodificada->Descripción = $_GET['descripciontarea'];
$tareamodificada->Id_usuario = '1';//hardcoded
$tareamodificada->Tipo = $_GET['selecttarea'];
$tareamodificada->Estado = $_GET['selectestado'];
$tareamodificada->Fechadecreacion = date('Y-m-d H:i:s');
$tareamodificada->Demora = null;
$tareamodificada->NombreTarea = $_GET['nombretarea'];
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
           <li><a href="../tareas/workflowpaginaprincipal.php">WorkFlow</a></li>
           <li><a href="../tareas/WorkflowCreacionDeTarea.php">Crear tarea</a></li>
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
 <div class="container">
   <div class="row">
     <div class="col-sm-6 banner-info">
 <p>Estado</p>
 <select class="form-control" name="selectestado">
   <?php if( $fila['Estado'] == 0){?>
   <option value="0" selected>Pendiente de validación</option>
   <option value="1">En ejecución</option>
   <option value="3">Retrasada</option>
   <option value="2">Finalizada</option>
   <?php } ?>

   <?php if( $fila['Estado'] == 1){?>
   <option value="0">Pendiente de validación</option>
   <option value="1" selected>En ejecución</option>
   <option value="3">Retrasada</option>
   <option value="2">Finalizada</option>
   <?php } ?>

   <?php if( $fila['Estado'] == 2){?>
   <option value="0">Pendiente de validación</option>
   <option value="1">En ejecución</option>
   <option value="3">Retrasada</option>
   <option value="2" selected>Finalizada</option>
   <?php } ?>

   <?php if( $fila['Estado'] == 3){?>
   <option value="0">Pendiente de validación</option>
   <option value="1">En ejecución</option>
   <option value="3" selected>Retrasada</option>
   <option value="2">Finalizada</option>
   <?php } ?>

</select>
</div>
</div>
 </div>

 <div class="container">
     <div class="row">
         <div class="col-sm-6 banner-info">
             <p>Tarea</p>
             <select class="form-control" name="selecttarea">

               <?php if( $fila['Tipo'] == 1){?>
                 <option value="1" selected> Reunión para documento </option>
                 <option value="2"> Solicitud de actualización de proceso </option>
                 <option value="3"> Solicitud de nuevo proceso </option>
                 <option value="4"> Interpretación de normas y procesos </option>
                 <option value="5"> Consulta </option>
             <?php } ?>

               <?php if( $fila['Tipo'] == 2){?>
                 <option value="1"> Reunión para documento </option>
                 <option value="2" selected> Solicitud de actualización de proceso </option>
                 <option value="3"> Solicitud de nuevo proceso </option>
                 <option value="4"> Interpretación de normas y procesos </option>
                 <option value="5"> Consulta </option>
               <?php } ?>

                 <?php if( $fila['Tipo'] == 3){?>
                   <option value="1"> Reunión para documento </option>
                   <option value="2"> Solicitud de actualización de proceso </option>
                   <option value="3" selected> Solicitud de nuevo proceso </option>
                   <option value="4"> Interpretación de normas y procesos </option>
                   <option value="5"> Consulta </option>
                 <?php } ?>

                   <?php if( $fila['Tipo'] == 4){?>
                     <option value="1"> Reunión para documento </option>
                     <option value="2"> Solicitud de actualización de proceso </option>
                     <option value="3"> Solicitud de nuevo proceso </option>
                     <option value="4" selected> Interpretación de normas y procesos </option>
                     <option value="5"> Consulta </option>
                   <?php } ?>

                   <?php if( $fila['Tipo'] == 5){?>
                     <option value="1"> Reunión para documento </option>
                     <option value="2"> Solicitud de actualización de proceso </option>
                     <option value="3"> Solicitud de nuevo proceso </option>
                     <option value="4"> Interpretación de normas y procesos </option>
                     <option value="5" selected> Consulta </option>
                   <?php } ?>
             </select>
             <p>
                 <br>Fecha inicio</p>
             <form action="/action_page.php" name="fechauno">
                 <input type="date" name="bday" class="form-control" min ="<?php echo date("Y-m-d") ?>" max="<?php $d=strtotime("+12 Months"); echo date("Y-m-d",$d) ?>">
             </form>
         </div>
         <div class="col-sm-6 banner-image">

             <p>Prioridad</p>

             <select class="form-control" name="selectprioridad">
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
             <form action="/action_page.php" name="fechados">
                 <input type="date" name="bday" class="form-control" min ="<?php echo date("Y-m-d") ?>" max="<?php $d=strtotime("+12 Months"); echo date("Y-m-d",$d) ?>">
             </form>

         </div>

         <div class="col-sm-6 banner-image">
           <p>Nombre de la tarea</p>
           <input type="text" class="form-control" value="<?php echo $fila['NombreTarea'];?>" name="nombretarea"><br>
         </div>

         <div class="form-group">
             <label for="inputlg">
                 <br>
                 <br>
                 <br>
             </label>
             <form action="/action_page.php" name="descripciontarea">
                 <textarea class="form-control input-lg" name="message" rows="10" cols="30" placeholder="Descripcion"><?php echo $fila['Descripción'];?></textarea>
                 <br>
             </form>
         </div>
         <a class="btn btn-first" href="../tareas/workflowpaginaprincipal.php">Cancelar</a>
         <button type="submit" class="button" href=""> Modificar </button>
         </button>

     </div>
 </div>
</header>

</body>

</html>
