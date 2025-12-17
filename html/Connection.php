<?php
function connect() {
    require_once 'dbconfig.php';

    $conn = new PDO(
        "pgsql:host={$dbconfig['server']};port={$dbconfig['port']};dbname={$dbconfig['db']}",
        $dbconfig['username'],
        $dbconfig['password']
    );
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $conn;
}
?>

