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
session_start();
$database = new Database();
$db = $database->getConnection();

$user = new User($db);
$sql = 'select * from usuarios;';
$result = $db->query($sql);
$result->setFetchMode(PDO::FETCH_ASSOC);

$tarea = new Database($db);//Por Validar
$sqlTarea = "select * from tareas where id_tareas = 1 ;"; //poner de parametro de busueda la variable asignada
$resultTarea = $db->query($sqlTarea);
$resultTarea->setFetchMode(PDO::FETCH_ASSOC);
$fila = $resultTarea->fetch()
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
         <li><a href="">WorkFlow</a></li>
         <li><a href="">Añadir Documento</a></li>
         <li><a href="">Modificar Documento</a></li>

         </ul>
        </div>
     </div>
 </nav>
 <div class="container">
 <div class="row">
 <p class="big-text">Tarea</p>
 </div>
 </div>
 <div class="container">
     <div class="row">
         <div class="col-sm-6 banner-info">
     <p>Tipo de Tarea</p>
     <select class="form-control" form="1">
       <option value="1" selected isabled>Uno</option>
       <option value="2" disabled>Dos</option>
       <option value="3" disabled>Tres</option>
       <option value="4" disabled>Cuatro</option>
     </select>
     <p>
         <br>Fecha inicio</p>
     <form action="/action_page.php">
         <input type="date" name="bday" class="form-control" min="<?php echo date("Y-m-d");?>" value="<?php echo $fila['Fecha de estimada']; ?>" disabled>
     </form>
 </div>
 <div class="col-sm-6 banner-image">
     <p>Prioridad</p>
     <select class="form-control">
         <option value="1" disabled>Uno</option>
         <option value="2" disabled>Dos</option>
         <option value="3" selected disabled>Tres</option>
         <option value="4" disabled>Cuatro</option>
     </select>
     <p>
         <br>Fecha Aceptada</p>
     <form action="/action_page.php">
         <input type="date" class="form-control" min="<?php echo date("Y-m-d");?>" value="<?php echo $fila['Fecha oficial']; ?>" disabled>
     </form>

 </div>

 <div class="col-sm-6 banner-image">
   <p>Nombre de la tarea</p>
   <input type="text" class="form-control" disabled><br>
 </div>

 <div class="form-group">
     <label for="inputlg">
         <br>
         <br>
         <br>
     </label>
     <form action="/action_page.php">
         <textarea class="form-control input-lg" name="message" rows="10" cols="30" placeholder="Descripcion" disabled ></textarea>
         <br>
     </form>
 </div>
 <a class="btn btn-first" href="../tareas/WorkflowPaginaPrincipal.php">Cancelar</a>
<a href="">
 <button type="submit" class="button" >Modificar</button>
</a>
 <a href="">
<button type="submit" class="button" > Validar </button>
</a>

<a href="">
<button type="submit" class="button" > Finalizar </button>
</a>
 </button>

</div>
</div>
</header>

</body>

</html>
