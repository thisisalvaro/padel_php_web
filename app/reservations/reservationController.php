<?php
require_once __DIR__ .'/../../config/db.php';

class ReservationController {

    // Obtener todas las reservas
    function obtenerReservas() {
        $conn = Database::getConnection();

        $sql = "SELECT id, nombre, fecha, hora, id_pista FROM reservas";
        $result = pg_query($conn, $sql);

        if (!$result) {
            throw new Exception('Error ejecutando la consulta: ' . pg_last_error($conn));
        }

        $reservas = [];
        while ($row = pg_fetch_assoc($result)) {
            $reservas[] = $row;
        }

        return $reservas;
    }

    // Obtener las reservas para una fecha y cancha específica
    function obtenerReservasPorFechaYPista($fecha, $id_pista) {
        $conn = Database::getConnection();
    
        // Validar si los parámetros son válidos
        if (empty($fecha) || empty($id_pista)) {
            throw new InvalidArgumentException('Fecha o ID de pista no pueden ser nulos');
        }
    
        // Formatear la fecha si es necesario
        $fecha = date('Y-m-d', strtotime($fecha));
    
        // Preparar la consulta SQL
        $sql = "SELECT hora FROM reservas WHERE fecha = $1 AND id_pista = $2";
        $stmt = pg_prepare($conn, "obtener_reservas", $sql);
    
        // Ejecutar la consulta con parámetros
        $result = pg_execute($conn, "obtener_reservas", array($fecha, $id_pista));
    
        if (!$result) {
            throw new Exception('Error ejecutando la consulta: ' . pg_last_error($conn));
        }
    
        $horasReservadas = [];
        while ($fila = pg_fetch_assoc($result)) {
            $horasReservadas[] = $fila['hora'];
        }
    
        return $horasReservadas;
    }
    
    // Verificar disponibilidad de una cancha en una fecha y hora específicas
    function estaDisponible($fecha, $hora, $id_pista) {
        $conn = Database::getConnection();

        if ($fecha == null || $hora == null || $id_pista == null) {
            return false;
        }

        $sql = "SELECT * FROM reservas WHERE fecha = $1 AND hora = $2 AND id_pista = $3";
        $stmt = pg_prepare($conn, "check_availability_$fecha$hora$id_pista", $sql);
        $result = pg_execute($conn, "check_availability_$fecha$hora$id_pista", array($fecha, $hora, $id_pista));

        if (!$result) {
            throw new Exception('Error ejecutando la consulta: ' . pg_last_error($conn));
        }

        return pg_num_rows($result) === 0;
    }

    // Agregar una nueva reserva
    public function agregarReserva($fecha, $hora, $id_pista, $user_id) {
        $conn = Database::getConnection();
        
        // Validar los parámetros
        if (empty($fecha) || empty($hora) || empty($id_pista) || empty($user_id)) {
            return 'Todos los campos son requeridos.';
        }
    
        // Verificar si ya hay una reserva para esta pista y hora
        $sql = "SELECT * FROM reservas WHERE fecha = $1 AND hora = $2 AND id_pista = $3";
        $stmt = pg_prepare($conn, "", $sql);
        $result = pg_execute($conn, "", array($fecha, $hora, $id_pista));
    
        if (pg_num_rows($result) > 0) {
            return 'La pista ya está reservada en esa hora. Por favor elija otra hora.';
        }
    
        // Si no hay conflictos, proceder con la reserva
        $sql_insert = "INSERT INTO reservas (fecha, hora, id_pista, user_id) VALUES ($1, $2, $3, $4)";
        $stmt_insert = pg_prepare($conn, "", $sql_insert);
        $result_insert = pg_execute($conn, "", array($fecha, $hora, $id_pista, $user_id));
    
        if (!$result_insert) {
            error_log('Error al realizar la reserva: ' . pg_last_error($conn));
            return 'Error al realizar la reserva: ' . pg_last_error($conn);
        }
    
        error_log('Reserva realizada con éxito.');
        return 'Reserva realizada con éxito.';
    }
    // Obtener todas las pistas disponibles
    function obtenerPistasDisponibles() {
        $conn = Database::getConnection();

        $sql = "SELECT id, nombre, ubicacion FROM pistas WHERE estado = true";
        $result = pg_query($conn, $sql);

        if (!$result) {
            throw new Exception('Error ejecutando la consulta: ' . pg_last_error($conn));
        }

        $pistasDisponibles = [];
        while ($fila = pg_fetch_assoc($result)) {
            $pistasDisponibles[] = $fila;
        }

        return $pistasDisponibles;
    }

    // Obtener todas las reservas para una fecha específica
    function obtenerReservasPorFecha($fecha) {
        $conn = Database::getConnection();
    
        // Consulta con INNER JOIN para obtener información de la pista reservada
        $sql = "SELECT r.id, r.fecha, r.hora, r.id_pista, p.nombre AS nombre_pista, p.ubicacion, p.tipo 
                FROM reservas r
                INNER JOIN pistas p ON r.id_pista = p.id
                WHERE r.fecha = $1
                ORDER BY r.hora";
    
        // Preparar y ejecutar la consulta de manera segura
        $stmt = pg_prepare($conn, "reservas_por_fecha", $sql);
        $result = pg_execute($conn, "reservas_por_fecha", array($fecha));
    
        if (!$result) {
            throw new Exception('Error ejecutando la consulta: ' . pg_last_error($conn));
        }
    
        $reservas = [];
        while ($row = pg_fetch_assoc($result)) {
            $reservas[] = $row;
        }
    
        return $reservas;
    }
    
}
?>