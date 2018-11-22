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
  if (!empty($_SESSION['rol'])) {
      $database = new Database();
      $db = $database->getConnection();

      $user = new User($db);

      // set user property values

      $user->username = $_GET['username'];
      $user->password = base64_encode($_GET['password']);
      if ($_SESSION['rol']=="1") {
          $user->rol = $_GET['rol'];
      }
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

        <p class="big-text">Modificar usuario</p>


      </div>
      <div class="collapse navbar-collapse" align="right" id="micon">
        <a href=""> <img class="logo" src="../images/iconuser.png"></a>
      </div>
    </div>

    <div class="container">
      <div class="row">
        <form class="form-container">
          <div class="col-sm-6 banner-info">
            <p>Ingresar nombre de usuario.</p>
            <div class="form-group" method="post" action="crearusuario.php">

              <input type="text" name="username" class="form-control" placeholder="Usuario">

            </div>
            <p><br>Ingresar Contraseña.</p>
            <div class="form-group">

              <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Contraseña">
            </div>
            <?php   if ($_SESSION['rol']=="1") {
          ?>
            <div class="form-group">
              <p><br>Seleccionar rol</p>
              <select class="form-control" name="rol">
                <option value="1">Administrador</option>
                <option value="2">Vicerrector/Decano</option>
                <option value="3">Jefe de carrera</option>
                <option value="4">Docentes</option>
              </select>
            </div>
          <?php
      } ?>
          </div>
          <div class="col-sm-6 banner-image">
            <p><br>Ingresar nombres.</p>
            <div class="form-group">

              <input type="text" name="names" class="form-control" placeholder="Nombres">
            </div>
             <p><br>Ingresar apellidos.</p>
            <div class="form-group">

              <input type="text" name="lastname" class="form-control" placeholder="Apellidos">
            </div>
          </div>
          <div class="col-sm-6 banner-image">

            <a  class="btn btn-first" href="../paginaprincipal.php">Cancelar</a>

            <a href="" class="btn btn-second">    <button type="submit" class="btn btn-primary btn-block">Crear</button></a>
          </div>
        </form>

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
