<?php
session_start();


$errors = array();
 $_SESSION['success'] = "";

$db = mysqli_connect('localhost', 'root', '', '');


if (isset($_POST['save'])) {
	// receive all input values from the form
	 = mysqli_real_escape_string($db, $_POST['']);


	// form validation: ensure that the form is correctly filled
	if (empty()) { array_push($errors, " is nodig"); }




	// register user if there are no errors in the form
	if (count($errors) == 0) {
		 = md5($bank);//encrypt the password before saving in the database
	  $query = "INSERT INTO ()
	            VALUES(')";
	  mysqli_query($db, $query);

		$_SESSION['gebruikersnaam'] = $username;
		$_SESSION['success'] = "";
		header('location: index.php');
	}
}
