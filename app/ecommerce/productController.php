<?php
//require_once '../../config/config.php';

class ListProductController {

    private $connection;

    public function __construct() {
        $this->connection = Database::getConnection();
    }

    public function listProduct($search = '', $categoria = '', $minPrice = '', $maxPrice = '') {
        $query = "
            SELECT productos.id, productos.nombre, productos.descripcion, productos.precio, productos.categoria, 
                   productos.marca, productos.stock, imagenes.url 
            FROM productos 
            LEFT JOIN imagenes ON productos.id = imagenes.producto_id
            WHERE 1=1
        ";
    
        $params = [];
        
        if (!empty($search)) {
            $query .= " AND productos.nombre ILIKE $".(count($params) + 1);
            $params[] = "%$search%";
        }
    
        if (!empty($categoria)) {
            $query .= " AND productos.categoria = $".(count($params) + 1);
            $params[] = $categoria;
        }
    
        if (!empty($minPrice)) {
            $query .= " AND productos.precio >= $".(count($params) + 1);
            $params[] = $minPrice;
        }
    
        if (!empty($maxPrice)) {
            $query .= " AND productos.precio <= $".(count($params) + 1);
            $params[] = $maxPrice;
        }
    
        $query .= " ORDER BY productos.precio ASC";
    
        $response = pg_query_params($this->connection, $query, $params);
    
        if (!$response) {
            echo "Error en la consulta: " . pg_last_error($this->connection);
            return [];
        }
    
        $productos = [];
    
        while ($row = pg_fetch_assoc($response)) {
            $id = $row['id'];
    
            if (!isset($productos[$id])) {
                $productos[$id] = [
                    'id' => $row['id'],
                    'nombre' => $row['nombre'],
                    'descripcion' => $row['descripcion'],
                    'precio' => $row['precio'],
                    'categoria' => $row['categoria'],
                    'marca' => $row['marca'],
                    'stock' => $row['stock'],
                    'imagenes' => []
                ];
            }
    
            if (!empty($row['url'])) {
                $productos[$id]['imagenes'][] = $row['url'];
            }
        }
    
        return $productos;
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

    $producto;
    
    // Organizar datos en un array asociativo
    while ($row = pg_fetch_assoc($response)) {

        // Si el producto no está en el array, lo inicializamos
            $producto = [
                'id' => $row['id'],
                'nombre' => $row['nombre'],
                'descripcion' => $row['descripcion'],
                'precio' => $row['precio'],
                'categoria' => $row['categoria'],
                'marca' => $row['marca'],
                'stock' => $row['stock'],
                'imagenes' => [] // Inicializamos un array para las imágenes
            ];

        // Agregar la imagen si existe
        if (!empty($row['url'])) {
            $producto['imagenes'][] = $row['url'];
        }
    }
    return $producto;
    }

    



}

