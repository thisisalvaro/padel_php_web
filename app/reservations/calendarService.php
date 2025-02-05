<?php
// Archivo con funciones específicas para manejar calendarios, horarios disponibles y conflictos de horarios

require_once 'db.php'; // Archivo de conexión a la base de datos

// Obtener todos los horarios disponibgit pullles para una fecha y cancha específica
function obtenerHorariosDisponibles($fecha, $id_pista) {
    $horarios = ['08:00', '09:00', '10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00', '17:00', '18:00', '19:00', '20:00'];
    
    if ($fecha == null || $id_pista == null) {
        return [];
    }
    
    $reservas = obtenerReservasPorFechaYPista($fecha, $id_pista);
    
    // Filtra los horarios ocupados
    return array_diff($horarios, $reservas);
}
?>
