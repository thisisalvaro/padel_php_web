<?php
require_once  __DIR__ . '/../../app/reservations/reservationController.php';

class CalendarService {
    function obtenerHorariosDisponibles($fecha, $id_pista) {
        $reservationcontroller = new ReservationController();

        $horarios = ['08:00', '09:00', '10:00', '11:00', '12:00', '13:00', 
                     '14:00', '15:00', '16:00', '17:00', '18:00', '19:00', '20:00'];

        if (empty($fecha) || empty($id_pista)) {
            return [];
        }

        // Formatear la fecha correctamente
        $fecha = date('Y-m-d', strtotime($fecha));

        // Obtener reservas
        $reservas = $reservationcontroller->obtenerReservasPorFechaYPista($fecha, $id_pista);
        $reservas = $reservas ?: []; // Asegurar que es un array

        // Normalizar formato de horas si es necesario
        $reservas = array_map(function($hora) {
            return sprintf('%02d:00', intval($hora));
        }, $reservas);

        // Obtener las horas disponibles
        $horariosDisponibles = array_diff($horarios, $reservas);

        return $horariosDisponibles;
    }
}
?>