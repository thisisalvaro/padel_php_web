<?php
// archivo con funciones específicas para manejar calendarios, horarios disponibles y conflictos de horarios

require_once 'db.php'; // Archivo de conexión a la base de datos

// Obtener todos los horarios disponibles para una fecha y cancha específica
function obtenerHorariosDisponibles($fecha, $cancha) {
    $horarios = ['08:00', '09:00', '10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00', '17:00', '18:00', '19:00', '20:00'];
    $reservas = obtenerReservasPorFechaYCancha($fecha, $cancha);
    
    // Filtra los horarios ocupados
    return array_diff($horarios, $reservas);
}

// Obtener las reservas para una fecha y cancha específica
function obtenerReservasPorFechaYCancha($fecha, $cancha) {
    global $conn;
    $sql = "SELECT hora FROM reservas WHERE fecha = ? AND cancha = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $fecha, $cancha);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $horasReservadas = [];

    while ($fila = $resultado->fetch_assoc()) {
        $horasReservadas[] = $fila['hora'];
    }

    return $horasReservadas;
}

// Verificar si hay un conflicto de horario
function verificarConflicto($fecha, $hora, $cancha) {
    global $conn;
    $sql = "SELECT COUNT(*) AS total FROM reservas WHERE fecha = ? AND hora = ? AND cancha = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $fecha, $hora, $cancha);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $fila = $resultado->fetch_assoc();

    return $fila['total'] > 0; // Devuelve true si hay un conflicto
}

?>
