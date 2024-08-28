<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

// Configura tu conexión a la base de datos
include 'db_connect.php';

$response = array('status' => 'success');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $dni = $_POST['dni'];
    $marcacionTipo = $_POST['marcacionTipo'];
    $hora = $_POST['hora'];
    $fecha = $_POST['fecha'];

    if (empty($dni) || empty($marcacionTipo) || empty($hora) || empty($fecha)) {
        $response['status'] = 'error';
        $response['message'] = 'Todos los campos son necesarios.';
    } else {
        // Aquí puedes agregar el código para guardar los datos en la base de datos
        $query = $pdo->prepare("INSERT INTO marcaciones (dni, tipo, hora, fecha) VALUES (?, ?, ?, ?)");
        if ($query->execute([$dni, $marcacionTipo, $hora, $fecha])) {
            $response['message'] = 'Marcación guardada con éxito.';
        } else {
            $response['status'] = 'error';
            $response['message'] = 'Error al guardar la marcación.';
        }
    }
} else {
    $response['status'] = 'error';
    $response['message'] = 'Método de solicitud no permitido.';
}

echo json_encode($response);
?>
