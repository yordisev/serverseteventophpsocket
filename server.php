<?php
header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');

$mysqli = new mysqli("localhost", "root", "", "db_relojito");
if ($mysqli->connect_errno) {
    printf("Falló la conexión: %s\n", $mysqli->connect_error);
    exit();
} else {
   $mysqli->set_charset('utf8');
}

$departamento = '08';
$municipio = '08001';
$sede = '1';
$stmt = $mysqli->prepare("CALL ver_turnos_pantalla(?,?,?)");
$stmt->bind_param("sss", $departamento,$municipio, $sede);
$stmt->execute();
$result = $stmt->get_result();
$response = $result->fetch_all(MYSQLI_ASSOC);
$datosrespuesta = json_encode($response);
echo "data: {$datosrespuesta}\n\n";
// $time = date('r');
// echo "data: The server yordis time is: {$time}\n\n";
flush();
?>