<?php
// controlador para gestionar la lógica de los tips: cargar los tips disponibles desde la base de datos y servirlos a las vistas
require_once '../../config/config.php';

class TipsController  {
// método para listar las categorias
public function listCategories() {
    $response = pg_query(Database::getConnection(), "SELECT * FROM categorias");

    while ($row = pg_fetch_row($response)) {
        echo "id: $row[0]  nombre: $row[1]";
        echo "<br />\n";
    }
}


// método para listar las aydas de una categoria
public function listHelpsByCategoriesId($id) {
    $response = pg_query(Database::getConnection(), "SELECT * FROM ayudas WHERE categoria_id = $id");

    while ($row = pg_fetch_row($response)) {
        echo "id: $row[0]  titulo: $row[1]  descricpcion: $row[2]  enlace: $row[3]  categoria_id: $row[4]  imagen: $row[5]";
        echo "<br />\n";
    }
}


// método para listar la imagen y el titulo de las aydas de una categoria
public function listImageAndTittleOfHelpsByCategoriesId($id) {
    $response = pg_query(Database::getConnection(), "SELECT id, titulo, imagen FROM ayudas WHERE categoria_id = $id");

    while ($row = pg_fetch_row($response)) {
        echo "id: $row[0]  titulo: $row[1]  imagen: $row[2]";
        echo "<br />\n";
    }
}


// método para listar una ayuda por su id
public function listHelpById($id) {
    $response = pg_query(Database::getConnection(), "SELECT * FROM ayudas WHERE id = $id");

    while ($row = pg_fetch_row($response)) {
        echo "id: $row[0]  titulo: $row[1]  descricpcion: $row[2]  enlace: $row[3]  categoria_id: $row[4]  imagen: $row[5]";
        echo "<br />\n";
    }
}
}

$tipsControler = new TipsController();
$tipsControler->listHelpById(3);