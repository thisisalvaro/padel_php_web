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
 <style>

        h1 {
            color: var(--yellow);
        }

        h2 {
            color: var(--yellow);
        }

        button{
            background-color:var(--yellow);
            color: black;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            cursor: pointer;
            width: 100%;
        }
        .disponible {
            background-color:rgb(59, 176, 87); /* Verde claro */
            color: #155724;
        }
        .no-disponible {
            background-color:rgb(228, 72, 85); /* Rojo claro */
            color: #721c24;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        th, td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: var(--dark-gray);
            color: var(--white);
        }
    </style>
<body>
    <div class="container">
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

        <h2 class="subtitle">Disponibilidad de Pistas</h2>
        <p class="info">Para el día <?= htmlspecialchars($fechaSeleccionada) ?> a las <?= htmlspecialchars($horaSeleccionada) ?></p>

        <table>
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
                    $clase = $ocupado ? "no-disponible" : "disponible";
                    $estado = $ocupado ? "Reservada 🔴" : "Disponible 🟢";
                    echo "<tr class='$clase'><td>" . htmlspecialchars($pista['nombre']) . "</td><td>$estado</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
