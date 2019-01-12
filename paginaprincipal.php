<html>

<head>

        <title>Gestor de documentos pagina principal</title>
        <link rel="stylesheet" type="text/css" href="css/style.css"/>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

  <?php

  include_once 'clases/database.php';
  include_once 'clases/user.php';
  include_once 'clases/documento.php';
  session_start();
  $database = new Database();
  $db = $database->getConnection();
  $user = new User($db);
  $document = new Documento($db);

  // $sql = 'SELECT * from documentos;';
  // $result = $db->query($sql);
  // $result->setFetchMode(PDO::FETCH_ASSOC);


  if (!empty($_SESSION['id'])) {
      //$arrayuser=$user->getUser($_SESSION['id']);

      $user=$user->getUser($_SESSION['id']);
      $sql2 = 'SELECT Idrango, ID_usuarios from Usuarios where Usuario="'.$user['Usuario'].'";';
      $result2 = $db->query($sql2);
      $result2->setFetchMode(PDO::FETCH_ASSOC);
      $fila2 = $result2->fetch();
      $_SESSION['rol']=$fila2['Idrango'];
      $_SESSION['oldusercreacion']=$fila2['ID_usuarios'];

      //$user->unserialize($ser);
      $result=$document->getDocumentsPerUser($fila2['Idrango']);
  }

      if (!empty($user['Usuario'])) {
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
             <a href="paginaprincipal.php"> <img class="logo" src="images/logo.png"></a>
         </div>
         <div class="collapse navbar-collapse" id="micon">
         <ul class="nav navbar-nav navbar-right">
         <li><a href="sessiondestroy.php" type="button"><?php echo $user['Usuario']; ?> LOGOUT</a></li>
         <li><a href="tareas/workflowpaginaprincipal.php?id=<?php echo $fila2['ID_usuarios']; ?>">WorkFlow </a></li>



         </ul>
        </div>
     </div>
 </nav>

 <div class="container">
 <div class="row">
  <div class="col-sm-6 banner-info">
    <?php if ($_SESSION['rol']==1 || $_SESSION['rol']==666) {
              ?>
     <h2>Buscador</h2>
  <div class="panel panel-default">
    <div class="panel-body">
      <div class="search-container">
         <form action="buscador.php">
           <input type="text" placeholder="Search.." name="search">
           <button type="submit">Submit</button>
         </form>
       </div>
    </div>
  </div>

  <?php
          } ?>

   </div>

   <div class="col-sm-6 banner-info">
   <a class="btn btn-second" href="usuario/modificarusuario.php?id=<?php echo $fila2['ID_usuarios']; ?>">Modificar usuario</a>


        <?php if ($_SESSION['rol']==1 || $_SESSION['rol']==666) {
              ?>
          <a class="btn btn-first" href="usuario/master.php">Acceder Super Usuario</a>
     <a class="btn btn-second" href="usuario/crearusuario.php">Crear Usuario</a>
      <a class="btn btn-second" href="gestordocumentos/subirdocumento.php">Añadir nuevo documento</a>
      <?php
          } ?>
   </div>
 </div>
 <div class="row">
  <div class="col-sm-6 banner-info" style="background-color:lavender;">

      <h2>Documentos Disponibles</h2>

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

    if ($result) {
        while ($fila = $result->fetch()) {
            if (!empty($fila)&&$fila['Estado']==1) {
                ?>
              <tr>
                 <td><a href="gestordocumentos/gdpaginaprincipal.php?iddoc=<?php echo $fila['ID_documentos']."&id=".$fila2['ID_usuarios']; ?>"><?php echo $fila['Nombre del documento']; ?></a></td>
                 <td><?php echo $document->getCodeDocument($fila['ID_documentos'])['descripcion']; ?></td>
                 <td><?php echo $fila['Version']; ?></td>
                  <td><a href="<?php
$name= substr($fila['Link'], 14);
                echo $name; ?>" download>Descargar</a></td>
              </tr>
             <?php
            }
        }
    } ?>
           </tbody>
           </table>



  </div>
  <div class="col-sm-6 banner-info" style="background-color:lavenderblush;">

      <h2>Ultimas modificaciones</h2>

      <table class="table">
        <thead>
          <tr>
            <th>Nombre</th>
            <th>Fecha</th>
            <th>Hora</th>
            <th>Descripcion</th>
          </tr>
        </thead>
        <tbody>
          <?php


          $resultlatest=$document->getLatestDocuments();

          while ($filalatest=$resultlatest->fetch()) {
              ?>
          <tr>
            <td><?php  echo $filalatest['id_documento']; ?></td>
            <td><?php  echo $filalatest['fecha']; ?></td>
            <td><?php  echo $filalatest['hora']; ?></td>
            <td><?php  echo $filalatest['Descripcion']; ?></td>
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
