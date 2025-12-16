<!DOCTYPE html>
<html>
<head>
    <title>El Meu Lloc Web</title>
</head>
<body>
    <h1>Benvingut/da a DAW!</h1>
    <p>Això s'executa en un contenidor Docker</p>

    <h2>Prova de connexió a la base de dades:</h2>
    <?php
    try {
        $pdo = new PDO(
            'mysql:host=database;dbname=daw_db',
            'usuari',
            'contrasenya'
        );
        echo "<p style='color: green;'>Connexió a la BD correcta!</p>";

        // Crear una taula d'exemple si no existeix
        $pdo->exec("CREATE TABLE IF NOT EXISTS usuaris (
            id INT AUTO_INCREMENT PRIMARY KEY,
            nom VARCHAR(50),
            data_creacio TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )");

        // Inserir dades d'exemple
        $pdo->exec("INSERT IGNORE INTO usuaris (nom) VALUES
            ('Anna'), ('Pere'), ('Maria')");

        // Mostrar les dades
        $stmt = $pdo->query("SELECT * FROM usuaris");
        $usuaris = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo "<h3>Usuaris a la base de dades:</h3>";
        echo "<ul>";
        foreach ($usuaris as $usuari) {
            echo "<li>{$usuari['nom']} (ID: {$usuari['id']})</li>";
        }
        echo "</ul>";

    } catch (Exception $e) {
        echo "<p style='color: red;'>Error: " . $e->getMessage() . "</p>";
    }
    ?>
</body>
</html>

