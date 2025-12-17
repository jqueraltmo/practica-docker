<?php
function connect() {
    require_once 'dbconfig.php';
    
    // PostgreSQL usa un DSN diferent
    $dsn = "pgsql:host={$dbconfig['server']};dbname={$dbconfig['db']}";
    
    $conn = new PDO($dsn, $dbconfig['username'], $dbconfig['password']);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    
    return $conn;
}
?>

