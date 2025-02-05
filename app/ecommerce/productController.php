<?php
require_once '../../config/config.php';

class ListProductController {

    private $connection;

    public function __construct() {
        $this->connection = Database::getConnection();
    }

    public function listProduct() {
        $response = pg_query($this->connection, "
            SELECT productos.id, productos.nombre, productos.descripcion, productos.precio, productos.categoria, 
                   productos.marca, productos.stock, imagenes.url 
            FROM productos 
            LEFT JOIN imagenes ON productos.id = imagenes.producto_id
        ");
    
        if (!$response) {
            echo "Error en la consulta: " . pg_last_error($this->connection);
            return;
        }
    
        $productos = [];
        
        // Organizar datos en un array asociativo
        while ($row = pg_fetch_assoc($response)) {
            $id = $row['id'];
    
            // Si el producto no está en el array, lo inicializamos
            if (!isset($productos[$id])) {
                $productos[$id] = [
                    'id' => $row['id'],
                    'nombre' => $row['nombre'],
                    'descripcion' => $row['descripcion'],
                    'precio' => $row['precio'],
                    'categoria' => $row['categoria'],
                    'marca' => $row['marca'],
                    'stock' => $row['stock'],
                    'imagenes' => [] // Inicializamos un array para las imágenes
                ];
            }
    
            // Agregar la imagen si existe
            if (!empty($row['url'])) {
                $productos[$id]['imagenes'][] = $row['url'];
            }
        }
        return $productos;

        // foreach ($productos as $producto) {
        //     echo "<b>ID:</b> {$producto['id']} <b>Nombre:</b> {$producto['nombre']} <b>Descripción:</b> {$producto['descripcion']} 
        //           <b>Precio:</b> {$producto['precio']} <b>Categoría:</b> {$producto['categoria']} <b>Marca:</b> {$producto['marca']} 
        //           <b>Stock:</b> {$producto['stock']}<br><b>IMÁGENES:</b> ";
    
        //     // Mostrar todas las imágenes del producto
        //     if (!empty($producto['imagenes'])) {
        //         foreach ($producto['imagenes'] as $imagen) {
        //             echo " [$imagen ";
        //         }
        //     } else {
        //         echo "[Sin imágenes.";
        //     }
    
        //     echo "]<br><hr>";
        // }
    }

    public function listProductById($id) {
        $response = pg_query($this->connection, "
        SELECT productos.id, productos.nombre, productos.descripcion, productos.precio, productos.categoria, 
               productos.marca, productos.stock, imagenes.url 
        FROM productos 
        LEFT JOIN imagenes ON productos.id = imagenes.producto_id WHERE productos.id = $id
    ");

    if (!$response) {
        echo "Error en la consulta: " . pg_last_error($this->connection);
        return;
    }

    $productos = [];
    
    // Organizar datos en un array asociativo
    while ($row = pg_fetch_assoc($response)) {
        $id = $row['id'];

        // Si el producto no está en el array, lo inicializamos
        if (!isset($productos[$id])) {
            $productos[$id] = [
                'id' => $row['id'],
                'nombre' => $row['nombre'],
                'descripcion' => $row['descripcion'],
                'precio' => $row['precio'],
                'categoria' => $row['categoria'],
                'marca' => $row['marca'],
                'stock' => $row['stock'],
                'imagenes' => [] // Inicializamos un array para las imágenes
            ];
        }

        // Agregar la imagen si existe
        if (!empty($row['url'])) {
            $productos[$id]['imagenes'][] = $row['url'];
        }
    }
    return $productos;
    }

}

