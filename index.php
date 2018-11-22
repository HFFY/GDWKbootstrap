<!DOCTYPE html>

<html>
    <head>
        <title>
            Login From
        </title>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet"  href="css/global.css">
</head>

    <body>
        <section class="container-fluid">
            <section class="row justify-content-center">
                <section class="col-12 col-sm-6 col-md-3">
                    <img src="images/user.png" class="bg">
                        <form class="form-container">
                            <h4 class="text-center font-eight-bold">Log in</h4>
                                <div class="form-group" method="post" action="index.php" >

                                  <input type="text" name="username" class="form-control"   placeholder="Enter Username">

                                </div>
                                <div class="form-group" >

                                  <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                                </div>
                                <div class="form-group form-check">
                                  <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                  <label class="form-check-label" for="exampleCheck1">Check me out</label>
                                </div>
                                <button type="submit" class="btn btn-primary btn-block">Submit</button>
                              </form>
                </section>
            </section>
        </section>
        <?php

        include_once 'clases/database.php';
        include_once 'clases/user.php';

        $database = new Database();
        $db = $database->getConnection();
        $user = new User($db);
        $user->username = isset($_GET['username']) ? $_GET['username'] : die();
        $user->password = base64_encode(isset($_GET['password']) ? $_GET['password'] : die());

        // read the details of user to be edited
        $stmt = $user->login();

        if ($stmt->rowCount() > 0) {
            // get retrieved row
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            echo $row;
            // create array
            $user_arr=array(
        "status" => true,
        "message" => "Successfully Login!",
        "ID_usuarios" => $row['ID_usuarios'],
        "Usuario" => $row['Usuario']

        );

            $ser = $user->serialize();
            //    $loguser = $user->username->serialize();

            session_start();
            if (!empty($user->username)) {
                echo !empty($ser);
                $_SESSION['ser'] = $ser;
                //$_SESSION['loguser'] =$loguser;


                header("Location: paginaprincipal.php");
            }

            echo 'asd';
        } else {
            $user_arr=array(
        "status" => false,
        "message" => "Invalid Username or Password!",
      );
        }
      // make it json format
      //print_r(json_encode($user_arr));

          ?>

    </body>

</html>
