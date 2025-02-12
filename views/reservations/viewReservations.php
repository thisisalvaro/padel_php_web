<?php
require_once(__DIR__ . '/../../app/reservations/ReservationController.php');

$reservationController = new ReservationController();
$fecha = isset($_GET['fecha']) ? $_GET['fecha'] : '';
$reservas = $fecha ? $reservationController->obtenerReservasPorFecha($fecha) : [];

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ver Reservas</title>
    <link rel="stylesheet" href="<?php echo base_url('css/reservations.css'); ?>">
    <style>

        h1 {
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
            background-color:rgb(0, 180, 42); /* Verde claro */
            color: #155724;
        }
        .no-disponible {
            background-color:rgb(255, 0, 21); /* Rojo claro */
            color:rgb(255, 0, 25);
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
</head>
<body>
    <div class="container">
        <header>
            <h1>Reservas</h1>
        </header>
        <form action="<?php echo base_url('reservations/view'); ?>" method="get">
            <label for="fecha">Fecha:</label>
            <input type="date" id="fecha" name="fecha" value="<?php echo htmlspecialchars($fecha); ?>" required>
            <button type="submit">Filtrar</button>
        </form>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Pista</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($reservas as $reserva): ?>
                    <tr class="no-disponible">
                        <td><?php echo htmlspecialchars($reserva['id']); ?></td>
                        <td><?php echo htmlspecialchars($reserva['nombre_pista']); ?></td>
                        <td><?php echo htmlspecialchars($reserva['fecha']); ?></td>
                        <td><?php echo htmlspecialchars($reserva['hora']); ?></td>
                        <td><?php echo htmlspecialchars($reserva['id_pista']); ?></td>
                        <td>No Disponible</td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>