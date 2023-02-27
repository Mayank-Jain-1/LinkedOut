<?php
$message = "";
if (isset($_POST['submit'])) {
  $email = $_POST['email'];
  $password = $_POST['password'];
  $message = "<p> Insert email = $email , password = $password </p>";
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
        <input name="password" type="text" class="bg-faded py-2 px-4 text-sm w-full mb-6 rounded-sm max-w-md" placeholder="Password" />
        <?php
        echo "<p>$message</p>";
        ?>
        <div class="space-x-3">
          <button name='submit' type='submit' class="py-3 text-white bg-primary w-24">Login</button>
          <button class="py-3 border-2 border-primary text-primary font-semibold w-24">
            Sign Up
          </button>
        </div>
      </form>
      <div class="absolute"></div>
    </div>
  </div>
</body>

</html>