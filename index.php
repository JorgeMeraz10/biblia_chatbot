<?php
// index.php

// Configuración de la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "biblia";

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Manejar solicitudes GET
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['cita'])) {
        $cita = $_GET['cita'];
        
        // Consultar la base de datos para obtener el texto y la explicación de la cita
        $sql = "SELECT texto, explicacion FROM versiculos WHERE cita = '$cita'";  
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $response = [
                'texto' => $row['texto'],
                'explicacion' => $row['explicacion']
            ];
            echo json_encode($response);
        } else {
            echo "Cita no encontrada";
        }
    } else {
        echo "Parámetros incompletos";
    }
}

$conn->close();
?>
