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
  session_start();
  $database = new Database();
  $db = $database->getConnection();
  $user = new User($db);
  $sql = 'select * from usuarios;';
  $result = $db->query($sql);
  $result->setFetchMode(PDO::FETCH_ASSOC);
  $sqlD = 'select * from documentos;';
  $resultD = $db->query($sqlD);
  $resultD->setFetchMode(PDO::FETCH_ASSOC);



  if (!empty($_SESSION['ser'])) {
      $user->unserialize($_SESSION['ser']);
      $sql2 = 'select Idrango from usuarios where usuario="'.$user->username.'";';
      $result2 = $db->query($sql2);
      $result2->setFetchMode(PDO::FETCH_ASSOC);
      $fila2 = $result2->fetch();
      $_SESSION['rol']=$fila2['Idrango'];
      //$user->unserialize($ser);

      echo $user->username;
  }
      if (!empty($user->username)) {
          echo $user->username; ?>

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
         <li><a href="sessiondestroy.php" type="button"><?php echo $user->username; ?></a></li>
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
               <th style="width: 25%">Codigo</th>
               <th style="width: 25%">Version</th>
               <th style="width: 25%">Link</th>

             </tr>
           </thead>
           <tbody>
              <?php   while ($fila = $result->fetch()) {
              ?>
              <tr>
                 <td><?php echo $fila['Usuario']; ?></td>
                 <td>Rol</td>
                 <td>Eliminar</td>
                  <td>Modificar</td>
              </tr>
             <?php
          } ?>
           </tbody>
           </table>

      <!-- <table class="table">
        <thead>
          <tr>
            <th>Nombre</th>
            <th>Codigo</th>
            <th>Version</th>
            <th>Link</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>1</td>
            <td>Anna</td>
            <td>Anna</td>
            <td>Anna</td>
          </tr>
          <tr>
            <td>2</td>
            <td>Debbie</td>
            <td>Debbie</td>
            <td>Debbie</td>
          </tr>
          <tr>
            <td>3</td>
            <td>John</td>
              <td>John</td>
                <td>John</td>
          </tr>
        </tbody>
      </table> -->

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
         <?php   while ($fila = $result->fetch()) {
              ?>
         <tr>
            <td><?php echo $fila['Nombre del documento']; ?></td>
            <td>Codigo</td>
            <td><?php echo $fila['Version']; ?></td>
             <td>Link</td>
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
