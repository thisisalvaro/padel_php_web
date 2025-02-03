<?php
// vista (html) para realizar una reserva, incluyendo un formulario con la fecha, hora y cancha seleccionada

include_once '../../config/db.php';
include_once '../../services/calendarService.php';

$fecha = $_POST['fecha'] ?? '';
$cancha = $_POST['cancha'] ?? '';
$horariosDisponibles = [];

if ($fecha && $cancha) {
    $horariosDisponibles = obtenerHorariosDisponibles($fecha, $cancha);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Realizar Reserva</title>
</head>
<body>
    <h1>Realizar Reserva</h1>
    <form action="makeReservation.php" method="post">
        <label for="fecha">Fecha:</label>
        <input type="date" id="fecha" name="fecha" value="<?php echo htmlspecialchars($fecha); ?>" required>
        <br>
        <label for="cancha">Cancha:</label>
        <input type="number" id="cancha" name="cancha" value="<?php echo htmlspecialchars($cancha); ?>" required>
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
</body>
</html>