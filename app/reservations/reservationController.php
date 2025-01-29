<?php
// controlador encargado de gestionar las reservas de las canchas: validar disponibilidad, gestionar horarios y almacenar reservas en la base de datos

require_once 'db.php'; // Archivo de conexión a la base de datos

// Obtener todas las reservas para una fecha específica
function obtenerReservas($fecha) {
    global $conn;
    $sql = "SELECT hora, cancha FROM reservas WHERE fecha = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $fecha);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $reservas = [];

    while ($fila = $resultado->fetch_assoc()) {
        $reservas[] = $fila;
    }

    return $reservas;
}

// Verificar disponibilidad de una cancha en una fecha y hora específicas
function estaDisponible($fecha, $hora, $cancha) {
    global $conn;
    $sql = "SELECT * FROM reservas WHERE fecha = ? AND hora = ? AND cancha = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $fecha, $hora, $cancha);
    $stmt->execute();
    $stmt->store_result();

    return $stmt->num_rows === 0; // Si no hay resultados, está disponible
}

// Agregar una nueva reserva
function agregarReserva($nombre_usuario, $fecha, $hora, $cancha) {
    global $conn;
    
    if (estaDisponible($fecha, $hora, $cancha)) {
        $sql = "INSERT INTO reservas (nombre_usuario, fecha, hora, cancha) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssi", $nombre_usuario, $fecha, $hora, $cancha);
        
        if ($stmt->execute()) {
            return "Reserva realizada con éxito.";
        } else {
            return "Error al realizar la reserva.";
        }
    } else {
        return "Horario no disponible.";
    }
}

// Cancelar una reserva
function cancelarReserva($id) {
    global $conn;
    $sql = "DELETE FROM reservas WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    return $stmt->execute() ? "Reserva cancelada." : "Error al cancelar la reserva.";
}

?>
