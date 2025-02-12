<?php
// controlador para gestionar la lógica de los tips: cargar los tips disponibles desde la base de datos y servirlos a las vistas
require_once __DIR__ .'/../../config/config.php';
require_once __DIR__ .'/../models/Tip.php';

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

    $tips = [];
    while ($row = pg_fetch_row($response)) {
        $tip = new Tip();
        $tip->setId($row[0]);
        $tip->setTitulo($row[1]);
        $tip->setDescripcion($row[2]);
        $tip->setEnlace($row[3]);
        $tip->setCategoria_Id($row[4]);
        $tip->setImagen($row[5]);
        array_push($tips, $tip);
    }
    return $tips;
}


// método para listar la imagen y el titulo de las aydas de una categoria por el id de la categoria
public function listImageAndTittleOfHelpsByCategoriesId($id) {
    $response = pg_query(Database::getConnection(), "SELECT id, titulo, imagen FROM ayudas WHERE categoria_id = $id");
    $tips = [];

    while ($row = pg_fetch_row($response)) {
        
        $tip = new Tip();
        $tip->setId($row[0]);
        //$tip-echo "id: $row[0]  titulo: $row[1]  imagen: $row[2]";
        $tip->setImagen($row[2]);
        array_push($tips, $tip);
    }
    return $tips;
}


// método para listar una ayuda por su id
public function listHelpById($id) {
    $response = pg_query(Database::getConnection(), "SELECT * FROM ayudas WHERE id = $id");

    while ($row = pg_fetch_row($response)) {
        $tip = new Tip();
        $tip->setId($row[0]);
        $tip->setTitulo($row[1]);
        $tip->setDescripcion($row[2]);
        $tip->setEnlace($row[3]);
        $tip->setCategoria_Id($row[4]);
        $tip->setImagen($row[5]);
        return $tip;
    }
}
}