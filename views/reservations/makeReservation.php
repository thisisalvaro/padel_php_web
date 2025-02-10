<?php
/*include_once '../../config/db.php';
include_once '../../app/reservations/calendarService.php';
include_once '../../app/reservations/reservationController.php';*/

$reservation = new ReservationController();
$fecha = isset($_POST['fecha']) ? $_POST['fecha'] : '';
$id_pista = isset($_POST['id_pista']) ? $_POST['id_pista'] : '';
$hora = isset($_POST['hora']) ? $_POST['hora'] : '';
$nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';

$pistasDisponibles = $reservation->obtenerPistasDisponibles();
$horariosDisponibles = [];

if ($fecha && $id_pista) {
    $horariosDisponibles = obtenerHorariosDisponibles($fecha, $id_pista);
}

if ($fecha && $id_pista && $hora && $nombre) {
    $resultado = $reservation->agregarReserva($nombre, $fecha, $hora, $id_pista);
    echo "<script>alert('$resultado');</script>";
    if ($fecha && $id_pista && $hora && $nombre) {
        $resultado = $reservation->agregarReserva($nombre, $fecha, $hora, $id_pista);
        echo "<script>alert('$resultado');</script>";
        header('Location: ' . base_url('reservations/make')); 
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Realizar Reserva</title>
    <link rel="stylesheet" href="/padel/css/reservations.css">
    <script>
        function seleccionarPista(id, nombre, ubicacion) {
            document.getElementById('id_pista').value = id;
            document.getElementById('pista_seleccionada').innerText = nombre + ' - ' + ubicacion;
            document.forms['reservaForm'].submit();
        }
    </script>
</head>
<body>
    <div class="container">
        <header>
            <h1>Realizar Reserva</h1>
        </header>
        <form id="reservaForm" action="makeReservation.php" method="post">
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" value="<?php echo htmlspecialchars($nombre); ?>" required>
            </div>
            <div class="form-group">
                <label for="fecha">Fecha:</label>
                <input type="date" id="fecha" name="fecha" value="<?php echo htmlspecialchars($fecha); ?>" required onchange="this.form.submit()">
            </div>
            <div class="form-group">
                <label for="pistas">Pistas Disponibles:</label>
                <ul id="pistas">
                    <?php foreach ($pistasDisponibles as $pista): ?>
                        <li onclick="seleccionarPista('<?php echo htmlspecialchars($pista['id']); ?>', '<?php echo htmlspecialchars($pista['nombre']); ?>', '<?php echo htmlspecialchars($pista['ubicacion']); ?>')">
                            <?php echo htmlspecialchars($pista['nombre'] . ' - ' . $pista['ubicacion']); ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
                <input type="hidden" id="id_pista" name="id_pista" value="<?php echo htmlspecialchars($id_pista); ?>">
                <p>Pista seleccionada: <span id="pista_seleccionada"><?php echo htmlspecialchars($id_pista ? $pistasDisponibles[array_search($id_pista, array_column($pistasDisponibles, 'id'))]['nombre'] . ' - ' . $pistasDisponibles[array_search($id_pista, array_column($pistasDisponibles, 'id'))]['ubicacion'] : ''); ?></span></p>
            </div>
            <div class="form-group">
                <label for="hora">Hora:</label>
                <select id="hora" name="hora" required>
                    <option value="">Seleccione una hora</option>
                    <?php foreach ($horariosDisponibles as $hora): ?>
                        <option value="<?php echo htmlspecialchars($hora); ?>"><?php echo htmlspecialchars($hora); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit">Reservar</button>
        </form>
    </div>
</body>
</html>