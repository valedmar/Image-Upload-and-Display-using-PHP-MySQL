<?php
if (isset($_POST['user'])) {$user = $_POST['user'];} else {$user = '';}
if (isset($_POST['pass'])) {$pass = $_POST['pass'];} else {$pass = '';}

if($user == "admin"
&& $pass == "admin")
{
        // do nothing lol
}
else
{
    if(isset($_POST))
    {
            echo '<form method="POST" action="displayuserdetails.php">';
            echo 'User <input type="text" name="user"></input><br/>';
            echo 'Pass <input type="password" name="pass"></input><br/>';
            echo '<input type="submit" name="submit" value="Go"></input>';
            echo '</form>';
            die();
    }
}

include("connect.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Billeder</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>

  <style>
    html,
    body {
      background-color: gainsboro;
    }
  </style>

  <div class="container">

    <div class="container my-5">
      <h1 class="text-center">Uploadede billeder</h1>
    </div>

    <div class="container my-5">
      <?php // get the total amount of pics
      $st='SELECT sum(amount) as total from user';
      $t=mysqli_stmt_init($conn);
      mysqli_stmt_prepare($t,$st);
      mysqli_stmt_execute($t);
      $res=mysqli_stmt_get_result($t);
      $total=0;
      while($rop=mysqli_fetch_assoc($res)){
       $total = $rop['total'];
      }
      if ($total < 1) {
        $total = '0';
      }
      echo '<h2 class="text-center"> '.$total.' billeder!</h2>';
      ?>
    </div>

    <div class="container my-5 w-75">
      <table class="table table-striped ">
        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Name</th>
            <th scope="col">Amount</th>
            <th scope="col">Last photo</th>
          </tr>
        </thead>
        <tbody>

          <?php
          // Fetch user details from the database
          $sql = "SELECT * FROM `user` ORDER BY `ID` DESC LIMIT 100";
          $result = mysqli_query($conn, $sql);

          // Loop through each user record
          while ($row = mysqli_fetch_assoc($result)) {

            $id = $row["id"];
            $name = $row["name"];
            $amount = $row["amount"];
            $photo = $row["photo"]; //'photo'

            echo
            '<tr>
              <th scope="row">' . $id . '</th>
              <td>' . $name . '</td>
              <td>' . $amount . '</td>
              <!-- Display user photo -->
              <td><img src="uploads/' . $photo . '" alt="Billede" style="width: 100px; height: 100px;"></td>

            </tr>';
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>