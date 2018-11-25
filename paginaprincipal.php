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
  $sql = 'select * from documentos;';
  $result = $db->query($sql);
  $result->setFetchMode(PDO::FETCH_ASSOC);
  // $sqlasd = "INSERT into documentos VALUES (null, '1', '1','1','1','documentoprueba','1.5','pedro',
  //   'pedra','hola','hola','15/25','12/89','todas','todos','documento hola','1');";
  // $resultasd = $db->query($sqlasd);
  // $resultasd->setFetchMode(PDO::FETCH_ASSOC);
  // $filaasd = $resultasd->fetch();


  if (!empty($_SESSION['ser'])) {
      $user->unserialize($_SESSION['ser']);
      $sql2 = 'select Idrango, ID_usuarios from usuarios where usuario="'.$user->username.'";';
      $result2 = $db->query($sql2);
      $result2->setFetchMode(PDO::FETCH_ASSOC);
      $fila2 = $result2->fetch();
      $_SESSION['rol']=$fila2['Idrango'];
      $_SESSION['oldusercreacion']=$fila2['ID_usuarios'];
      //$user->unserialize($ser);

      echo $user->username;
  }
      if (!empty($user->username)) {
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
         <li><a href="sessiondestroy.php" type="button"><?php echo $user->username; ?> LOGOUT</a></li>
         <li><a href="../tareas/workflowpaginaprincipal.php">WorkFlow </a></li>
         <li><a href="gestordocumentos/gdpaginaprincipal.php?id=<?php echo $fila2['ID_usuarios']; ?>">Gestor de documentos</a></li>


         </ul>
        </div>
     </div>
 </nav>

 <div class="container">
 <div class="row">
  <div class="col-sm-6 banner-info">
     <h2>Buscador</h2>
  <div class="panel panel-default">
    <div class="panel-body">
      <div class="search-container">
         <form action="/action_page.php">
           <input type="text" placeholder="Search.." name="search">
           <button type="submit">Submit</button>
         </form>
       </div>
    </div>
  </div>



   </div>

   <div class="col-sm-6 banner-info">
     <a class="btn btn-first" href="usuario/master.php">Acceder Super Usuario</a>
     <a class="btn btn-second" href="usuario/modificarusuario.php?id=<?php echo $fila2['ID_usuarios']; ?>">Modificar usuario</a>
     <a class="btn btn-second" href="usuario/crearusuario.php">Crear Usuario</a>
      <a class="btn btn-second" href="gestordocumentos/subirdocumento.php">Añadir nuevo documento</a>
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
              <?php   while ($fila = $result->fetch()) {
              ?>
              <tr>
                 <td><a href="gestordocumentos/gdpaginaprincipal.php?iddoc=<?php echo $fila['ID_documentos']."&id=".$fila2['ID_usuarios']; ?>"><?php echo $fila['Nombre del documento']; ?></a></td>
                 <td><?php echo $document->getCodeDocument($fila['ID_documentos'])['descripcion']; ?></td>
                 <td><?php echo $fila['Version']; ?></td>
                  <td>Link</td>
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

      <h2>Ultimas modificaciones</h2>

      <table class="table">
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
                <td>Johnasdas</td>
          </tr>
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
