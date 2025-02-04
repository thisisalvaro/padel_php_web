<?php
// controlador encargado de gestionar las reservas de las canchas: validar disponibilidad, gestionar horarios y almacenar reservas en la base de datos

require_once 'db.php'; // Archivo de conexión a la base de datos

// Obtener todas las reservas para una fecha específica
function obtenerReservas($fecha) {
    $conn = Database::getConnection();

    if($fecha == null){
        return null;
    }

    $sql = "SELECT id ,nombre,hora,id_pista FROM reservas WHERE fecha = '$fecha'";
    $stmt = pg_query($conn, $sql);

    while ($row = pg_fetch_row($stmt)) {
        $reservas[] =$row;
    }

    return $reservas;
}

// Verificar disponibilidad de una cancha en una fecha y hora específicas
function estaDisponible($fecha, $hora, $id_pista) {
    $conn = Database::getConnection();

    if ($fecha == null || $hora == null || $id_pista == null) {
        return false;
    }

    $sql = "SELECT * FROM reservas WHERE fecha = $1 AND hora = $2 AND id_pista = $3 AND id_pista IN (SELECT id FROM pista WHERE estado = true)";
    $stmt = pg_prepare($conn, "check_availability", $sql);
    $result = pg_execute($conn, "check_availability", array($fecha, $hora, $id_pista));

    return pg_num_rows($result) === 0; 
}


// Agregar una nueva reserva
function agregarReserva($nombre, $fecha, $hora, $id_pista) {
     $conn = Database::getConnection();
    
    if (estaDisponible($fecha, $hora, $id_pista)) {
        $sql = "INSERT INTO reservas (nombre, fecha, hora, id_pista) VALUES ($1, $2, $3, $4)";
        $stmt = pg_prepare($conn, "insert_reserva", $sql);
        $result = pg_execute($conn, "insert_reserva", array($nombre, $fecha, $hora, $id_pista));
        
        if ($result) {
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
    $conn = Database::getConnection();
    $sql = "DELETE FROM reservas WHERE id = $1";

    $stmt = pg_prepare($conn, "delete_reserva", $sql);
    $result = pg_execute($conn, "delete_reserva", array($id));

    $sql2 = "UPDATE pistas SET estado = false FROM reservas WHERE id = $id";
    $stmt = pg_query($conn, $sql2);

    return $result ? "Reserva cancelada con exito." : "Error al cancelar la reserva.";
}

?>
