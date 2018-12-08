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
  // usar documentospor rango para mostrar al inicio
  // anadir tickbox to select wich users can use certain documents
  include_once '../clases/database.php';
  include_once '../clases/user.php';
  include_once '../clases/documento.php';

  session_start();
  $variduser=$_GET['id'];
  $variddoc=$_GET['iddoc'];
  echo $_GET['id'];
  $database = new Database();
  $db = $database->getConnection();
  $user = new User($db);
  $document= new Documento($db);
  $sql = 'select * from documentos;';
  $result = $db->query($sql);
  $result->setFetchMode(PDO::FETCH_ASSOC);
  // $sqlasd = "INSERT into documentos VALUES (null, '1', '1','1','1','documentoprueba','1.5','pedro',
  //   'pedra','hola','hola','15/25','12/89','todas','todos','documento hola','1');";
  // $resultasd = $db->query($sqlasd);
  // $resultasd->setFetchMode(PDO::FETCH_ASSOC);
  // $filaasd = $resultasd->fetch();
   $iddoc=$variddoc;
   $filadoc=$document->getDocument($iddoc);
   $user->username= $user->getUser($variduser)['Usuario'];
   $user->id= $user->getUser($variduser)['Idrango'];

      // $user->unserialize($_SESSION['ser']);
      // $sql2 = 'select Idrango, ID_usuarios from usuarios where usuario="'.$user->username.'";';
      // $result2 = $db->query($sql2);
      // $result2->setFetchMode(PDO::FETCH_ASSOC);
      // $fila2 = $result2->fetch();
      // $_SESSION['rol']=$fila2['Idrango'];
      // $_SESSION['oldusercreacion']=$fila2['ID_usuarios'];


     $r = $document->getDifferentVersions($filadoc['Nombre del documento']);

     $r2 = $document->getDifferentVersions($filadoc['Nombre del documento']);



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
         <li><a href="../sessiondestroy.php" type="button"><?php echo $user->username  ?> LOGOUT</a></li>
         <li><a href="../tareas/workflowpaginaprincipal.php">WorkFlow </a></li>



         </ul>
        </div>
     </div>
 </nav>

 <div class="container">
 <div class="row">


   <div class="col-sm-4 banner-info">

     <a class="btn btn-first" href="actualizardocumento.php?iddoc=<?php echo $iddoc."&id=".$_GET['id']; ?>">Actualizar</a>
      </div>
       <div class="col-sm-4 banner-info">
     <a class="btn btn-second" href="enabledisabledoc.php?iddoc=<?php echo $iddoc."&id=".$_GET['id'];?>"><?php if ($filadoc['Estado']=='1') {
              echo "Desactivar";
          } else {
              echo "Activar";
          }  ?></a>
      </div>
 <div class="col-sm-4 banner-info">
     <a class="btn btn-second" href="modificardocumento.php?iddoc=<?php echo $iddoc."&id=".$_GET['id']; ?>">Modificar</a>
</div>
 </div>
 <div class="row">
  <div class="col-sm-6 banner-info" style="background-color:lavenderblush;">

      <h2>Documentos Disponibles</h2>

           <table class="table table-striped table-bordered  table-responsive-sm  scrollbar">
           <thead  class="thead-dark">
             <tr>
               <th style="width: 33%">Nombre</th>
               <th style="width: 33%">Version</th>
               <th style="width: 33%">Link</th>

             </tr>
           </thead>
           <tbody>

              <?php


              while ($f = $r->fetch()) {
                  ?>
              <tr>
                 <td><?php echo $f['Nombre del documento']; ?></td>
                 <td><?php echo $f['Version']; ?></td>
                 <td><?php echo $f['Link']; ?></td>

              </tr>
             <?php
              }
               ?>
           </tbody>
           </table>



  </div>
  <div class="col-sm-6 banner-info" style="background-color:lavenderblush;">

      <h2>Descripciones</h2>

      <table class="table">
        <thead>
          <tr>
            <th style="width: 50%">Nombre</th>
            <th style="width: 50%">Descripcion</th>


          </tr>
        </thead>
        <tbody>
          <?php


          while ($f2 = $r2->fetch()) {
              ?>
          <tr>
             <td><?php echo $f2['Nombre del documento']; ?></td>
             <td><?php echo $f2['Descripción']; ?></td>


          </tr>
         <?php
          }
           ?>

        </tbody>
      </table>

  </div>

</div>
 </div>
</header>


<?php
      // } else {
      //     echo "You don't have permission to view this page.";
      // }
 ?>
</body>

</html>
