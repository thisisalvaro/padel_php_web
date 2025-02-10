<?php
//require_once '../../config/db.php';
//require_once 'reservationController.php';
class CalendarService {
function obtenerHorariosDisponibles($fecha, $id_pista) {
    $reservationcontroller = new ReservationController();

    $horarios = ['08:00', '09:00', '10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00', '17:00', '18:00', '19:00', '20:00'];
    
    if ($fecha == null || $id_pista == null) {
        return [];
    }
    
    $reservas = $reservationcontroller->obtenerReservasPorFechaYPista($fecha, $id_pista);
    
    return array_diff($horarios, $reservas);
}
}
?>