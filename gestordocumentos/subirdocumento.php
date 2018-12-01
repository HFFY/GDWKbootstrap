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
  include_once '../clases/documento.php';
  // instantiate user object
  include_once '../clases/user.php';
  session_start();
  if ($_SESSION['rol']=="1"||$_SESSION['rol']=="666") {
      $database = new Database();
      $db = $database->getConnection();

      $user = new User($db);
      $document = new Documento($db);
      $olduser=$user->getUser($_SESSION['oldusercreacion']);




      if ($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['crear'])) {
          $document->Proceso = isset($_POST['Proceso']) ? $_POST['Proceso'] : die();
          $document->Tipodedocumento = isset($_POST['Tipodedocumento']) ? $_POST['Tipodedocumento'] : die();
          $document->Numerodeldocumento = isset($_POST['Numerodeldocumento']) ? $_POST['Numerodeldocumento'] : die();
          $document->Nombredeldocumento = isset($_POST['Nombredeldocumento']) ? $_POST['Nombredeldocumento'] : die();
          $document->Subproceso = isset($_POST['Subproceso']) ? $_POST['Subproceso'] : die();
          $document->Fechadeentradavigencia = isset($_POST['Fechadeentradavigencia']) ? $_POST['Fechadeentradavigencia'] : die();
          $document->Fechadeentradaencaducidad = isset($_POST['Fechadeentradaencaducidad']) ? $_POST['Fechadeentradaencaducidad'] : die();
          $document->Version = isset($_POST['Version']) ? $_POST['Version'] : die();
          $document->Creador = isset($_POST['Creador']) ? $_POST['Creador'] : die();
          $document->Revisor = isset($_POST['Revisor']) ? $_POST['Revisor'] : die();
          $document->Autorizador = isset($_POST['Autorizador']) ? $_POST['Autorizador'] : die();
          $document->Disenodelproceso = isset($_POST['Disenodelproceso']) ? $_POST['Disenodelproceso'] : die();
          $document->Areasalasqueafecta = isset($_POST['Areasalasqueafecta']) ? $_POST['Areasalasqueafecta'] : die();
          $document->Registrosquecorresponden = isset($_POST['Registrosquecorresponden']) ? $_POST['Registrosquecorresponden'] : die();

          $document->Descripcion = isset($_POST['Descripcion']) ? $_POST['Descripcion'] : die();

          $document->usuariosauto = isset($_POST['usuariosauto']) ? $_POST['usuariosauto'] : die();
          $my_folder = ".././uploads/";
          // $filePath = realpath($_FILES["myFile"]['tmp_name']);
          // $dumbvariable = pathinfo($_FILES['myFile']['tmp_name'], PATHINFO_EXTENSION);
          // echo $dumbvariable;
          if (move_uploaded_file($_FILES['myFile']['tmp_name'], $my_folder . $_FILES['myFile']['name'])) {
              echo 'Received file' . $_FILES['myFile']['name'] . ' with size ' . $_FILES['myFile']['size'];

              $document->Link = "gdwkbootstrap/uploads/".basename($_FILES['myFile']['name']);
              $document->insertDocument();
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

        <p class="big-text">Subir documento</p>


      </div>
      <div class="collapse navbar-collapse" align="right" id="micon">
        <a href=""> <img class="logo" src="../images/iconuser.png"></a>
      </div>
    </div>

    <div class="container">
        <form class="form-container" action="subirdocumento.php" method="post" enctype="multipart/form-data">
      <div class="row">

          <div class="col-sm-6 banner-info" align="left" >
            <div class="form-group" >
              <p><br>Seleccionar Procesos</p>
            <select class="form-control" name="Proceso">
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
            </select>
                </div>
              <div class="form-group">
              <p><br>Seleccionar Tipo de documento</p>
            <select class="form-control" name="Tipodedocumento">
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
            </select>
                </div>
            <p>Numero del documento.</p>

              <div class="form-group">
              <input type="text" name="Numerodeldocumento" class="form-control" placeholder="Numero del documento">

            </div>
            <p><br>Nombre del documento.</p>
            <div class="form-group">

              <input type="text" name="Nombredeldocumento" class="form-control" placeholder="Nombre del documento">
            </div>
            <div class="form-group">
            <p><br>Subproceso</p>
          <select class="form-control" name="Subproceso">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
          </select>
              </div>

              <div class="form-group">
                <p><br>Fecha de entrada en vigencia.</p>
                <input type="date" name="Fechadeentradavigencia" class="form-control" placeholder="Fecha de entrada vigencia">
              </div>
              <div class="form-group">
                <p><br>Fecha de entrada en caducidad.</p>
                <input type="date" name="Fechadeentradaencaducidad" class="form-control" placeholder="Fecha de entrada caducidad">
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
               <tbody>
          <tr>
            <td>Vicerrector<br></td>
             <td><input type="checkbox" class="form-control"  name="usuariosauto[]" value="2"></td>


          </tr>
          <tr>
             <td>Jefedecarrera<br></td>
             <td><input type="checkbox" class="form-control" name="usuariosauto[]" value="3" ></td>


          </tr>
          <tr>
             <td>Docente<br><br></td>
             <td><input type="checkbox"class="form-control" name="usuariosauto[]" value="4" ></td>

          </tr>
        </tbody>
   </table>
       </div>

          </div>
          <div class="col-sm-6 banner-image" align="left" >

            <p><br>Version.</p>
            <div class="form-group">

              <input type="text" name="Version" class="form-control" placeholder="Version">
            </div>
             <p><br>Creador.</p>
            <div class="form-group">

              <input type="text" name="Creador" class="form-control" placeholder="creador">
            </div>
            <p><br>Revisor.</p>
           <div class="form-group">

             <input type="text" name="Revisor" class="form-control" placeholder="Revisor"
           </div>
           <p><br>Autorizador.</p>
          <div class="form-group">

            <input type="text" name="Autorizador" class="form-control" placeholder="Autorizador">
          </div>
          <p><br>Diseño del proceso.</p>
         <div class="form-group">

           <input type="text" name="Disenodelproceso" class="form-control" placeholder="Diseño del proceso">
         </div>
         <div class="form-group">
           <p><br>Areas a las que afecta.</p>
           <input type="text" name="Areasalasqueafecta" class="form-control" placeholder="Areas a las que afecta">
         </div>
         <div class="form-group">
           <p><br>Registros que correspondan.</p>
           <input type="text" name="Registrosquecorresponden" class="form-control" placeholder="Registros que correspondan">
         </div>
          </div>
          <br><br><br>
           <div class="form-group">
           <!-- <form action="subirdocumento.php" method="post" enctype="multipart/form-data"> -->
            <input type="file" name="myFile" class="form-control">
          <!-- <input type="submit" name="submit" class="button" value="submit" > -->
          <!-- </form> -->
             </div>
         </div>
          <div class="form-group" align="left">
           <label for="inputlg"><br><br><br></label>

         <textarea class="form-control input-lg" name="Descripcion" rows="10" cols="30" placeholder="Descripcion"></textarea>
            <br>

         </div>

          <div class="col-sm-6 banner-image">

            <div class="form-group">
            <a  class="btn btn-first" href="../paginaprincipal.php">Cancelar</a>

                <input type="submit" name="crear" class="button" value="Crear" />
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
