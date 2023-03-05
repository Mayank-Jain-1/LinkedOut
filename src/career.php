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

function applyJob()
{
  try {
    $server = "localhost";
    $username = "root";
    $password = "";
    $database = "linkedout";

    $conn = mysqli_connect($server, $username, $password, $database);

    if ($conn->connect_error) {
      die("Connection Failed: " . $conn->connect_error);
    }

    $jobid = $_POST['jobid'];
    $name = $_POST['name'];
    $position = $_POST['position'];
    $passout = $_POST['passout'];
    $resume = $_POST['resume'];
    $sql = "INSERT INTO `linkedout`.`candidates` (`job id`, `name`, `resume`, `passout`,`position`) VALUES ('$jobid', '$name', '$resume', $passout,'$position');";

    $result = mysqli_query($conn, $sql);

    if ($result) {
      echo "<script>alert('Applied for the job successfully')</script>";
    } else {
      echo "<script>alert('Couldnt apply for the job check the fields or try later.')</script>";
    }
  } catch (Exception $err) {
    return;
  } finally {
    $conn->close();
  }
}

$jobs;
getJobs();

if (isset($_POST['apply'])) {
  applyJob();
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
  <nav class="w-full text-white flex items-center h-20 justify-between bg-primary px-5">
    <h1 class="text-2xl font-semibold">LinkedOut</h1>
    <p class="text-2xl font-semibold text-center w-full">
      Careers
    </p>
    <a href="login.php" class="bg-white text-primary p-2 cursor-pointer w-40 text-center">Admin Login</a>
    </ul>
  </nav>

  <h1 class="text-4xl text-center font-semibold py-7 text-primary"> Find your dream job.</h1>

  <div class="flex flex-col items-center m-7 space-y-5">
    <?php
    while ($row = mysqli_fetch_array($jobs)) {
      $jobid = $row['id'];
      $companyName = $row['company name'];
      $position = $row['position'];
      $description = $row['description'];
      $ctc = $row['ctc'];
      echo "
      <div class='w-full card p-5 bg-white border-2 border-primary rounded-xl flex flex-col space-y-2 max-w-7xl'>
        <h2 class='text-2xl font-semibold text-center'> $companyName </h2>
        <h5 class='text-lg font-semibold'>$position</h5>
        <p class='pb-2'>$description</p>
        <h5 class='text-lg font-semibold '>CTC</h5>
        <p class='pb-4'>₹ $ctc</p>
        <button onclick=\"toggleApplyJob('jobform$jobid')\" type='submit' name='job$jobid' class='bg-blue-500 text-white
        w-20 p-3 rounded-xl' >Apply</button>
      </div>
      
      <form action='career.php' method='post' id='jobform$jobid' class='flex hidden flex-col space-y-3 mt-7 w-full max-w-5xl' action='post'>
      <input type='text' name='jobid' value='$jobid' class='hidden'>
      <input type='text' name='position' value='$position' class='hidden'>
      <label>Full Name</label>
      <input name='name' class='p-3 rounded-lg' type='text' required/>
      <label>Year Passout</label>
      <input name='passout' class='p-3 rounded-lg' type='Number' required/>
      <label>Resume Link</label>
      <input name='resume' class='p-3 rounded-lg' type='text' required/>
      <div class='space-x-4'>
        <input type='submit' name='apply' class='bg-blue-400 text-white py-2 px-4 rounded-xl self-start my-12' />
        <button type='button' onclick=\"toggleApplyJob('jobform$jobid')\" class='bg-red-500 text-white py-2 px-4 rounded-xl self-start my-12' >Cancel</button>
      </div>
    </form>

      ";
    }
    ?>

    <!-- <form method='post' id='jobform$jobid' class='flex flex-col space-y-3 mt-7 w-full max-w-5xl' action='post'>
      <input type='text' name='jobid' value='$jobid' class="hidden">
      <label>Full Name</label>
      <input name='name' class='p-3 rounded-lg' type='text' />
      <label>Year Passout</label>
      <input name='position' class='p-3 rounded-lg' type='Number' />
      <label>Resume Link</label>
      <input name='position' class='p-3 rounded-lg' type='text' />
      <div class='space-x-4'>
        <input type='submit' id='postJob' name='postJob' class='bg-blue-400 text-white py-2 px-4 rounded-xl self-start my-12' />
        <button type='button' onclick='toggleApplyJob('jobform$jobid')' class='bg-red-500 text-white py-2 px-4 rounded-xl self-start my-12' >Reset</button>
      </div>
    </form> -->

  </div>


</body>
<script>
  function toggleApplyJob(id) {
    console.log('ig');
    const form = document.getElementById(id);
    form.classList.toggle('hidden');
  }
</script>

</html>