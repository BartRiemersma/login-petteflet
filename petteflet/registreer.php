<?php

if (isset($_POST['reg_user'])) {
$conn = new mysqli('localhost',  'root', '', 'petteplet');

if ($conn->error) {
	die("connection falied: " . $conn->connect_error);
}

// echo "connection succesful";

$gebruikersnaam = $_POST["gebruikersnaam"];
$email = $_POST["email"];
$wachtwoord = $_POST["wachtwoord"];
$errors = array();
// echo "$gebruikersnaam";

$wachtwoord = md5($wachtwoord);//encryptie
$sql = "INSERT INTO users (gebruikersnaam, email, wachtwoord)
VALUES ('$gebruikersnaam', '$email', '$wachtwoord')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Registreer</title>
  <link rel="stylesheet" href="cssfiles/register.css" type="text/css">
</head>
<body>

  <div class="header">
		<h2>Registreer</h2>
	</div>

  <form method="post">
    <?php include('errors.php'); ?>
   <div class="input-group">
     <label>Gebruikersnaam</label>
     <input type="text" name="gebruikersnaam">
   </div>
   <div class="input-group">
     <label>Email</label>
     <input type="text" name="email">
   </div>
   <div class="input-group">
     <label>Wachtwoord</label>
     <input type="password" name="wachtwoord">
   </div>
   <div class="input-group">
     <button type="submit" class="btn" name="reg_user">Registreer</button>
   </div>
   <p>
     Bent u al geregistreerd? <a class="btn" href="login.php">Log in</a>
   </p>
  </form>
</body>
</html>
