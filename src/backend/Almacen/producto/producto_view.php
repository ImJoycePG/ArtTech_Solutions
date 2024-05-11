<?php
session_start();
if(!isset($_SESSION["username"])){
    header("Location: ../../login.html");
    exit();
}

$conn = include_once("../../../Utils/db_connection.php");

$v_sql = "
    SELECT
        productId,
        productName,
        productCost,
        productType,
        productCategory
    FROM productos; 
";

$result = $conn->query($v_sql);

if($result->num_rows > 0){
    while ($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . $row['productId'] . '</td>';
        echo '<td>' . $row['productName'] . '</td>';
        echo '<td>' . $row['productCost'] . '</td>';
        echo '<td>' . $row['productType'] . '</td>';
        echo '<td>' . $row['productCategory'] . '</td>';
        echo '<td><button class="btn btn-primary btn-editar" data-producto-id="' . $row['productId'] . '">Editar</button></td>';
        echo '</tr>';
    }
    
} else {
    echo "No se encontraron resultados.";
}
$conn->close();