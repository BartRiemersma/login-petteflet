<?php
session_start();




// LOGIN USER
if (isset($_POST['login_user'])) {

	$conn = new mysqli('localhost',  'root', '', 'petteplet');

	$username = $_POST['gebruikersnaam'];
	$password = $_POST['Wachtwoord'];

	if (empty($username)) {
		echo "Gebruikersnaam is nodig";
	}
	if (empty($password)) {
		echo "Wachtwoord is nodig";
	}

  

		$password = md5($password);
		$sql = "SELECT * FROM users WHERE gebruikersnaam='$username' AND wachtwoord='$password'";
		$result = mysqli_query($conn, $sql);
		$resultcheck = mysqli_num_rows($result);


		if ($resultcheck > 0) {

    while($row = mysqli_fetch_assoc($result)) {
        $_SESSION['idea'] = $row['id'];

    }
} else {
    echo "0 results";
}


		if (mysqli_num_rows($result) == 1) {
			header('location: index.php');
		}else {
			echo "Foute gebruikersnaam/wachtwoord combinatie";
		}




} else {
	echo "nah";
}

?>
<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
  <link rel="stylesheet" href="cssfiles/register.css" type="text/css">
</head>
<body>

  <div class="header">
		<h2>Login</h2>
	</div>

  <form method="post">
    <!-- <?php include('errors.php'); ?> -->
   <div class="input-group">
     <label>Gebruikersnaam</label>
     <input type="text" name="gebruikersnaam">
   </div>
   <div class="input-group">
     <label>Wachtwoord</label>
     <input type="password" name="Wachtwoord">
   </div>
   <div class="input-group">
     <button type="submit" class="btn" name="login_user">Log in</button>
   </div>
   <p>
     Bent u nog niet geregistreerd? <a class="btn" href="registreer.php">Registreer</a>
   </p>
  </form>
</body>
</html>
