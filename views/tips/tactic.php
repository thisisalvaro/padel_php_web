<?php
require_once __DIR__ .'/../../app/tips/tipsController.php';
$tipsController = new TipsController();
$result = $tipsController->listHelpsByCategoriesId(3);
foreach ($result as $row) {
    echo $row->getTitulo();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Táctica - Padel Tips</title>
    <link rel="stylesheet" href="<?php echo base_url('css/tips.css'); ?>">
    <link rel="icon" href="<?php echo base_url('images/raqueta-de-padel.png'); ?>">
</head>
<body>

    

</body>
</html>