<?php
session_start();
if(!isset($_SESSION["username"])){
    header("Location: ../../login.html");
    exit();
}

$conn = include_once("../../../Utils/db_connection.php");

if(isset($_POST['action']) && $_POST['action'] === 'guardar') {
    $nameProduct = $_POST['nameProduct'];
    $costProduct = $_POST['costProduct'];
    $typeProduct = $_POST['typeProduct'];

    $v_sql = "
        INSERT INTO productos(productName, productCost, productType)
        VALUES (?, ?, ?);
    ";
    $stmt = $conn->prepare($v_sql);

    $stmt->bind_param("sss", $nameProduct, $costProduct, $typeProduct);

    if($stmt->execute()) {
        header("Location: ../../../frontend/pages/productos_view.html");
        exit();
    } else {
        echo "Error al ejecutar la consulta: " . $stmt->error;
    }
    $stmt->close();
}

$conn->close();