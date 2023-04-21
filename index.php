<!-- 
  Developed by: Gustavo Baccan Gomes
  Github: https://github.com/Baccan
  Date: 21/04/2023
-->

<?php
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $email = $_POST['email'];
  $password = $_POST['password'];

  if (empty($email) || empty($password)) {
    echo 'Username or password empty<br>';
    echo '<button onclick="history.go(-1)">Return</button>';
    exit;
  }

  // Connect to database
  $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

  if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
  }

  $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";

  $result = $conn->query($sql);

  if ($result->num_rows <= 0) {
    echo 'Username or password incorrect<br>';
    echo '<button onclick="history.go(-1)">Return</button>';
    exit;
  }

  while ($row = $result->fetch_assoc()) {
    session_start();
    $_SESSION['user'] = $row['name'];
    header('Location: /CP1/search.php');
    exit;
  }
}
?>


<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">


  <style>
    main#login {
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
    }
  </style>
</head>

<body>

  <main id="login">
    <!-- bootstrap login form -->
    <div class="container">
      <div class="row">
        <div class="col-md-4 offset-md-4">
          <div class="card">
            <div class="card-header">
              Login
            </div>
            <div class="card-body">
              <!-- action to this same page -->
              <form action="./index.php" method="POST">
                <div class="mb-3">
                  <label for="email" class="form-label">Email</label>
                  <input type="text" class="form-control" id="email" name="email" placeholder="Write your email" required>
                </div>
                <div class="mb-3">
                  <label for="password" class="form-label">Senha</label>
                  <input type="password" class="form-control" id="password" name="password" placeholder="Write your password" required>
                </div>
                <button type="submit" class="btn btn-primary">Login</button>
                <div class="small mt-3">
                  @Developed by Gustavo Baccan Gomes
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
  </main>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>