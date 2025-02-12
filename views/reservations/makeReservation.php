<?php
require_once __DIR__ . '/../../app/reservations/reservationController.php';
require_once __DIR__ . '/../../app/reservations/calendarService.php';

$reservation = new ReservationController();
$calendar = new calendarService();
$fecha = isset($_POST['fecha']) ? $_POST['fecha'] : '';
$id_pista = isset($_POST['id_pista']) ? $_POST['id_pista'] : '';
$hora = isset($_POST['hora']) ? $_POST['hora'] : '';

$pistasDisponibles = $reservation->obtenerPistasDisponibles();
$horariosDisponibles = [];

if ($fecha && $id_pista) {
    // Obtener horarios disponibles, pero filtrar los ocupados
    $reservas = $reservation->obtenerReservasPorFechaYPista($fecha, $id_pista);
    $horarios = ['08:00', '09:00', '10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00', '17:00', '18:00', '19:00', '20:00'];
    
    // Filtrar las horas ocupadas
    $horariosDisponibles = array_diff($horarios, $reservas);
}

if ($fecha && $id_pista && $hora && $user_id) {
    $resultado = $reservation->agregarReserva($fecha, $hora, $id_pista, $user_id);
    echo "<script>alert('$resultado');</script>";
    header('Location: ' . base_url('reservations/make')); 
    exit; // Detener la ejecución después de redirigir
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Realizar Reserva</title>
    <link rel="stylesheet" href="<?php echo base_url('css/make.css'); ?>">
    <script>
        function seleccionarPista(id, nombre, ubicacion) {
            document.getElementById('id_pista').value = id;
            document.getElementById('pista_seleccionada').innerText = nombre + ' - ' + ubicacion;
            document.forms['reservaForm'].submit(); // Enviar el formulario después de seleccionar la pista
        }
    </script>
</head>
<body>
    <div class="container">
        <header>
            <h1>Realizar Reserva</h1>
        </header>
        <form id="reservaForm" action="<?php echo base_url('reservations/make'); ?>" method="post">
            <div class="form-group">
                <label for="fecha">Fecha:</label>
                <input type="date" id="fecha" name="fecha" value="<?php echo htmlspecialchars($fecha ?? ''); ?>" required onchange="this.form.submit()">
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
                <select id="hora" name="hora" required>
                    <option value="">Seleccione una hora</option>
                    <?php foreach ($horariosDisponibles as $horaDisponible): ?>
                        <option value="<?php echo htmlspecialchars($horaDisponible); ?>"><?php echo htmlspecialchars($horaDisponible); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit">Reservar</button>
        </form>
    </div>
</body>
</html>
