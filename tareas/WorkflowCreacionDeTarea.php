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

include_once '../clases/database.php';
include_once '../clases/user.php';
include_once '../clases/documento.php';
session_start();
$database = new Database();
$db = $database->getConnection();

$user = new User($db);
$sql = 'select * from usuarios;';
$result = $db->query($sql);
$result->setFetchMode(PDO::FETCH_ASSOC);
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
            <div class="row">
                <p class="big-text">Crear tarea</p>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-sm-6 banner-info">
                    <p>Tarea</p>
                    <select class="form-control">
                        <option value="volvo">Volvo</option>
                        <option value="saab">Saab</option>
                        <option value="mercedes">Mercedes</option>
                        <option value="audi">Audi</option>
                    </select>
                    <p>
                        <br>Fecha inicio</p>
                    <form action="/action_page.php">
                        <input type="date" name="bday" class="form-control">
                    </form>
                </div>
                <div class="col-sm-6 banner-image">
                    <p>Prioridad</p>
                    <select class="form-control">
                        <option value="volvo">Volvo</option>
                        <option value="saab">Saab</option>
                        <option value="mercedes">Mercedes</option>
                        <option value="audi">Audi</option>
                    </select>
                    <p>
                        <br>Fecha Aceptada</p>
                    <form action="/action_page.php">
                        <input type="date" name="bday" class="form-control">
                    </form>

                </div>

                <div class="col-sm-6 banner-image">
                  <p>Nombre de la tarea</p>
                  <input type="text" class="form-control"><br>
                </div>

                <div class="form-group">
                    <label for="inputlg">
                        <br>
                        <br>
                        <br>
                    </label>
                    <form action="/action_page.php">
                        <textarea class="form-control input-lg" name="message" rows="10" cols="30" placeholder="Descripcion"></textarea>
                        <br>
                    </form>
                </div>
                <a class="btn btn-first" href="../tareas/WorkflowPaginaPrincipal.php">Cancelar</a>
                <button type="submit" class="button" href="">Crear</button>
                </button>

            </div>
        </div>
    </header>

</body>

</html>
