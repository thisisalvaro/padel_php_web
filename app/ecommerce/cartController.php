<?php

class CartController {

    // Método para agregar un producto al carrito
    public function addProduct($productId, $quantity, $userId) {
        // Obtener la conexión
        $db = Database::getConnection();

        // Comprobar si el producto ya está en el carrito del usuario
        $query = "SELECT * FROM carrito WHERE producto_id = $productId AND usuario_id = $userId";
        $result = pg_query($db, $query);

        if (!$result) {
            echo "Error al realizar la consulta.";
            return;
        }

        $existingProduct = pg_fetch_assoc($result);

        if ($existingProduct) {
            // Si el producto ya está en el carrito, actualizar la cantidad
            $newQuantity = $existingProduct['cantidad'] + $quantity;
            $updateQuery = "UPDATE carrito SET cantidad = $newQuantity WHERE producto_id = $productId AND usuario_id = $userId";
            pg_query($db, $updateQuery);
        } else {
            // Si el producto no está en el carrito, insertarlo
            $insertQuery = "INSERT INTO carrito (producto_id, usuario_id, cantidad) VALUES ($productId, $userId, $quantity)";
            pg_query($db, $insertQuery);
        }
    }

    // Método para eliminar un producto del carrito
    public function removeProduct($productId, $userId) {
        // Obtener la conexión
        $db = Database::getConnection();

        // Eliminar el producto del carrito del usuario
        $query = "DELETE FROM carrito WHERE producto_id = $productId AND usuario_id = $userId";
        $result = pg_query($db, $query);

        if (!$result) {
            echo "Error al eliminar el producto.";
            return;
        }

        if (pg_affected_rows($result) == 0) {
            echo "Producto no encontrado en el carrito.";
        }
    }

    // Método para calcular el total del carrito de un usuario
    public function calcTotal($userId) {
        // Obtener la conexión
        $db = Database::getConnection();

        $total = 0;

        // Obtener todos los productos del carrito del usuario
        $query = "SELECT carrito.cantidad, productos.precio FROM carrito 
                  JOIN productos ON carrito.producto_id = productos.id
                  WHERE carrito.usuario_id = $userId";
        $result = pg_query($db, $query);

        if (!$result) {
            echo "Error al calcular el total.";
            return 0;
        }

        // Sumar el total
        while ($row = pg_fetch_assoc($result)) {
            $total += $row['precio'] * $row['cantidad'];
        }

        return $total;
    }
}

?>
