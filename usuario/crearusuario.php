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
  if ($_SESSION['rol']=="1"||$_SESSION['rol']=="666") {
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
      $olduser=$user->getUser($_SESSION['oldusercreacion']);
      // create the user
        
      if ($user->signup()) {
          //     $user_arr=array(
          //     "status" => true,
          //     "message" => "Successfully Signup!",
          //
          // );
          // echo "Creacion exitosa";

      } else if (!empty($_GET['username'])) {

        ?>


                    <button type="hidden" id="modal" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter" style="display: none;"> Invisible </button>
                            <script>
                              jQuery(function(){
                                jQuery('#modal').click();
                             });
                            </script>

                            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                              <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                  <div class="modal-header" style="background-color:#FF0000;">
                                    <h5 class="modal-title" id="exampleModalLongTitle"><font color="white" size="5">
                                    Usuario repetido verifique los datos
                                    </font>
                                  </h5>

                                  </div>


                                </div>
                              </div>
                            </div>



          <?php
      }
      // print_r(json_encode($user_arr));?>
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

        <p class="big-text">Crear usuario</p>


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

              <input type="text" name="username" class="form-control" placeholder="Usuario" required>

            </div>
            <p><br>Ingresar Contraseña.</p>
            <div class="form-group">

              <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Contraseña" required>
            </div>
            <div class="form-group">
              <p><br>Seleccionar rol</p>
              <select class="form-control" name="rol">
                <option value="1">Administrador</option>
                <option value="2">Vicerrector/Decano</option>
                <option value="3">Jefe de carrera</option>
                <option value="4">Docentes</option>
              </select>
            </div>
          </div>
          <div class="col-sm-6 banner-image">
            <p><br>Ingresar nombres.</p>
            <div class="form-group">

              <input type="text" name="names" class="form-control" placeholder="Nombres" required>
            </div>
             <p><br>Ingresar apellidos.</p>
            <div class="form-group">

              <input type="text" name="lastname" class="form-control" placeholder="Apellidos" required>
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
