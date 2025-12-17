<?php
function connect() {
    // 1. Obtenir la DATABASE_URL de l'entorn
    $databaseUrl = getenv('DATABASE_URL');
    
    if (!$databaseUrl) {
        // Per a entorn local de desenvolupament (fallback)
        $databaseUrl = "postgresql://postgres:postgres@localhost:5432/hotel";
    }
    
    // 2. Convertir la URL de Render al format que espera PDO
    // Render dóna: "postgresql://usuari:password@host:5432/db"
    // PDO espera:  "pgsql:host=host;port=5432;dbname=db;user=usuari;password=password"
    
    // Substituir el prefixe
    $dsn = str_replace('postgresql://', 'pgsql:', $databaseUrl);
    
    // 3. Crear la connexió PDO (Atenció: NO passar user/password com a segon i tercer argument)
    $conn = new PDO($dsn);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    return $conn;
}
?>
