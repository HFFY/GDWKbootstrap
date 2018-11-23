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
  session_start();
  if ($_SESSION['rol']=="1") {
      $database = new Database();
      $db = $database->getConnection();

      $user = new User($db);

      // set user property values

      $user->username = $_GET['username'];
      $user->password = base64_encode($_GET['password']);
      $user->rol = $_GET['rol'];
      $user->names = $_GET['names'];
      $user->lastname = $_GET['lastname'];
      $user->date = date('Y-m-d H:i:s');

      // create the user
      if ($user->signup()) {
          $user_arr=array(
          "status" => true,
          "message" => "Successfully Signup!",

      );
      } else {
          $user_arr=array(
          "status" => false,
          "message" => "Username already exists!"
      );
      }
      print_r(json_encode($user_arr)); ?>
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
            <li><a href="">Login</a></li>
            <li><a href="">WorkFlow</a></li>
            <li><a href="">Añadir Documento</a></li>
            <li><a href="">Modificar Documento</a></li>

          </ul>
        </div>
      </div>
    </nav>

    <div class="container">
      <div class="navbar-header ">

        <p class="big-text">Actualizar documento</p>


      </div>
      <div class="collapse navbar-collapse" align="right" id="micon">
        <a href=""> <img class="logo" src="../images/iconuser.png"></a>
      </div>
    </div>

    <div class="container">
        <form class="form-container">
      <div class="row">

          <div class="col-sm-6 banner-info" align="left" >
            <div class="form-group" method="post" action="subirdocumento.php">
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
            <select class="form-control" name="Tipo de documento">
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
            </select>
                </div>
            <p>Numero del documento.</p>

              <div class="form-group">
              <input type="text" name="Numero del documento" class="form-control" placeholder="Numero del documento">

            </div>
            <p><br>Nombre del documento.</p>
            <div class="form-group">

              <input type="text" name="Nombre del documento" class="form-control" placeholder="Nombre del documento">
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
                <input type="text" name="Nombre del documento" class="form-control" placeholder="Nombre del documento">
              </div>
              <div class="form-group">
                <p><br>Fecha de entrada en caducidad.</p>
                <input type="text" name="Nombre del documento" class="form-control" placeholder="Nombre del documento">
              </div>
          </div>
          <div class="col-sm-6 banner-image" align="left" >

            <p><br>Version.</p>
            <div class="form-group">

              <input type="text" name="version" class="form-control" placeholder="Version">
            </div>
             <p><br>Creador.</p>
            <div class="form-group">

              <input type="text" name="creador" class="form-control" placeholder="creador">
            </div>
            <p><br>Revisor.</p>
           <div class="form-group">

             <input type="text" name="Revisor" class="form-control" placeholder="Revisor"
           </div>
           <p><br>Autorizador.</p>
          <div class="form-group">

            <input type="text" name="autorizador" class="form-control" placeholder="autorizador">
          </div>
          <p><br>Dueño del proceso.</p>
         <div class="form-group">

           <input type="text" name="dueñodelproceso" class="form-control" placeholder="dueñodelproceso">
         </div>
         <div class="form-group">
           <p><br>Areas a las que afecta.</p>
           <input type="text" name="Areas a las que afecta" class="form-control" placeholder="Areas a las que afecta">
         </div>
         <div class="form-group">
           <p><br>Registros que correspondan.</p>
           <input type="text" name="Registros que correspondan" class="form-control" placeholder="Registros que correspondan">
         </div>
          </div>
          <br><br><br>
          <input type="file" id="myDocument" class="form-control">
  </div>
          <div class="form-group" align="left">
           <label for="inputlg"><br><br><br></label>
           <form action="">
         <textarea class="form-control input-lg" name="message" rows="10" cols="30" placeholder="Descripcion"></textarea>
            <br>
           </form>
         </div>

          <div class="col-sm-6 banner-image">

            <a  class="btn btn-first" href="../paginaprincipal.php">Cancelar</a>

            <a href="" class="btn btn-second">    <button type="submit" class="btn btn-primary btn-block">Crear</button></a>
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
