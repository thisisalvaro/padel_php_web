<?php
require_once '../../config/db.php';

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

        if ($fecha == null || $id_pista == null) {
            return [];
        }

        $sql = "SELECT hora FROM reservas WHERE fecha = $1 AND id_pista = $2";
        $stmt = pg_prepare($conn, "", $sql);
        $result = pg_execute($conn, "", array($fecha, $id_pista));

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
    function agregarReserva($nombre, $fecha, $hora, $id_pista) {
        $conn = Database::getConnection();

        if ($this->estaDisponible($fecha, $hora, $id_pista)) {
            $sql = "INSERT INTO reservas (nombre, fecha, hora, id_pista) VALUES ($1, $2, $3, $4)";
            $stmt = pg_prepare($conn, "insert_reserva_$fecha$hora$id_pista", $sql);
            $result = pg_execute($conn, "insert_reserva_$fecha$hora$id_pista", array($nombre, $fecha, $hora, $id_pista));

            if ($result) {
                return "Reserva realizada con éxito.";
            } else {
                return "Error al realizar la reserva: " . pg_last_error($conn);
            }
        } else {
            return "Horario no disponible.";
        }
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

        $sql = "SELECT id, nombre, fecha, hora, id_pista FROM reservas WHERE fecha = $1";
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