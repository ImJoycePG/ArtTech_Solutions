<?php

$conn = include("../Utils/db_connection.php");

$response = array();

if($_SERVER['REQUEST_METHOD'] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $v_sql = "
        SELECT
            username,
            pass
        FROM usuario
        WHERE username='$username' AND pass=MD5('$password');
    ";
    $result = $conn->query($v_sql);

    if($result->num_rows > 0) {
        session_start();
        $_SESSION["username"] = $username;
        $response['success'] = true;
    } else {      
        $response['success'] = false;
        $response['message'] = 'Usuario o contraseña incorrectos';
    }
    $conn->close();
}

header('Content-Type: application/json');
echo json_encode($response);