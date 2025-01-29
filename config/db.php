<?php
$connectionString = "postgresql://neondb_owner:npg_ORn5JSxC2Bur@ep-sweet-mountain-a8qbzzx0.eastus2.azure.neon.tech/neondb?sslmode=require&options=endpoint%3Dep-sweet-mountain-a8qbzzx0";

$db = pg_connect($connectionString);

if (!$db) {
    die("Error al conectar a la base de datos.");
} 