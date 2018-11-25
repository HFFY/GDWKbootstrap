<html>

<head>

        <title>Gestor de documentos pagina principal</title>
        <link rel="stylesheet" type="text/css" href="../css/style.css"/>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
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
  $document = new Documento($db);
  $sqlD = 'select * from documentos;';
   $resultD = $db->query($sqlD);
   $resultD->setFetchMode(PDO::FETCH_ASSOC);



  if (!empty($_SESSION['ser'])) {
      $user->unserialize($_SESSION['ser']);
      $sql2 = 'select Idrango from usuarios where usuario="'.$user->username.'";';
      $result2 = $db->query($sql2);
      $result2->setFetchMode(PDO::FETCH_ASSOC);
      $fila2 = $result2->fetch();

      // $_SESSION['rol']=$fila2['Idrango'];
      // //$user->unserialize($ser);
      //
      // echo $user->username;
  }
    if ($_SESSION['rol']=="1"||$_SESSION['rol']=="666") {
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
             <a href="../paginaprincipal.php"> <img class="logo" src="../images/logo.png"></a>
         </div>
         <div class="collapse navbar-collapse" id="micon">
         <ul class="nav navbar-nav navbar-right">
         <li><a href="../sessiondestroy.php" type="button"><?php echo $user->username; ?></a></li>
         <li><a href="">WorkFlow </a></li>
         <li><a href="">Añadir Documento</a></li>
         <li><a href="">Modificar Documento</a></li>

         </ul>
        </div>
     </div>
 </nav>

 <div class="container">

 <div class="row">
  <div class="col-sm-6 banner-info" style="background-color:lavender;">

      <h2>Usuarios</h2>

           <table class="table table-striped table-bordered  table-responsive-sm  scrollbar">
           <thead  class="thead-dark">
             <tr>
               <th style="width: 25%">Nombre</th>
               <th style="width: 25%">Rol</th>
               <th style="width: 25%">Estado</th>
               <th style="width: 25%">Modificar</th>

             </tr>
           </thead>
           <tbody>
              <?php
        while ($fila = $result->fetch()) {
            // echo $_POST['AD'.$fila['ID_usuarios']];

            if ($_SERVER['REQUEST_METHOD']=="POST" && isset($_POST['AD'.$fila['ID_usuarios']])) {
                if ($fila['Estado']==1) {
                    $user->setUserDeactivated($fila['ID_usuarios']);
                    header("Refresh:0");
                    unset($_POST['AD'.$fila['ID_usuarios']]);
                } else {
                    $user->setUserActivated($fila['ID_usuarios']);
                    header("Refresh:0");
                    unset($_POST['AD'.$fila['ID_usuarios']]);
                }
                // header("Refresh:0");
            }

            if ($fila['Idrango']!='666') {
                ?>
              <tr>
                 <td><?php echo $fila['Nombres']; ?></td>
                 <td><?php
                 $dumvar=$user->getDescriptionRango($fila['Idrango']);
                echo $dumvar['Descripcion']; ?></td>

                 <td>

                        <form  method="post" >
                            <input type="submit" class="button" name="AD<?php
                            echo $fila['ID_usuarios']?>"
                              value="<?php

                                if ($fila['Estado']==1) {
                                    echo "Activado";
                                } else {
                                    echo "Desactivado";
                                } ?>"
                                />

                          </form>
                 </td>
                 <?php
               ?>


               <td><a href="modificarusuario.php?id=<?php echo $fila['ID_usuarios']; ?>">

                 Modificar usuario</a></td>
              </tr>
             <?php
            }
        } ?>
           </tbody>
           </table>



  </div>
  <div class="col-sm-6 banner-info" style="background-color:lavenderblush;">

      <h2>Documentos</h2>

      <table class="table table-striped table-bordered  table-responsive-sm  scrollbar">
      <thead  class="thead-dark">
        <tr>
          <th style="width: 25%">Nombre</th>
          <th style="width: 25%">Codigo</th>
          <th style="width: 25%">Version</th>
          <th style="width: 25%">Link</th>

        </tr>
      </thead>
      <tbody>
         <?php

          while ($filaD = $resultD->fetch()) {
              $descripcioncodigo=$document->getCodeDocument($filaD['ID_documentos']); ?>
         <tr>
            <td><?php echo $filaD['Nombre del documento']; ?></td>
            <td><?php echo $descripcioncodigo['descripcion']; ?></td>
            <td><?php echo $filaD['Version']; ?></td>
             <td><a href="<?php echo $filaD['Link']; ?>">

               Descargar</a></td>
         </tr>
        <?php
          } ?>
      </tbody>
      </table>

  </div>

</div>
 </div>
</header>


<?php
    } else {
        echo "You don't have permission to view this page.";
    }



 ?>
</body>

</html>
