<?php
require_once 'Connection.php';

function check_argument($arg_name) {
    if (!isset($_POST[$arg_name])) {
      throw new Exception("Falten paràmetres.");
    }
    $argument = trim($_POST[$arg_name]);
    if ($argument=='') {
      $argument='%';
    }
    return $argument;
}

function get_hosts_by_name($conn, $firstname, $lastname) {
    $statement = $conn->prepare("
    SELECT 
        Id AS \"Id\", 
        FirstName AS \"FirstName\", 
        LastName AS \"LastName\" 
    FROM Hosts 
    WHERE FirstName LIKE :firstname AND LastName LIKE :lastname
    ");
  $statement->bindParam(':firstname', $firstname);
  $statement->bindParam(':lastname', $lastname);
  $statement->execute();
  $hosts = $statement->fetchAll();
  return $hosts;
}

function show_hosts($hosts) {
  if (sizeof($hosts)>0) {
    echo "<table class='table table-striped'>\n<tr><th>Id</th><th>Nom</th><th>Cognom</th></tr>\n";
    foreach ($hosts as $host) {
      echo "<tr><td>{$host['Id']}</td><td>{$host['FirstName']}</td><td>{$host['LastName']}</td></tr>\n";
    }
    echo "</table>\n";
  } else {
    echo "<p>No hi ha hostes que compleixin el criteri de cerca.</p>\n";
  }
}

session_start();
try {
  $firstname = check_argument('firstname');
  $lastname = check_argument('lastname');
  $conn = connect();
  $hosts = get_hosts_by_name($conn, $firstname, $lastname);
} catch(PDOException $e) {
  $_SESSION['error'] = "No s'ha pogut recuperar la llista de clients:\n{$e->getMessage()}\n";
  header('Location: index.php');
  exit();
} catch (Exception $e) {
  $_SESSION['error'] = $e->getMessage();
  header('Location: index.php');
  exit();
}
?>
<!DOCTYPE html>
<html lang="ca">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <title>SELECT amb paràmetres</title>
  </head>
  <body>
    <main role="main" class="container">
      <h1 class="mt-5">Hostes</h1>
      <?php show_hosts($hosts); ?>
    </main>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
  </body>
</html>

