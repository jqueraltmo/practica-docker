<?php
session_start();

function mostra_errors() {
  if (isset($_SESSION['error'])) {
    echo "<div class='alert alert-danger' role='alert'>{$_SESSION['error']}</div>";
    unset($_SESSION['error']);
  }
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
    <?php mostra_errors(); ?>
    <main role="main" class="container">
      <h1 class="mt-5">Cerca hostes</h1>
      <form action="exemple.php" method="post">
        <div class="form-group">
          <label for="firstname">Nom</label>
          <input type="text" class="form-control" name="firstname" id="firstname" placeholder="Escriu el nom a cercar">
        </div>
        <div class="form-group">
          <label for="lastname">Cognom</label>
          <input type="text" class="form-control" name="lastname" id="lastname" placeholder="Escriu el cognom a cercar">
        </div>
        <button type="submit" class="btn btn-primary">Cerca</button>
      </form>
    </main>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
  </body>
</html>

