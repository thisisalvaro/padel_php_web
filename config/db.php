<?php
class Database {
    public static function getConnection() {
        $connectionString = "postgresql://neondb_owner:npg_ORn5JSxC2Bur@ep-sweet-mountain-a8qbzzx0.eastus2.azure.neon.tech/neondb?sslmode=require&options=endpoint%3Dep-sweet-mountain-a8qbzzx0";
        $db = pg_connect($connectionString);
        if (!$db) {
            die("Error al conectar a la base de datos.");
        }
        return $db;
    }
    public static function login($email, $password) {
        if (empty($email) || empty($password)) {
            renderView('auth/login', ['error' => 'Por favor, completa todos los campos.']);
            return;
        }

        $response = pg_query(getConnection(), "SELECT * FROM users WHERE email = '$email' AND password = '$password'");

        while ($row = pg_fetch_row($response)) {
            echo "Author: $row[0]  E-mail: $row[1]";
            echo "<br />\n";
        }
    }
}