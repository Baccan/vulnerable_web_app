<!-- 
  Developed by: Gustavo Baccan Gomes
  Github: https://github.com/Baccan
  Date: 21/04/2023
-->

<?php
session_start();

if (!isset($_SESSION['user'])) {
  header('Location: /CP1/index.php');
  exit;
}

if (isset($_GET['logout'])) {
  session_destroy();
  header('Location: /CP1/index.php');
  exit;
}
?>

<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Search XSS</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

  <style>
    main#search {
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
    }
  </style>
</head>

<body>

  <main id="search">
    <div class="container">
      <div class="row">

        <div class="col-md-4 offset-md-4">

          <div class="card">
            <div class="card-header">
              Hi <strong><?= $_SESSION['user'] ?></strong>, what are you looking for?
            </div>

            <div class="card-body">
              <form action="./search.php" method="POST">
                <div class="mb-3">
                  <label for="search" class="form-label">Search</label>
                  <input type="text" class="form-control" id="search" name="search" placeholder="What are you looking for?" required>
                </div>
                <button type="submit" class="btn btn-primary">Let's go!</button>
                <a><a href="./search.php?logout=true">Logout</a></a>
              </form>

              <?php if ($_SERVER['REQUEST_METHOD'] === 'POST') : ?>
                <div class="alert alert-success mt-3" role="alert">
                  You searched for:
                  <strong>
                    <?= $_POST['search']; ?>
                  </strong>
                </div>
              <?php endif; ?>

            </div>
          </div>
        </div>

      </div>
    </div>
  </main>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>