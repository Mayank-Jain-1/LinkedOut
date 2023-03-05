<?php
$message = "<p class='text-white'>.</p>";
function login()
{
  try {
    global $message;
    $server = "localhost";
    $username = "root";
    $password = "";
    $database = "linkedout";

    $conn = mysqli_connect($server, $username, $password, $database);

    if ($conn->connect_error) {
      die("Connection Failed: " . $conn->connect_error);
    }


    $email = $_POST['email'];
    $password = $_POST['password'];
    $searchSql = "Select * from `linkedout`.`users` where email = '$email' and password = '$password'";
    $result = mysqli_query($conn, $searchSql);
    if (mysqli_num_rows($result) != 1) {
      $message = "<p class='text-red-600'>Either username or password incorrect</p>";
      return;
    }
    $result = mysqli_fetch_array($result);
    session_start();
    $_SESSION['id'] = $result['id'];
    $_SESSION['email'] = $result['email'];
    $_SESSION['name'] = $result['name'];
    $_SESSION['phone'] = $result['phone'];

    header("Location: jobs.php");
  } catch (Exception $err) {
    $message = "<p class='text-red-600'>There is some error, check the fields or try again later</p>";
  } finally {
    if (isset($conn)) $conn->close();
  }
}
if (isset($_POST['submit'])) {
  login();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="output.css" />
  <title>Document</title>
</head>

<body>
  <div class="w-screen h-screen -z-40 -left-1/2 fixed bg-primary skew-x-[10deg]"></div>
  <div class="w-screen h-screen -z-50 fixed bg-faded"></div>

  <div class="flex justify-center items-center py-16 px-5 md:px-10">
    <div class="flex w-full max-w-[800px] bg-white rounded-2xl overflow-hidden relative">
      <img src="./Images/buildings.png" alt="" class="w-1/3 hidden sm:block" />

      <form action='login.php' method="post" class="flex flex-col justify-center w-full py-16 px-10 md:px-16">
        <h1 class="text-5xl text-primary font-semibold mb-6">Welcome</h1>
        <input name="email" type="text" class="bg-faded py-2 px-4 text-sm w-full mb-3 rounded-sm max-w-md" placeholder="Email" />
        <input name="password" type="text" class="bg-faded py-2 px-4 text-sm w-full mb-1 rounded-sm max-w-md" placeholder="Password" />
        <?php
        echo $message;
        ?>

        <div class="space-x-3 mt-4">
          <button name='submit' type='submit' class="py-3 text-white bg-primary w-24">Login</button>
          <a href='./register.php' class="inline-flex justify-center py-3 border-2 border-primary text-primary font-semibold w-24">
            <p>
              Sign Up
            </p>
          </a>
        </div>
      </form>
      <div class="absolute"></div>
    </div>
  </div>
</body>

</html>