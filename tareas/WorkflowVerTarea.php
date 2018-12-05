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
session_start();
$database = new Database();
$db = $database->getConnection();
$id=$_GET['id'];
$user = new User($db);
$sql = 'select * from usuarios;';
$result = $db->query($sql);
$result->setFetchMode(PDO::FETCH_ASSOC);
if(!empty($id)){//TODO: IMPLEMENTAR SESION INICIADA
$kind = $_GET['variable1'];
$kindwork = $_GET['variable2'];

$tarea = new Database($db);//Por Validar
$sqlTarea = "select * from tareas where id_tareas = $kindwork";
$resultTarea = $db->query($sqlTarea);
$resultTarea->setFetchMode(PDO::FETCH_ASSOC);
$fila = $resultTarea->fetch();
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
                          <li><a href="../">Login</a></li>
                          <li><a href="../tareas/workflowpaginaprincipal.php?id=<?php echo $id;?>">WorkFlow</a></li>
                          <li><a href="../tareas/WorkflowCreacionDeTarea.php?id=<?php echo $id;?>">Crear tarea</a></li>
                          <li><a href="../paginaprincipal.php?id=<?php echo $id;?>">Pagina principal</a></li>

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

                        <?php if( $fila['Tipo'] == 1){?>
                            <p class="form-control" disabled> Reunión para documento </p>
                            <?php } ?>

                                <?php if( $fila['Tipo'] == 2){?>
                                    <p class="form-control" disabled> Solicitud de actualización de proceso </p>
                                    <?php } ?>

                                        <?php if( $fila['Tipo'] == 3){?>
                                            <p class="form-control" disabled> Solicitud de nuevo proceso </p>
                                            <?php } ?>

                                                <?php if( $fila['Tipo'] == 4){?>
                                                    <p class="form-control" disabled> Interpretación de normas y procesos </p>
                                                    <?php } ?>

                                                        <?php if( $fila['Tipo'] == 5){?>
                                                            <p class="form-control" disabled> Consulta </p>
                                                            <?php } ?>

                                                                <p>
                                                                    <br>Fecha inicio</p>
                                                                <p class="form-control" disabled>
                                                                    <?php echo $fila['Fechaestimada'];?>
                                                                </p>
                    </div>
                    <div class="col-sm-6 banner-image">

                        <p>Prioridad</p>
                        <?php if( $fila['Prioridad'] == 1){?>
                            <p class="form-control" disabled> Alta </p>
                            <?php } ?>

                                <?php if( $fila['Prioridad'] == 2){?>
                                    <p class="form-control" disabled> Baja </p>
                                    <?php } ?>

                                                <p>
                                                    <br>Fecha Aceptada</p>
                                                <p class="form-control" disabled>
                                                    <?php echo $fila['Fechaoficial'];?>
                                                </p>

                    </div>

                    <div class="col-sm-6 banner-image">
                        <p>Nombre de la tarea</p>
                        <p class="form-control" disabled>
                            <?php echo $fila['NombreTarea'];?>
                        </p>
                    </div>

                    <div class="form-group">
                        <label for="inputlg">
                            <br>
                            <br>
                            <br>
                        </label>
                        <form action="/action_page.php">
                            <textarea class="form-control input-lg" name="message" rows="10" cols="30" placeholder="Descripcion" disabled><?php echo $fila['Descripcion'];?></textarea>
                            <br>
                        </form>
                    </div>

                    <a class="btn btn-first" href="../tareas/workflowpaginaprincipal.php?id=<?php echo $id;?>">Cancelar</a>

                    <?php
if($kind == 1){ //Ver Tarea?>

                        <a href="../tareas/WorkflowModificacionDeTarea.php?variable=<?php echo $kindwork; ?>&id=<?php echo $id;?>">
                            <button type="submit" class="button">Modificar</button>
                        </a>

                        <?php
}
?>

                            <?php
if($kind == 2){ //Validar Tarea?>

                                <a href="../tareas/WorkflowModificacionDeTarea.php?variable=<?php echo $kindwork; ?>&id=<?php echo $id;?>">
                                    <button type="submit" class="button">Modificar</button>
                                </a>

                                <a href="../tareas/ManageWorkflow.php?id=<?php echo $id;?>&uno=1&dos=<?php echo $kindwork; ?>">
                                    <button type="submit" class="button"> Validar </button>
                                </a>

                                <?php
}
?>

                                    <?php
if($kind == 3){ //Finalizar Tarea?>

                                        <a href="../tareas/WorkflowModificacionDeTarea.php?variable=<?php echo $kindwork; ?>&id=<?php echo $id;?>">
                                            <button type="submit" class="button">Modificar</button>
                                        </a>

                                        <a href="../tareas/ManageWorkflow.php?id=<?php echo $id;?>&uno=2&dos=<?php echo $kindwork; ?>">
                                            <button type="submit" class="button"> Finalizar </button>
                                        </a>

                                        <?php
}
?>

                </div>
            </div>
        </header>
        <?php
} else {
    echo "You don't have permission to acces this page.";
}
 ?>
</body>

</html>
