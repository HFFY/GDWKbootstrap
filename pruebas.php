<html>
  <head>
    <link rel="stylesheet" href="css/style.css" >
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

  </head>
  <body>
  <div class="container">

    <?php
    $my_folder = "./uploads/";
    $dumbvariable = pathinfo($_FILES['myFile']['tmp_name'], PATHINFO_EXTENSION);
    echo $dumbvariable;


    if (move_uploaded_file($_FILES['myFile']['tmp_name'], $my_folder . $_FILES['myFile']['name'])) {
        echo 'Received file' . $_FILES['myFile']['name'] . ' with size ' . $_FILES['myFile']['size'];
    } else {
        echo 'Upload failed!';

        var_dump($_FILES['myFile']['error']);
    }
      ?>
      <form method="post" enctype="multipart/form-data">
        <h3 class="text-center" >
        </h3> <hr/>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
                <input type="file" name="myFile" class="form-control">
            </div>
          </div>
        </div>
        <div>
          <div class="col-md-6">
            <div class="form-group">
              <input type="submit" name="uploadBtn" class="btn btn-info">
            </div>
          </div>
        </div>
      </form>
    </div>
    </body>
</html>
