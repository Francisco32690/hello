<?php
$nombre = $_POST['nombre'];
$password = $_POST['password'];
$genero = $_POST['genero'];
$email = $_POST['email'];
$materia = $_POST['materia'];
$telefono = $_POST['telefono'];

if(!empty($nombre) && !empty($password) && !empty($genero) && !empty($email) && !empty($materia) && !empty($telefono) ){

$host ="localhost";
$dbusername = "root";
$dbpassword = " ";
$bdname = "viajeros";

$conn = new mysqli($host,$dbusername,$dbpassword,$bdname);
if(mysqli_connect_error()){
    die('connect error('.mysqli_connect_errno().')'.mysqli_connectio_error()); 
}
else{
    $SELECT = "SELECT telefono from usuario where telefono = ? limit 1 ";
    $INSERT = "INSERT INTO usuario (nombre,password,genero,email,materia,telefono)values(?,?,?,?,?,?)";

    $stmt = $conn->prepare($SELECT);
    $stmt ->bind_param("i", $telefono);
    $stmt ->execute();
    $stmt ->bind_result($telefono);
    $stmt ->store_result();
    $rnum =$stmt->num_romws;
    if($rnum ==0){
        $stmt ->Close();
        $stmt = $conn->prepare($INSERT);
        $stmt ->bind_param("sssssi", $nombre,$password,$genero,$email,$materia,$telefono);
        $stmt ->execute();

        echo ("<br>");
        
        echo "Hola $nombre tu compra fue completada.";

        echo ("<br>");
        echo ("<br>");

        echo ("Por favor verifica los datos que te enumeraremos, si te as equivocado en uno por favor ve a tu correo.");

        echo ("<br>");

        echo ("<br>");

        echo ("_______________________________________");

        echo ("<br>");
        
        echo (" │ Tu nombre es: $nombre ");
        
        echo ("<br>");
        
        echo (" │ Tu contraseña es: $password");

        echo ("<br>");
        
        echo (" │ Tu correo es: $email");


        echo ("<br>");
        
        echo (" │ Tu destino es: $materia ");

        echo ("<br>");

        echo ("_______________________________________");


    }
    else{
        echo "Alguien registro este numero anteriormente";
    }
    $stmt->close();
    $conn->close();

}

}
else{
    echo "Todos los datos son necesarios";
    die();
}



?>