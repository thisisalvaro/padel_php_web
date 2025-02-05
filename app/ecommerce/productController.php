<?php
require_once '../../config/config.php';

class ListProductController {

    private $connection;

    public function __construct( $connection) {
        $this->connection = $connection;
    }

    public function listProduct() {
        $response = pg_query($this->connection, "SELECT * FROM productos");
    
        while ($row = pg_fetch_row($response)) {
            echo "id: $row[0]  nombre: $row[1] descripcion: $row[2] precio: $row[3] categoria: $row[4] marca: $row[5] stock: $row[6]";
            echo "<br />\n";
        }
    }

}


$controller = new ListProductController( Database::getConnection());
$controller->listProduct();