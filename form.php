<?php

require_once "config.php";
require_once 'vendor/autoload.php';

//Check captcha
$response = $_POST["g-recaptcha-response"];

$url = 'https://www.google.com/recaptcha/api/siteverify';
$data = array(
	'secret' => '6LcQtdIUAAAAAJTExTHmnCKuhaBiaz_b-4CFopko',
	'response' => $_POST["g-recaptcha-response"]
);
$options = array(
	'http' => array (
		'method' => 'POST',
		'content' => http_build_query($data)
	)
);
$context  = stream_context_create($options);
$verify = file_get_contents($url, false, $context);
$captcha_success=json_decode($verify);

 if ($captcha_success->success==true) {
   if (isset($_POST['username'], $_POST['email'])) {
       $username = mysqli_real_escape_string($conn,$_POST['username']);
       $email = mysqli_real_escape_string($conn,$_POST['email']);

       $user_check_query = "SELECT * FROM user WHERE username='$username' OR email='$email' LIMIT 1";
       $result = mysqli_query($conn, $user_check_query);
       $user = mysqli_fetch_assoc($result);

       if ($user) {
         if ($user['username'] === $username) {
           array_push($errors, "Username already exists");
         }

         if ($user['email'] === $email) {
           array_push($errors, "email already exists");
         }
       }

       $queryPost = "INSERT INTO user (username, email) VALUES('$username', '$email')";
     	mysqli_query($conn, $queryPost);

      $queryGet = "SELECT username, email FROM user";
      $result = mysqli_query($conn, $queryGet);

      if ($result->num_rows > 0) {

        echo <<<EOT
          <h1>Welcome ! </h1>
            <table class="table col-6">
              <thead>
                <tr>
                  <th scope="col">Usernanme </th>
                  <th scope="col">Email </th>
                </tr>
              </thead>
              <tbody>
          EOT;
      while($row = $result->fetch_assoc()) {
        $userRow = $row["username"];
        $emailRow = $row["email"];
          echo <<<EOT
              <tr>
                <th scope="row"> $userRow </th>
                <th> $emailRow</th>
              </tr>
          EOT;
      }
      echo <<<EOT
      </tbody>
    </table>
    EOT;
}
   } else {
     die ('Please fill both the username and email field!');
   }
}
?>


<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
	<title> Login Form in HTML5 and CSS3</title>
</head>
<body>


</body>
</html>
