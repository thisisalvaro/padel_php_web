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
    <link rel="stylesheet" href="<?php echo base_url('css/reservations.css'); ?>">
</head>
<body>
    <main class="container">
        <h1 class="title">Reservar una Pista de Pádel</h1>

        <section class="form-container">
            <form method="GET">
                <div class="input-group">
                    <label for="fecha">Selecciona un día:</label>
                    <input type="date" name="fecha" id="fecha" value="<?= htmlspecialchars($fechaSeleccionada) ?>" required>
                </div>

                <div class="input-group">
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
                </div>

                <button type="submit" class="btn">Consultar Disponibilidad</button>
            </form>
        </section>

        <div class="availability">
            <h2 class="subtitle">Disponibilidad de Pistas</h2>
            <p class="info">Para el día <strong>2025-02-27</strong> a las <strong>11:00</strong></p>
        </div>

        <div class="table-container">
            <table class="reservation-table">
                <thead>
                    <tr>
                        <th>Pista</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($pistas as $pista) {
                        $ocupado = verificarConflicto($fechaSeleccionada, $horaSeleccionada, $pista['id']);
                        $estado = $ocupado ? "<span class='status reserved'>Reservada</span>" : "<span class='status available'>Disponible</span>";
                        echo "<tr><td>" . htmlspecialchars($pista['nombre']) . "</td><td>$estado</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </main>
</body>
</html>
