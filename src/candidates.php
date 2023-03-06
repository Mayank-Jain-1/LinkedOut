<?php

function getCandidates()
{
  try {
    global $candidates;
    $server = "localhost";
    $username = "root";
    $password = "";
    $database = "linkedout";

    $conn = mysqli_connect($server, $username, $password, $database);

    if ($conn->connect_error) {
      die("Connection Failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM `linkedout`.`candidates`";
    $candidates = mysqli_query($conn, $sql);
  } catch (Exception $err) {
  } finally {
    $conn->close();
  }
}


session_start();
getCandidates();
$candidates;

if (!isset($_SESSION['name'])) {
  header("location: login.php");
}



if (isset($_POST['logout'])) {
  echo "clicked Logout";
  session_unset();
  session_destroy();
  header("location: login.php");
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

<body class="bg-faded">
  <nav class="w-full text-white flex items-center justify-between h-20 bg-primary px-5">
    <h1 class="text-2xl font-semibold">Admin</h1>
    <ul class="flex items-center space-x-6 float-right justify-between">
      <div class="flex flex-col md:flex-row md:space-x-5">
        <p class="text-lg"><?php
                            echo $_SESSION['phone'];
                            ?>
        </p>
        <p class="text-lg"><?php
                            echo $_SESSION['name'];
                            ?>
        </p>
      </div>
      <form action="jobs.php" method="post">
        <input id="logout" value="Logout" type="submit" name="logout" value="logout" class="bg-white text-primary p-2 cursor-pointer"></input>
      </form>
    </ul>
  </nav>
  <div class="flex flex-col md:flex-row">
    <ul class="md:min-h-screen h-max md:h-auto bg-secondary w-full md:w-60 flex flex-col">
      <a href="jobs.php" class="py-3 px-5 border-y inline-block md:block cursor-pointer hover:bg-faded">Jobs</a>
      <a class="py-3 px-5 border-y inline-block md:block text-white bg-primary">Candidates Apllied</a>
      <a class="py-3 px-5 border-y inline-block md:block cursor-pointer hover:bg-faded">Contact</a>
      <a class="py-3 px-5 border-y inline-block md:block cursor-pointer hover:bg-faded">About</a>
    </ul>
    <div class="p-3 md:p-7 w-full">
      <h1 class="text-blue-500 text-4xl font-semibold">List of Applications</h1>
      <table class="w-full my-10 border-2 border-neutral-400 ">
        <tr>
          <th class="px-2 md:px-6 bg-primary text-white border-2 py-3">#</th>
          <th class=" w-3/12 bg-primary text-white border-2 py-3 px-2 md:px-3">Name</th>
          <th class=" w-5/12 bg-primary text-white border-2 py-3 px-2 md:px-3">Position</th>
          <th class=" w-2/12 bg-primary text-white border-2 py-3 px-2 md:px-3">Year Passout</th>
          <th class=" w-2/12 bg-primary text-white border-2 py-3 px-2 md:px-3">Resume</th>
        </tr>
        <?php
        while ($row = mysqli_fetch_array($candidates)) {
          $name = $row['name'];
          $position = $row['position'];
          $passout = $row['passout'];
          $resume = $row['resume'];
          echo "<tr class='border-b-2 border-neutral-400'>
              <td class='text-lg py-3  font-semibold pl-3'></td>
              <td class='py-3 '>$name</td=>
              <td class='py-3 '>$position</td>
              <td class='py-3 '>$passout</td>
              <td class='py-3  text-blue-500'> <a href='$resume' target='_blank'>Link</a></td>
            </tr>";
        }
        ?>
      </table>
    </div>
  </div>
</body>
<script>
  function togglePostJob() {
    console.log('ig');
    const form = document.getElementById('postJobForm');
    form.classList.toggle('hidden');
  }
</script>

</html>