<?php
// dbconfig.php
// AQUEST FITXER LLEGEIX LA VARIABLE DATABASE_URL QUE RENDER INJECTA AUTOMÀTICAMENT

// Obtenir la URL de connexió de l'entorn
$databaseUrl = getenv('DATABASE_URL');

if (!$databaseUrl) {
    // Fallback per a entorn de desenvolupament local (opcional)
    $databaseUrl = "postgresql://postgres:postgres@localhost:5432/hotel";
}

// Analitzar la URL per extreure components
$urlParts = parse_url($databaseUrl);

// Extreure el nom de la base de dades del 'path' (elimina la barra inicial)
$dbName = ltrim($urlParts['path'] ?? '', '/');

$dbconfig = [
    'server'   => $urlParts['host'] ?? 'localhost',
    'port'     => $urlParts['port'] ?? '5432',
    'db'       => $dbName ?: 'hotel',
    'username' => $urlParts['user'] ?? 'postgres',
    'password' => $urlParts['pass'] ?? '',
];
?>

