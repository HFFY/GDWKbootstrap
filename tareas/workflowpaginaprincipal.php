<html>

<head>
    <title>Gestor de documentos página principal</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
    $id=$_GET['id'];
    $rol=$_SESSION['rol'];
    $db = $database->getConnection();
    $user = new User($db);

    if (!empty($_SESSION['id']) && $_SESSION['id']==$id) {
        $verificartarea = new Ticket($db);
        $verificartarea-> comprobarDateTarea();

        if ($rol==1||$rol==666) {
            // $sql = 'SELECT * from Usuarios;';
            // $result = $db->query($sql);
            // $result->setFetchMode(PDO::FETCH_ASSOC);
            $tarea = new Ticket($db);//Por Validar
            $sqlTareaCero = "SELECT * from Tareas where Estado='1';";
            $resultTareaCero = $db->query($sqlTareaCero);
            $resultTareaCero->setFetchMode(PDO::FETCH_ASSOC);

            $sqlTareaUno = "SELECT * from Tareas where Estado='2';";
            $resultTareaUno = $db->query($sqlTareaUno);
            $resultTareaUno->setFetchMode(PDO::FETCH_ASSOC);

            $sqlTareaDos = "SELECT * from Tareas where Estado='3';";
            $resultTareaDos = $db->query($sqlTareaDos);
            $resultTareaDos->setFetchMode(PDO::FETCH_ASSOC);

            $sqlTareaTres = "SELECT * from Tareas where Estado='4';";
            $resultTareaTres = $db->query($sqlTareaTres);
            $resultTareaTres->setFetchMode(PDO::FETCH_ASSOC);
            $tareasPopUp = $db->query($sqlTareaTres);
            $tareasPopUp->setFetchMode(PDO::FETCH_ASSOC);
            $tareasPopUp2 = $db->query($sqlTareaTres);
            $tareasPopUp2->setFetchMode(PDO::FETCH_ASSOC);
        } else {
            $sqlTareaCero = "SELECT * from Tareas where Id_usuario='$id' and Estado='1';";
            $resultTareaCero = $db->query($sqlTareaCero);
            $resultTareaCero->setFetchMode(PDO::FETCH_ASSOC);

            $sqlTareaUno = "SELECT * from Tareas where Id_usuario='$id' and Estado='2';";
            $resultTareaUno = $db->query($sqlTareaUno);
            $resultTareaUno->setFetchMode(PDO::FETCH_ASSOC);

            $sqlTareaDos = "SELECT * from Tareas where Id_usuario='$id' and Estado='3';";
            $resultTareaDos = $db->query($sqlTareaDos);
            $resultTareaDos->setFetchMode(PDO::FETCH_ASSOC);

            $sqlTareaTres = "SELECT * from Tareas where Id_usuario='$id' and Estado='4';";
            $resultTareaTres = $db->query($sqlTareaTres);
            $resultTareaTres->setFetchMode(PDO::FETCH_ASSOC);
            $tareasPopUp = $db->query($sqlTareaTres);
            $tareasPopUp->setFetchMode(PDO::FETCH_ASSOC);
        } ?>

        <header class="header">


<?php if ($filaRetrasados = $tareasPopUp->fetch() && ($rol==1||$rol==666)) {
            ?>
  <button type="hidden" id="modal" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter" style="display: none;"> Invisible </button>
          <script>
            jQuery(function(){
              jQuery('#modal').click();
           });
          </script>

          <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header" style="background-color:#FF0000;">
                  <h5 class="modal-title" id="exampleModalLongTitle"><font color="white" size="5">
                    Tienes las siguientes tareas retrasadas:
                  </font>
                </h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="background-color:#FF0000;">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body"><font color="red" size="5">
                  <?php while ($filaRetrasados2 = $tareasPopUp2->fetch()) {
                echo $filaRetrasados2 ['NombreTarea'];
                echo "    Fecha límite:  ";
                echo $filaRetrasados2['Fechaoficial'];
                echo "<br>";
            } ?>
                    </font>
                </div>
                <div class="modal-footer">
                  <button class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
          </div>

<?php
        } ?>
            <nav class="navbar navbar-style">
                <div class="container">
                    <div class="navbar-header ">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#micon">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a href="../paginaprincipal.php?id=<?php echo $id; ?>"> <img class="logo" src="../images/logo.png"></a>
                    </div>
                    <div class="collapse navbar-collapse" id="micon">
                        <ul class="nav navbar-nav navbar-right">
                          <li><a href="../sessiondestroy.php">Logout</a></li>

                          <li><a href="../tareas/WorkflowCreacionDeTarea.php?id=<?php echo $id; ?>">Crear tarea</a></li>
                          <li><a href="../paginaprincipal.php?id=<?php echo $id; ?>">Página principal</a></li>

                        </ul>
                    </div>
                </div>
            </nav>
            <div class="container">
                <div class="row">
                    <p class="big-text">WorkFlow</p>
                </div>
            </div>
            <div class="container">
                <a href="../tareas/WorkflowCreacionDeTarea.php?id=<?php echo $id; ?>">
                    <button type="submit" class="button">Crear tarea</button>
                </a>
            </div>

            <div class="container" style="width:1450px;">
                <div class="row">
                    <div class="col-sm-6 banner-info" id="div1" style="width:700px; height:300px; overflow:auto;">
                        <h4 class="text-center font-eight-bold">Pendiente de validación</h4>
                        <table class="table table-striped table-bordered  table-responsive-sm  scrollbar" style="background-color:powderblue;">
                            <thead class="thead-dark">
                                <tr>
                                    <th style="width: 70%">Nombre</th>
                                    <th style="width: 15%"></th>
                                    <th style="width: 15%"></th>

                                </tr>
                            </thead>

                            <tbody class="thead-dark">
                                <?php
                           while ($filaCero = $resultTareaCero->fetch()) {
                               ?>
                                    <tr>
                                        <td>
                                          <?php $idtarea = $filaCero['id_tareas']; ?>
                                            <a href="../tareas/WorkflowVerTarea.php?variable1=1&variable2=<?php echo $idtarea; ?>&id=<?php echo $id; ?>">
                                                <?php echo $filaCero['NombreTarea']; ?>
                                            </a>
                                        </td>


                                        <td align="center">
                                            <a href="../tareas/WorkflowVerTarea.php?variable1=2&variable2=<?php echo $idtarea; ?>&id=<?php echo $id; ?>">
                                              <?php
                                              if ($rol==1||$rol==666) {
                                                  ?>
                                      <button type="submit" value="<?php echo $filaCero['id_tareas']; ?>" > Validar </button>
                                      <?php
                                              } ?>
                                      </a>
                                        </td>

                                        <td align="center">
                                            <a href="../tareas/WorkflowModificacionDeTarea.php?variable=<?php echo $idtarea; ?>&id=<?php echo $id; ?>">
                                              <?php
                                              if ($rol==1||$rol==666) {
                                                  ?>
                                    <button type="submit" value="<?php echo $filaCero['id_tareas']; ?>" > Modificar </button>
                                    <?php
                                              } ?>
                                  </a>
                                        </td>

                                    </tr>
                                    <?php
                           } ?>
                            </tbody>

                        </table>
                    </div>

                    <div class="col-sm-6 banner-info" id="div1" style="width:700px; height:300px; overflow:auto;">
                        <h4 class="text-center font-eight-bold">En Ejecución</h4>
                        <table class="table table-striped table-bordered  table-responsive-sm  scrollbar" style="background-color:#F7FE2E;">
                            <thead class="thead-dark">
                                <tr>
                                    <th style="width: 70%">Nombre</th>
                                    <th style="width: 15%"></th>
                                    <th style="width: 15%"></th>

                                </tr>
                            </thead>
                            <tbody class="thead-dark">
                                <?php
                           while ($filaUno = $resultTareaUno->fetch()) {
                               ?>
                                    <tr>
                                      <?php $idtarea = $filaUno['id_tareas']; ?>
                                        <td>
                                            <a href="../tareas/WorkflowVerTarea.php?variable1=1&variable2=<?php echo $idtarea; ?>&id=<?php echo $id; ?>">
                                                <?php echo $filaUno['NombreTarea']; ?>
                                            </a>
                                        </td>
                                        <?php

                                            ?>
                                        <td align="center">
                                            <a href="../tareas/WorkflowVerTarea.php?variable1=3&variable2=<?php echo $idtarea; ?>&id=<?php echo $id; ?>">
                                              <?php
                                              if ($rol==1||$rol==666) {
                                                  ?>
                                    <button type="submit" value="<?php echo $filaUno['id_tareas']; ?>" > Terminar </button>
                                    <?php
                                              } ?>
                                  </a>
                                        </td>
                                        <td align="center">
                                            <a href="../tareas/WorkflowModificacionDeTarea.php?variable=<?php echo $idtarea; ?>&id=<?php echo $id; ?>">
                                              <?php
                                              if ($rol==1||$rol==666) {
                                                  ?>
                                    <button type="submit" value="<?php echo $filaUno['id_tareas']; ?>" > Modificar </button>
                                  <?php
                                              } ?>
                                  </a>
                                        </td>

                                    </tr>
                                    <?php
                           } ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="col-sm-6 banner-info" id="div1" style="width:700px; height:300px; overflow:auto;">
                        <h4 class="text-center font-eight-bold">Retrasados</h4>
                        <table class="table table-striped table-bordered  table-responsive-sm  scrollbar" style="background-color:#FF0000;">
                            <thead class="thead-dark">
                                <tr>
                                    <th style="width: 70%">Nombre</th>
                                    <th style="width: 15%"></th>
                                    <th style="width: 15%"></th>

                                </tr>
                            </thead>
                            <tbody class="thead-dark">
                                <?php
                           while ($filaTres = $resultTareaTres->fetch()) {
                               ?>
                                    <tr>
                                      <?php $idtarea = $filaTres['id_tareas']; ?>
                                        <td>
                                            <a href="../tareas/WorkflowVerTarea.php?variable1=1&variable2=<?php echo $idtarea; ?>&id=<?php echo $id; ?>">
                                                <?php echo $filaTres['NombreTarea']; ?>
                                            </a>
                                        </td>

                                        <td align="center">
                                            <a href="../tareas/WorkflowVerTarea.php?variable1=3&variable2=<?php echo $idtarea; ?>&id=<?php echo $id; ?>">
                                              <?php
                                              if ($rol==1||$rol==666) {
                                                  ?>
                                    <button type="submit" value="<?php echo $filaTres['id_tareas']; ?>" herf = ""> Finalizar </button>
                                    <?php
                                              } ?>
                                  </a>
                                        </td>
                                        <td align="center">
                                            <a href="../tareas/WorkflowModificacionDeTarea.php?variable=<?php echo $idtarea; ?>&id=<?php echo $id; ?>">
                                              <?php
                                              if ($rol==1||$rol==666) {
                                                  ?>
                                    <button type="submit" value="<?php echo $filaTres['id_tareas']; ?>" > Modificar </button>
                                    <?php
                                              } ?>
                                  </a>
                                        </td>
                                    </tr>
                                    <?php
                           } ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="col-sm-6 banner-info" id="div1" style="width:700px; height:300px; overflow:auto;">
                        <h4 class="text-center font-eight-bold">Resueltos</h4>
                        <table class="table table-striped table-bordered  table-responsive-sm  scrollbar" style="background-color:#01DF01;">
                            <thead class="thead-dark">
                                <tr>
                                    <th style="width: 65%">Nombre</th>
                                    <th style="width: 20%">Finalizada</th>
                                    <th style="width: 15%"></th>

                                </tr>
                            </thead>
                            <tbody class="thead-dark">
                                <?php
                              while ($filaDos = $resultTareaDos->fetch()) {
                                  ?>
                                    <tr>
                                      <?php $idtarea = $filaDos['id_tareas']; ?>
                                        <td>
                                            <a href="../tareas/WorkflowVerTarea.php?variable1=1&variable2=<?php echo $idtarea; ?>&id=<?php echo $id; ?>">
                                                <?php echo $filaDos['NombreTarea']; ?>
                                            </a>
                                        </td>

                                        <td>
                                            <?php echo $filaDos['Fechaoficial']; ?>
                                        </td>
                                        <td align="center">
                                            <a href="../tareas/WorkflowModificacionDeTarea.php?variable=<?php echo $idtarea; ?>&id=<?php echo $id; ?>">
                                              <?php
                                              if ($rol==1||$rol==666) {
                                                  ?>
                                       <button type="submit" value="<?php echo $filaDos['id_tareas']; ?>" > Modificar </button>
                                       <?php
                                              } ?>
                                     </a>
                                        </td>
                                    </tr>
                                    <?php
                              } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

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
