<?php
  session_start();
  if(!isset($_SESSION['name'])){
    header("location: login.php");
  }
  if(isset($_POST['logout'])){
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
    <nav
      class="w-full text-white flex items-center justify-between h-20 bg-primary px-5"
    >
      <h1 class="text-2xl font-semibold">Admin</h1>
      <ul class="flex items-center space-x-6 float-right justify-between">
        <p class="text-lg">Name</p>
        <form action="admin.php" method="post">
          <button name="logout" value="logout" class="bg-white text-primary p-2">Logout</button>
        </form>
      </ul>
    </nav>
    <div class="flex flex-col sm:flex-row">
      <ul class="h-max sm:h-auto bg-secondary w-full sm:w-max flex flex-col">
        <a class="py-3 px-5 border-b inline-block sm:block text-white bg-primary"
          >Jobs</a
        >
        <a class="py-3 px-5 border-b inline-block sm:block cursor-pointer"
          >Candidates Applied</a
        >
        <a class="py-3 px-5 border-b inline-block sm:block cursor-pointer"
          >Contact</a
        >
        <a class="py-3 px-5 border-b inline-block sm:block cursor-pointer"
          >About</a
        >
      </ul>
      <div class="p-5 sm:p-7 w-full">
        <button onclick="togglePostJob()" class="bg-blue-400 text-white py-2 px-4 rounded-xl">
          Post Job
        </button>

        <form id="postJobForm" class="flex flex-col space-y-3 mt-7" action="">
          <label>Company Name</label>
          <input class="p-3 rounded-lg" type="text" />
          <label>Position</label>
          <input class="p-3 rounded-lg" type="text" />
          <label>Job Description</label>
          <textarea class="p-3 rounded-lg"
          class="p-3 rounded-lg" name="" id="" cols="30" rows="10"></textarea>
          <label>CTC</label>
          <input class="p-3 rounded-lg" type="number" />
          <br>
          <button class="bg-blue-400 text-white py-2 px-4 rounded-xl self-start my-12">Submit</button>
        </form>
      </div>
    </div>
  </body>
  <script>
    function togglePostJob(){
      console.log('ig');
      const form = document.getElementById('postJobForm');
      form.classList.toggle('hidden');
    }
  </script>
</html>
