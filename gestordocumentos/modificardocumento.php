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

  // get database connection
  include_once '../clases/database.php';

  // instantiate user object
  include_once '../clases/user.php';
    include_once '../clases/documento.php';
  session_start();


  if ($_SESSION['rol']=="1"||$_SESSION['rol']=="666") {
      $database = new Database();
      $db = $database->getConnection();

      $user = new User($db);
      $document = new Documento($db);
      $olduser=$user->getUser($_SESSION['oldusercreacion']);

      $filashowdoc=$document->getDocument($_GET['iddoc']);

      $document->Proceso = $filashowdoc['Proceso'];
      $document->Tipodedocumento = $filashowdoc['Tipo de documento'];
      $document->Numerodeldocumento = $filashowdoc['Numero del documento'];
      $document->Nombredeldocumento = $filashowdoc['Nombre del documento'];

      $document->Subproceso =$filashowdoc['Subproceso'];
      $document->Fechadeentradavigencia = $filashowdoc['Fecha de entrada vigencia'];
      $document->Fechadeentradaencaducidad = $filashowdoc['Fecha de entrada caducidad'];
      $document->Version = $filashowdoc['Version'];
      $document->Creador = $filashowdoc['Creador'];
      $document->Revisor = $filashowdoc['Revisor'];
      $document->Autorizador = $filashowdoc['Autorizador'];
      $document->Disenodelproceso = $filashowdoc['Diseño del proceso'];
      $document->Areasalasqueafecta = $filashowdoc['Areas a las que afecta'];
      $document->Registrosquecorresponden = $filashowdoc['Registros que corresponden'];

      $document->Descripcion = $filashowdoc['Descripción'];
      $document->Link = $filashowdoc['Link'];

      $document->usuariosauto = $document->getArrayUsuariosAuto($_GET['iddoc']);


      if ($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['crear'])) {
          $document->Proceso = !empty($_POST['Proceso']) ? $_POST['Proceso'] :   $filashowdoc['Proceso'];

          $document->Tipodedocumento = !empty($_POST['Tipodedocumento']) ? $_POST['Tipodedocumento'] : $document->Tipodedocumento;

          $document->Numerodeldocumento = !empty($_POST['Numerodeldocumento']) ? $_POST['Numerodeldocumento'] : $filashowdoc['Numero del documento'];

          $document->Nombredeldocumento = !empty($_POST['Nombredeldocumento']) ? $_POST['Nombredeldocumento'] : $filashowdoc['Nombre del documento'];

          // echo "asd";

          $document->Subproceso = !empty($_POST['Subproceso']) ? $_POST['Subproceso'] : $document->Subproceso;


          $document->Fechadeentradavigencia = !empty($_POST['Fechadeentradavigencia']) ? $_POST['Fechadeentradavigencia'] :  $document->Fechadeentradavigencia;

          $document->Fechadeentradaencaducidad = !empty($_POST['Fechadeentradaencaducidad']) ? $_POST['Fechadeentradaencaducidad'] : $document->Fechadeentradaencaducidad;

          $document->Version = !empty($_POST['Version']) ? $_POST['Version'] : $document->Version;

          $document->Creador = !empty($_POST['Creador']) ? $_POST['Creador'] : $document->Creador;

          $document->Revisor = !empty($_POST['Revisor']) ? $_POST['Revisor'] : $document->Revisor;

          $document->Autorizador = !empty($_POST['Autorizador']) ? $_POST['Autorizador'] : $document->Autorizador;

          $document->Disenodelproceso = !empty($_POST['Disenodelproceso']) ? $_POST['Disenodelproceso'] : $document->Disenodelproceso;

          $document->Areasalasqueafecta = !empty($_POST['Areasalasqueafecta']) ? $_POST['Areasalasqueafecta'] : $document->Areasalasqueafecta;

          $document->Registrosquecorresponden = !empty($_POST['Registrosquecorresponden']) ? $_POST['Registrosquecorresponden'] : $document->Registrosquecorresponden;

          $document->Descripcion = !empty($_POST['Descripcion']) ? $_POST['Descripcion'] : $document->Descripcion;

          $document->usuariosauto = !empty($_POST['usuariosauto']) ? $_POST['usuariosauto'] : $document->usuariosauto;
          // echo "asd";
          $my_folder = ".././uploads/";
          // $filePath = realpath($_FILES["myFile"]['tmp_name']);
          // $dumbvariable = pathinfo($_FILES['myFile']['tmp_name'], PATHINFO_EXTENSION);
          // echo $dumbvariable;
          if (move_uploaded_file($_FILES['myFile']['tmp_name'], $my_folder . $_FILES['myFile']['name'])) {
              //echo 'Received file' . $_FILES['myFile']['name'] . ' with size ' . $_FILES['myFile']['size'];
              // echo $_GET['iddoc'];
              $document->Link = "gdwkbootstrap/uploads/".basename($_FILES['myFile']['name']);
              $document->modifiedDocument($_GET['iddoc']);
          } else {
              echo 'Upload failed!';
              //
              // var_dump($_FILES['myFile']['error']);
          }

          // echo "hola";
      } ?>
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
  <li><a href="../sessiondestroy.php" type="button"><?php echo $olduser['Usuario']; ?> LOGOUT</a></li>
  <li><a href="../tareas/workflowpaginaprincipal.php">WorkFlow </a></li>

      </ul>
    </div>
  </div>
