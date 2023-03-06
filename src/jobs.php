<?php

function getJobs()
{
  try {
    global $jobs;
    $server = "localhost";
    $username = "root";
    $password = "";
    $database = "linkedout";

    $conn = mysqli_connect($server, $username, $password, $database);

    if ($conn->connect_error) {
      die("Connection Failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM `linkedout`.`jobs`";
    $jobs = mysqli_query($conn, $sql);
    // while($row = mysqli_fetch_array($jobs)){
    //   echo print_r($row["CTC"]);
    // }
  } catch (Exception $err) {
  } finally {
    $conn->close();
  }
}

function postJob()
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

    $name = $_POST['name'];
    $position = $_POST['position'];
    $description = $_POST['description'];
    $ctc = $_POST['ctc'];

    if (!$name || !$position || !$description || !$ctc) {
      $message = "<p class='text-red-600'>Please fill every field correctly</p>";
      return;
    }

    $sql = "INSERT INTO `linkedout`.`jobs` (`company name`, `position`, `description`, `ctc`) VALUES ( '$name', '$position', '$description', $ctc);";

    $result = mysqli_query($conn, $sql);

    if (!$result) {
      $message = "<p class='text-red-600'>Error while adding new job. Please try again later.</p>";
      return;
    }

    $message = "<p class='text-green-600'>Successfully added new job.</p>";
    getJobs();
  } catch (Exception $err) {
    if (str_contains($err, 'unq_job')) {
      $message = "<p class='text-red-600'>Same Job post already exist. Please check in the available jobs.</p>";
    } else {
      echo $err;
      $message = "<p class='text-red-600'>Fill all fields correctly. Or try again later</p>";
    }
    return;
  } finally {
    $conn->close();
    $_POST = array();
  }
}

session_start();
getJobs();
$jobs;
$message = "<p class='text-faded'>.</p>";

if (!isset($_SESSION['name'])) {
  header("location: login.php");
}



if (isset($_POST['logout'])) {
  echo "clicked Logout";
  session_unset();
  session_destroy();
  header("location: login.php");
}

if (isset($_POST['postJob']))
  postJob();
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
      <a class="py-3 px-5 border-y inline-block md:block text-white bg-primary">Jobs</a>
      <a href="candidates.php" class="py-3 px-5 border-y inline-block md:block cursor-pointer hover:bg-faded">Candidates Applied</a>
      <a class="py-3 px-5 border-y inline-block md:block cursor-pointer hover:bg-faded">Contact</a>
      <a class="py-3 px-5 border-y inline-block md:block cursor-pointer hover:bg-faded">About</a>
    </ul>
    <div class="p-5 md:p-7 w-full">
      <button onclick="togglePostJob()" class="bg-blue-400 text-white py-2 px-4 rounded-xl">
        Post Job
      </button>
      <div class="w-full">
        <form method="post" id="postJobForm" class="flex flex-col space-y-3 mt-7 w-full max-w-2xl" action="">
          <label>Company Name</label>
          <input name="name" class="p-3 rounded-lg" type="text" />
          <label>Position</label>
          <input name="position" class="p-3 rounded-lg" type="text" />
          <label>Job Description</label>
          <textarea class="p-3 rounded-lg" class="p-3 rounded-lg" name="description" cols="30" rows="10"></textarea>
          <label>CTC (Lpa)</label>
          <input name="ctc" class="p-3 rounded-lg" type="number" />
          <?php
          echo $message;
          ?>
          <input type="submit" id='postJob' name='postJob' class="bg-blue-400 text-white py-2 px-4 rounded-xl self-start my-12" />
        </form>

        <table class="w-full my-10 border-2 border-neutral-400 ">
          <tr>
            <th class="  bg-primary text-white border-2 py-3">#</th>
            <th class=" w-2/5 bg-primary text-white border-2 p-3">Company Name</th>
            <th class=" w-2/5 bg-primary text-white border-2 p-3">Position</th>
            <th class=" w-1/5 bg-primary text-white border-2 p-3">CTC</th>
          </tr>
          <?php
          while ($row = mysqli_fetch_array($jobs)) {
            $companyName = $row['company name'];
            $position = $row['position'];
            $ctc = $row['ctc'];
            echo "<tr class='border-b-2 border-neutral-400'>
              <td class='text-lg py-3 px-5 font-semibold'></td>
              <td class='py-3'>$companyName</td=>
              <td class='py-3'>$position</td>
              <td class='py-3'>$ctc Lpa</td>
            </tr>";
          }
          ?>
        </table>
      </div>
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