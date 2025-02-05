<?php
// vista (html) para que el usuario vea sus reservas actuales o pasadas
require_once '../../services/calendarService.php';
    require_once '../../config/db.php';

$fechaSeleccionada = $_GET['fecha'] ?? date("Y-m-d");
$horaSeleccionada = $_GET['hora'] ?? "08:00";

// Obtener las pistas disponibles (en este caso, suponemos 4 pistas)
$pistas = [1, 2, 3, 4];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservas de Pistas</title>
    <link rel="stylesheet" href="/padel/css/reservations.css">
</head>
<body>
    <h1>Reservar una Pista de Pádel</h1>

    <form method="GET">
        <label for="fecha">Selecciona un día:</label>
        <input type="date" name="fecha" id="fecha" value="<?= htmlspecialchars($fechaSeleccionada) ?>" required>

        <label for="hora">Selecciona una hora:</label>
        <select name="hora" id="hora">
            <?php
            $horarios = ['08:00', '09:00', '10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00', '17:00', '18:00', '19:00', '20:00'];
            foreach ($horarios as $hora) {
                $selected = ($hora === $horaSeleccionada) ? "selected" : "";
                echo "<option value='" . htmlspecialchars($hora) . "' $selected>" . htmlspecialchars($hora) . "</option>";
            }
            ?>
        </select>
        <button type="submit">Consultar Disponibilidad</button>
    </form>

    <h2>Disponibilidad de Pistas para <?= htmlspecialchars($fechaSeleccionada) ?> a las <?= htmlspecialchars($horaSeleccionada) ?></h2>
    <div class="pistas">
        <?php
        foreach ($pistas as $cancha) {
            $ocupado = verificarConflicto($fechaSeleccionada, $horaSeleccionada, $cancha);
            $clase = $ocupado ? "reservado" : "disponible";
            $estado = $ocupado ? "Reservada 🔴" : "Disponible 🟢";
            echo "<div class='pista $clase'>Pista $cancha - $estado</div>";
        }
        ?>
    </div>
</body>
</html>
