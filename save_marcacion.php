<?php
include '../includes/db_connect.php'; // Incluye el archivo de conexión a la base de datos

// Verifica si se recibieron los datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos enviados desde el frontend
    $dni = $_POST['dni'];
    $marcacionTipo = $_POST['marcacionTipo'];
    $hora = $_POST['hora'];
    $fecha = $_POST['fecha'];

    // Verificar que los datos no estén vacíos
    if (empty($dni) || empty($marcacionTipo) || empty($hora) || empty($fecha)) {
        echo json_encode(['status' => 'error', 'message' => 'Datos incompletos']);
        exit;
    }

    // Insertar los datos en la base de datos
    $stmt = $conn->prepare("INSERT INTO marcaciones (dni, fecha, ingreso, inicio_break, retorno_break, salida) VALUES (?, ?, ?, ?, ?, ?)");
    $ingreso = ($marcacionTipo == 'Ingreso') ? $hora : '';
    $inicio_break = ($marcacionTipo == 'Inicio Break') ? $hora : '';
    $retorno_break = ($marcacionTipo == 'Retorno Break') ? $hora : '';
    $salida = ($marcacionTipo == 'Salida') ? $hora : '';
    
    $stmt->bind_param("ssssss", $dni, $fecha, $ingreso, $inicio_break, $retorno_break, $salida);
    
    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Marcación guardada correctamente']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error al guardar la marcación']);
    }

    $stmt->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'Método de solicitud no válido']);
}

$conn->close();
?>
