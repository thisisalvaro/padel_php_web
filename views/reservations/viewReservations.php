<?php
require_once __DIR__ .'/../../config/db.php';

$fechaSeleccionada = $_GET['fecha'] ?? date("Y-m-d");
$horaSeleccionada = $_GET['hora'] ?? "08:00";

// Obtener las pistas disponibles desde la base de datos
$pistas = obtenerPistas();

/**
 * Función para obtener todas las pistas disponibles.
 * @return array
 */
function obtenerPistas() {
    $conn = Database::getConnection();

    $sql = "SELECT id, nombre FROM pistas";
    $result = pg_query($conn, $sql);

    if (!$result) {
        throw new Exception('Error ejecutando la consulta: ' . pg_last_error($conn));
    }

    $pistas = [];
    while ($row = pg_fetch_assoc($result)) {
        $pistas[] = $row;
    }

    return $pistas;
}

/**
 * Función para verificar si una pista está ocupada en una fecha y hora específicas.
 * @param string $fecha
 * @param string $hora
 * @param int $idPista
 * @return bool
 */
function verificarConflicto($fecha, $hora, $idPista) {
    $conn = Database::getConnection();

    $sql = "SELECT COUNT(*) as total FROM reservas WHERE fecha = $1 AND hora = $2 AND id_pista = $3";
    $result = pg_query_params($conn, $sql, array($fecha, $hora, $idPista));

    if (!$result) {
        throw new Exception('Error ejecutando la consulta: ' . pg_last_error($conn));
    }

    $row = pg_fetch_assoc($result);

    return $row['total'] > 0;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservas de Pistas</title>
    <link rel="stylesheet" href="styles.css">
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
        foreach ($pistas as $pista) {
            $ocupado = verificarConflicto($fechaSeleccionada, $horaSeleccionada, $pista['id']);
            $clase = $ocupado ? "reservado" : "disponible";
            $estado = $ocupado ? "Reservada 🔴" : "Disponible 🟢";
            echo "<div class='pista $clase'>Pista " . htmlspecialchars($pista['nombre']) . " - $estado</div>";
        }
        ?>
    </div>
</body>
</html>