</nav>

<div class="container">
  <div class="navbar-header ">

    <p class="big-text">Modificar documento</p>


  </div>
  <div class="collapse navbar-collapse" align="right" id="micon">
    <a href=""> <img class="logo" src="../images/iconuser.png"></a>
  </div>
</div>

<div class="container">
    <form class="form-container" action="modificardocumento.php?iddoc=<?php echo $_GET['iddoc']."&id=".$_GET['id']; ?>" method="post" enctype="multipart/form-data">
  <div class="row">

      <div class="col-sm-6 banner-info" align="left" >
        <div class="form-group" >
          <p><br>Seleccionar Procesos</p>
            <select class="form-control" name="Proceso">
              <option <?php  if ($filashowdoc['Proceso']==1) {
          echo "selected='selected'";
      } ?> value="1">1</option>
              <option  <?php  if ($filashowdoc['Proceso']==2) {
          echo "selected='selected'";
      } ?>value="2">2</option>
              <option  <?php  if ($filashowdoc['Proceso']==3) {
          echo "selected='selected'";
      } ?>value="3">3</option>
              <option <?php  if ($filashowdoc['Proceso']==4) {
          echo "selected='selected'";
      } ?> value="4">4</option>
            </select>
                </div>
              <div class="form-group">
              <p><br>Seleccionar Tipo de documento</p>
              <select class="form-control" name="Tipodedocumento">
                <option <?php  if ($filashowdoc['Tipo de documento']==1) {
          echo "selected='selected'";
      } ?> value="1">1</option>
                <option  <?php  if ($filashowdoc['Tipo de documento']==2) {
          echo "selected='selected'";
      } ?>value="2">2</option>
                <option  <?php  if ($filashowdoc['Tipo de documento']==3) {
          echo "selected='selected'";
      } ?>value="3">3</option>
                <option <?php  if ($filashowdoc['Tipo de documento']==4) {
          echo "selected='selected'";
      } ?> value="4">4</option>
              </select>
                </div>
            <p>Numero del documento.</p>

              <div class="form-group">
              <input type="text" name="Numerodeldocumento" class="form-control" placeholder="<?php echo $filashowdoc['Numero del documento']; ?>">

            </div>
            <p><br>Nombre del documento.</p>
            <div class="form-group">

              <input type="text" name="Nombredeldocumento" class="form-control" placeholder="<?php echo $filashowdoc['Nombre del documento']; ?>">
            </div>
            <div class="form-group">
            <p><br>Subproceso</p>
          <select class="form-control" name="Subproceso">
            <option <?php  if ($filashowdoc['Subproceso']==1) {
          echo "selected='selected'";
      } ?> value="1">1</option>
            <option  <?php  if ($filashowdoc['Subproceso']==2) {
          echo "selected='selected'";
      } ?>value="2">2</option>
            <option  <?php  if ($filashowdoc['Subproceso']==3) {
          echo "selected='selected'";
      } ?>value="3">3</option>
            <option <?php  if ($filashowdoc['Subproceso']==4) {
          echo "selected='selected'";
      } ?> value="4">4</option>
          </select>
              </div>

              <div class="form-group">
                <p><br>Fecha de entrada en vigencia.</p>
                <input type="date" name="Fechadeentradavigencia" class="form-control" placeholder="<?php echo $filashowdoc['Fecha de entrada en vigencia']; ?>" required>
              </div>
              <div class="form-group">
                <p><br>Fecha de entrada en caducidad.</p>
                <input type="date" name="Fechadeentradaencaducidad" class="form-control" placeholder="<?php echo $filashowdoc['Fecha de entrada en caducidad']; ?>" required>
              </div>
              <div class="form-group">
                <!-- <input type="checkbox" class="button" name="Administrador" value="1"> Administrador<br> -->
       <table class="table table-striped table-bordered  table-responsive-sm  scrollbar">
                <thead  class="thead-dark">
                  <tr>
                    <th style="width: 50%">Nombre</th>
                    <th style="width: 50%">Roles<br></th>


                  </tr>
                </thead>
                     <tbody><?php
                     $dumbvalorarray=$document->usuariosauto;
      foreach ($dumbvalorarray as $valor) {
          if ($valor==2) {
              $dumbvar2="checked";
          }
          if ($valor==3) {
              $dumbvar3="checked";
          }
          if ($valor==4) {
              $dumbvar4="checked";
          }
      } ?>
                <tr>
                  <td>Vicerrector<br></td>
                   <td><input type="checkbox" class="form-control"  name="usuariosauto[]" value="2" <?php
              echo $dumbvar2; ?>></td>


                </tr>
                <tr>
                   <td>Jefedecarrera<br></td>
                   <td><input type="checkbox" class="form-control" name="usuariosauto[]" value="3" <?php   echo $dumbvar3; ?>></td>


                </tr>
                <tr>
                   <td>Docente<br><br></td>
                   <td><input type="checkbox"class="form-control" name="usuariosauto[]" value="4" <?php   echo $dumbvar4; ?> ></td>

                </tr>

              </tbody>
         </table>
             </div>
          </div>
          <div class="col-sm-6 banner-image" align="left" >

            <p><br>Version.</p>
            <div class="form-group">

              <input type="text" name="Version" class="form-control" placeholder="<?php echo $filashowdoc['Version']; ?>">
            </div>
             <p><br>Creador.</p>
            <div class="form-group">

              <input type="text" name="Creador" class="form-control" placeholder="<?php echo $filashowdoc['Creador']; ?>">
            </div>
            <p><br>Revisor.</p>
           <div class="form-group">

             <input type="text" name="Revisor" class="form-control" placeholder="<?php echo $filashowdoc['Revisor']; ?>">
           </div>
           <p><br>Autorizador.</p>
          <div class="form-group">

            <input type="text" name="Autorizador" class="form-control" placeholder="<?php echo $filashowdoc['Autorizador']; ?>">
          </div>
          <p><br>Diseño del proceso.</p>
         <div class="form-group">

           <input type="text" name="Disenodelproceso" class="form-control" placeholder="<?php echo $filashowdoc['Diseño del proceso']; ?>">
         </div>
         <div class="form-group">
           <p><br>Areas a las que afecta.</p>
           <input type="text" name="Areasalasqueafecta" class="form-control" placeholder="<?php echo $filashowdoc['Areas a las que afecta']; ?>">
         </div>
         <div class="form-group">
           <p><br>Registros que correspondan.</p>
           <input type="text" name="Registrosquecorresponden" class="form-control" placeholder="<?php echo $filashowdoc['Registros que corresponden']; ?>">
         </div>
          </div>
          <br><br><br>
          <div class="form-group">
          <!-- <form action="subirdocumento.php" method="post" enctype="multipart/form-data"> -->
           <input type="file" name="myFile" class="form-control" required>
         <!-- <input type="submit" name="submit" class="button" value="submit" > -->
         <!-- </form> -->
            </div>
          </div>
          <div class="form-group" align="left">
           <label for="inputlg"><br><br><br></label>

            <textarea class="form-control input-lg" name="Descripcion" rows="10" cols="30" placeholder="<?php echo $filashowdoc['Descripción']; ?>"></textarea>
            <br>

         </div>

          <div class="col-sm-6 banner-image">
          <div class="form-group">
            <a  class="btn btn-first" href="../paginaprincipal.php">Cancelar</a>

            <input type="submit" name="crear" class="button" value="Modificar" />
          </div>
          </div>
        </form>


    </div>
  </header>
  <?php
  } else {
      echo "You don't have permission to acces this page.";
  }
   ?>
</body>

</html>
