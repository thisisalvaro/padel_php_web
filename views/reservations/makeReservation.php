<?php
include_once '../config/db.php';
include_once '../services/calendarService.php';
include_once '../controllers/reservationController.php';

$reservation= new ReservationController();
$fecha = isset($_POST['fecha']) ? $_POST['fecha'] : '';
$pistasDisponibles = $reservation->obtenerPistasDisponibles();
$horariosDisponibles = [];

if ($fecha) { 
    $id_pista = isset($_POST['id_pista']) ? $_POST['id_pista'] : '';
    if ($id_pista) {
        $horariosDisponibles = obtenerHorariosDisponibles($fecha, $id_pista);
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Realizar Reserva</title>
    <link rel="stylesheet" href="/padel/css/reservations.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Realizar Reserva</h1>
        </header>
        <form action="makeReservation.php" method="post">
            <label for="fecha">Fecha:</label>
            <input type="date" id="fecha" name="fecha" value="<?php echo htmlspecialchars($fecha); ?>" required>
            <br>
            <label for="id_pista">Pista:</label>
            <select id="id_pista" name="id_pista" required>
                <?php foreach ($pistasDisponibles as $pista): ?>
                    <option value="<?php echo htmlspecialchars($pista['id']); ?>">
                        <?php echo htmlspecialchars($pista['nombre'] . ' - ' . $pista['ubicacion']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <br>
            <label for="hora">Hora:</label>
            <select id="hora" name="hora" required>
                <?php foreach ($horariosDisponibles as $hora): ?>
                    <option value="<?php echo htmlspecialchars($hora); ?>"><?php echo htmlspecialchars($hora); ?></option>
                <?php endforeach; ?>
            </select>
            <br>
            <button type="submit">Reservar</button>
        </form>
    </div>
</body>
</html>
