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
  $sql = 'SELECT * from Usuarios;';
  $result = $db->query($sql);
  $result->setFetchMode(PDO::FETCH_ASSOC);
  $document = new Documento($db);
  $sqlD = 'SELECT * from Documentos;';
   $resultD = $db->query($sqlD);
   $resultD->setFetchMode(PDO::FETCH_ASSOC);



  if (!empty($_SESSION['ser'])) {
      $user->unserialize($_SESSION['ser']);
      $sql2 = 'SELECT Idrango, ID_usuarios from Usuarios where usuario="'.$user->username.'";';
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
         <li><a href="../sessiondestroy.php" type="button"><?php echo $user->username; ?> LOGOUT</a></li>

         <li><a href="../tareas/workflowpaginaprincipal.php">WorkFlow </a></li>
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
              while($fila=$result->fetch()){

                if ($_SERVER['REQUEST_METHOD']=="POST" && isset($_POST[$fila['ID_usuarios']])) {
                    if ($fila['Estado']==1) {
                        $user->setUserDeactivated($fila['ID_usuarios']);

                        unset($_POST['AD'.$fila['ID_usuarios']]);
                        header("Refresh:0");
                    } else {
                        $user->setUserActivated($fila['ID_usuarios']);

                        unset($_POST['AD'.$fila['ID_usuarios']]);
                         header("Refresh:0");
                    }
                    //header("Refresh:0");
                }
              }

        $result = $db->query($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        while ($fila = $result->fetch()) {
            // echo $_POST['AD'.$fila['ID_usuarios']];



            if ($fila['Idrango']!='666') {
                ?>
              <tr>
                 <td><?php echo $fila['Nombres']; ?></td>
                 <td><?php
                 $dumvar=$user->getDescriptionRango($fila['Idrango']);
                echo $dumvar['Descripcion']; ?></td>

                 <td>

                        <form  method="post" >
                            <input type="submit" class="button" name="<?php
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
        }


        ?>
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
            <td><a  href="../gestordocumentos/gdpaginaprincipal.php?iddoc=<?php echo $filaD['ID_documentos']."&id=".$fila2['ID_usuarios']; ?>"><?php echo $filaD['Nombre del documento']; ?></a></td>
            <td><?php echo $descripcioncodigo['descripcion']; ?></td>
            <td><?php echo $filaD['Version']; ?></td>
            <td><a href="<?php
$name= "../".substr($filaD['Link'], 14);
              echo $name; ?>" download>Descargar</a></td>
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
