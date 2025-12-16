<!DOCTYPE html>
<html>
<head>
    <title>Aplicació DAW al núvol</title>
</head>
<body>
    <h1>✅ Aplicació desplegada a Render.com!</h1>
    
    <h2>Informació del servidor:</h2>
    <p>PHP: <?php echo phpversion(); ?></p>
    <p>Data: <?php echo date('Y-m-d H:i:s'); ?></p>
    
    <h2>Prova de SQLite:</h2>
    <?php
    try {
        // Usar SQLite enlloc de MariaDB
        $db = new PDO('sqlite:/var/www/data/test.db');
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        // Crear taula
        $db->exec("CREATE TABLE IF NOT EXISTS usuaris (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            nom TEXT,
            data_creacio TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )");
        
        // Inserir dades
        $db->exec("INSERT OR IGNORE INTO usuaris (nom) VALUES 
            ('Anna'), ('Pere'), ('Maria')");
        
        // Mostrar
        $stmt = $db->query("SELECT * FROM usuaris");
        $usuaris = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        echo "<p style='color: green;'>✅ Connexió a SQLite correcta!</p>";
        echo "<h3>Usuaris:</h3><ul>";
        foreach ($usuaris as $u) {
            echo "<li>{$u['nom']} (ID: {$u['id']})</li>";
        }
        echo "</ul>";
        
    } catch (Exception $e) {
        echo "<p style='color: red;'>❌ Error: " . $e->getMessage() . "</p>";
    }
    ?>
</body>
</html>

