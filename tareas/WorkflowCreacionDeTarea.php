<html>

<head>
    <title>Gestor de documentos pagina principal</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css" />
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

$creartarea = new Ticket($db);

if(!empty($id)){//TODO: IMPLEMENTAR SESION INICIADA

$creartarea->Prioridad = !empty($_POST['selectprioridad']) ? $_POST['selectprioridad'] : $creartarea->Prioridad;
$creartarea->Fechaestimada= !empty($_POST['fechauno']) ? $_POST['fechauno'] : $creartarea->Fechaestimada;
$creartarea->Fechaoficial= !empty($_POST['fechados']) ? $_POST['fechados'] : $creartarea->Fechaoficial;
$creartarea->Descripción = !empty($_POST['descripciontarea']) ? $_POST['descripciontarea'] : $creartarea->Descripción;
$creartarea->Id_usuario = $id;
$creartarea->Tipo = !empty($_POST['selecttarea']) ? $_POST['selecttarea'] : $creartarea->Tipo;
$creartarea->Fechadecreacion = date(" Y-m-d ");
$creartarea->NombreTarea= !empty($_POST['nombretarea']) ? $_POST['nombretarea'] : $creartarea->NombreTarea;


if(!empty($creartarea->Prioridad)){

  $sql1 = "INSERT into Tareas VALUES (null, '$creartarea->Prioridad', '$creartarea->Fechaestimada','$creartarea->Fechaoficial','$creartarea->Descripción','$creartarea->Id_usuario',
    '$creartarea->Tipo',null,null,null,'$creartarea->Fechadecreacion','0',null,'$creartarea->NombreTarea');";
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
                            <li><a href="">WorkFlow</a></li>
                            <li><a href="..">Pagina principal</a></li>

                        </ul>
                    </div>
                </div>
            </nav>
            <div class="container">
                <div class="row">
                    <p class="big-text">Crear tarea</p>
                </div>
            </div>
            <form method="post">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-6 banner-info">
                            <p>Tarea</p>
                            <select class="form-control" name="selecttarea">
                                <option value=1 selected> Reunión para documento </option>
                                <option value=2> Solicitud de actualización de proceso </option>
                                <option value=3> Solicitud de nuevo proceso </option>
                                <option value=4> Interpretación de normas y procesos </option>
                                <option value=5> Consulta </option>
                            </select>
                            <p>
                                <br>Fecha inicio</p>

                                <input type="date" name="fechauno" class="form-control" min="<?php echo date(" Y-m-d ") ?>" max="<?php $d=strtotime(" +12 Months "); echo date("Y-m-d ",$d) ?>" required>

                        </div>
                        <div class="col-sm-6 banner-image">
                            <p>Prioridad</p>
                            <select class="form-control" name="selectprioridad">
                                <option value=1>Alta</option>
                                <option value=2 selected>Media</option>
                                <option value=3>Baja</option>
                            </select>
                            <p>
                                <br>Fecha Aceptada</p>

                                <input type="date" name="fechados" class="form-control" min="<?php echo date(" Y-m-d ") ?>" max="<?php $d=strtotime(" +12 Months "); echo date("Y-m-d ",$d) ?>" required>

                        </div>

                        <div class="col-sm-6 banner-image">
                            <p>Nombre de la tarea</p>

                            <input type="text" class="form-control" name="nombretarea" required>

                            <br>
                        </div>

                        <div class="form-group">
                            <label for="inputlg">
                                <br>
                                <br>
                                <br>
                            </label>
                                <textarea class="form-control input-lg" name="descripciontarea" rows="10" cols="30" placeholder="Descripcion" required></textarea>
                                <br>
                        </div>

                        <a class="btn btn-first" href="../tareas/workflowpaginaprincipal.php?id=<?php echo $id;?>">Cancelar</a>

                        <button type="submit" class="button"> Crear </button>

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
