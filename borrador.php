<?php

include_once '../clases/database.php';
include_once '../clases/user.php';


$database = new Database();

$db = $database->getConnection();

$user = new User($db);
echo $_GET['username'];
echo $_GET['names'];
echo $_GET['password'];
echo $_GET['rol'];
echo $_GET['lastname'];

$user->username = isset($_GET['username']) ? $_GET['username'] : die();

$user->password = base64_encode(isset($_GET['password']) ? $_GET['password'] : die());
$user->names = isset($_GET['names']) ? $_GET['names'] : die();
$user->lastname = isset($_GET['lastname']) ? $_GET['lastname'] : die();
$user->rol = isset($_GET['rol']) ? $_GET['rol'] : die();

// read the details of user to be edited

$stmt = $user->signup();


if ($stmt==true) {
    // get retrieved row
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

// create array
// $user_arr=array(
// "status" => true,
// "message" => "Successfully Login!",
// "ID_usuarios" => $row['ID_usuarios'],
// "Usuario" => $row['Usuario']
//
// );
//
// $ser = $user->serialize();
// session_start();
// $_SESSION['ser'] = $ser;
//
// header("Location: paginaprincipal.php");
//
// echo 'asd';
} else {
    $user_arr=array(
"status" => false,
"message" => "There is already an user lol!",
);
}
// make it json format
//print_r(json_encode($user_arr));

/////////////////////////////////////////////////////////////
if ($this->isAlreadyExist()) {
    return false;
}

$date = date("Y-m-d H:i:s");
echo "HOLA".$date;


// query to insert record
// $query = "INSERT INTO
//             " . $this->table_name . "
//         VALUES
//         ('".$this->names."', null, '1','".$this->lastname."','".$this->password."','".$this->username."',1,'','','".$date."',null,'asdasd123','qwqeasda21312')";
// $query = "INSERT INTO
//                   " . $this->table_name . "
//             SET
//                             names=:names, =:password, created=:created";
$sql =  "INSERT INTO " . $this->table_name . " VALUES ('".$this->names."', null, '1','".$this->lastname."','".$this->password."','".$this->username."',1,'','','".$date."',null,'asdasd123','qwqeasda21312')";

        if ($conn->query($sql) === TRUE) {

          echo "New record created successfully";
          return true;
        } else {

          echo "Error: " . $sql . "<br>" . $conn->error;
          return false
        }
// prepare query
// $stmt = $this->conn->prepare($query);
//
// // sanitize
// $this->username=htmlspecialchars(strip_tags($this->username));
// $this->password=htmlspecialchars(strip_tags($this->password));
// $this->names=htmlspecialchars(strip_tags($this->names));
// $this->lastname=htmlspecialchars(strip_tags($this->lastname));
// $this->rol=htmlspecialchars(strip_tags($this->rol));
//
// // bind values
// $stmt->bindParam(":username", $this->username);
// $stmt->bindParam(":password", $this->password);
// $stmt->bindParam(":names", $this->names);
// $stmt->bindParam(":lastname", $this->lastname);
// $stmt->bindParam(":rol", $this->rol);
//
// // execute query
// if ($stmt->execute()) {
//     $this->id = $this->conn->lastInsertId();
//     return true;
// }
//
// return false;
////////////////////////////////////////////////////////////////////////////////////////---------------------
// query to insert record
$this->date= date('Y-m-d H:i:s');
$query = "INSERT INTO
            " . $this->table_name . "
        SET
            Nombres=:names, ID_usuarios=:null,Idrango=:rol,Apellidos=:lastname,Contraseña=:password,Usuario=:username,Estado=:1,null,null,`Fecha de creación`=:date,null,null,null";

// prepare query
$stmt = $this->conn->prepare($query);

// sanitize
$this->username=htmlspecialchars(strip_tags($this->username));
$this->password=htmlspecialchars(strip_tags($this->password));
$this->date=htmlspecialchars(strip_tags($this->date));
$user->rol =htmlspecialchars(strip_tags($this->rol));
$user->names = htmlspecialchars(strip_tags($this->names));
$user->lastname = htmlspecialchars(strip_tags($this->lastname));

// bind values
$stmt->bindParam(":username", $this->username);
$stmt->bindParam(":password", $this->password);
$stmt->bindParam(":date", $this->date);
$stmt->bindParam(":rol", $this->rol);
$stmt->bindParam(":names", $this->names);
$stmt->bindParam(":lastname", $this->lastname);
echo "Hola user.php<br>";
echo $this->username;
echo $this->password;
echo $this->date;
echo $this->rol;
echo $this->names;
echo $this->lastname;
// execute query
if ($stmt->execute()) {
    $this->id = $this->conn->lastInsertId();
    return true;
}

return false;
