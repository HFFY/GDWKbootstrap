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


      $usergetid=$_GET['id'];


  if (!empty($_SESSION['rol'])) {
      $database = new Database();
      $db = $database->getConnection();

      $user = new User($db);


      // set user property values

      // $user->username = $_GET['username'];
      // $user->password = base64_encode($_GET['password']);


      $user->date = date('Y-m-d H:i:s');
      $olduser=$user->getUser($usergetid);
      //  echo $_SERVER['REQUEST_METHOD'];

      if ($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['crear'])) {
          $user->username = !empty($_POST['username']) ? $_POST['username'] : $olduser['Usuario'];
          $user->password = !empty($_POST['password']) ? base64_encode($_POST['password']) :$olduser['Contraseña'];
          $user->names = !empty($_POST['names']) ? $_POST['names'] : $olduser['Nombres'];
          $user->lastname = !empty($_POST['lastname']) ? $_POST['lastname'] : $olduser['Apellidos'];

          if ($_SESSION['rol']=="1"||$_SESSION['rol']=="666") {
              $user->rol = isset($_POST['rol']) ? $_POST['rol'] : die();
          } else {
              $user->rol = $user->getUser($usergetid)['Idrango'];
          }

          $user->modifiedUser($usergetid);
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
        <form class="form-container" action="modificarusuario.php?id=<?php echo $usergetid; ?>" method="post">
          <div class="col-sm-6 banner-info">
            <p>Ingresar nombre de usuario.</p>
            <div class="form-group" >

              <input type="text" name="username" class="form-control" placeholder="<?php echo $olduser['Usuario']; ?>">

            </div>
            <p><br>Ingresar contraseña.</p>
            <div class="form-group">

              <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Contraseña">
            </div>
            <?php   if ($_SESSION['rol']=="1"||$_SESSION['rol']=="666") {
          ?>
            <div class="form-group">
              <p><br>Seleccionar rol</p>
              <select class="form-control" name="rol">


                <?php

          $count=0;

          $dumbvalorarray=$user->getAllRols();
          while ($valor=$dumbvalorarray->fetch()) {
              if ($valor['idRangoUsuarios']!=666) {
                  ?>

                    <option  value="<?php echo $count=$count+1; ?>" <?php  if ($olduser['Idrango']==$count) {
                      echo "selected='selected'";
                  } ?>><?php echo $valor['Descripcion']; ?></option>


                  <?php
              }
          } ?>

              </select>
            </div>
          <?php
      } ?>
          </div>
          <div class="col-sm-6 banner-image">
            <p><br>Ingresar nombres.</p>
            <div class="form-group">

              <input type="text" name="names" class="form-control" placeholder="<?php echo $olduser['Nombres']; ?>">
            </div>
             <p><br>Ingresar apellidos.</p>
            <div class="form-group">

              <input type="text" name="lastname" class="form-control" placeholder="<?php echo $olduser['Apellidos']; ?>">
            </div>
          </div>
          <div class="col-sm-6 banner-image">
            <div class="form-group">
            <a  class="btn btn-first" href="../paginaprincipal.php">Cancelar</a>

                <input type="submit" name="crear" class="button" value="Modificar" />
              </div>

              <!-- <form action="" method="post">
            <a href="" class="btn btn-second"><input name="crear" value="Crear" type="submit" class="btn btn-primary btn-block" method="post"></input></a>
          </form> -->

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
