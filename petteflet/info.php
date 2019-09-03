<?php

session_start();

//establish an connection to the database
$conn = mysqli_connect('localhost', 'root', '', 'petteplet');


//create varables
$id = "";
$naammoeder = "";
$naamvader = "";
$adres    = "";
$postcode = "";
$email    = "";
$bank = "";
$gebruikersnaam = "";


//get the session id.
$idea = $_SESSION['idea'];
// echo $idea;
$sql = "SELECT * FROM users WHERE id='$idea' ";
$results = mysqli_query($conn, $sql);
$resultcheck = mysqli_num_rows($results);

if ($resultcheck > 0) {

while($row = mysqli_fetch_assoc($results)) {
  $gebruikersnaam = $row['gebruikersnaam'];
}
}


//establish errorarrays (will use for errorpopups)
$errors = array();
$nodata = array();



//receve data from the database.
$sql = "SELECT * FROM personen_info WHERE id='$idea' ";
$results = mysqli_query($conn, $sql);
$resultcheck = mysqli_num_rows($results);
//check if there are values
if (empty($resultcheck)) {

 //if there is no data then there will be an errorpopup
  array_push($nodata, "Geen data gevonden");


//the variables will stay empty and will display that
$id = $_SESSION['idea'];
$naammoeder = 'leeg!';
$naamvader = 'leeg!';
$adres    = 'leeg!';
$postcode = 'leeg!';
$email    = 'leeg!';
$bank = 'leeg!';


}else {




while($row = mysqli_fetch_assoc($results)) {
  $id = $row['id'];
  $naammoeder = $row['Naam_moeder'];
  $naamvader = $row['Naam_vader'];
  $adres    = $row['Adres'];
  $postcode = $row['postcode_woonplaats'];
  $email    = $row['Email'];
  $bank = $row['bankrekening'];
}

}



if (isset($_POST['save'])) {



  // receive all input values from the form
  $naammoeder = $_POST['naammoeder'];
  $naamvader = $_POST['naamvader'];
  $adres = $_POST['adres'];
  $postcode = $_POST['postcode'];
  $email = $_POST['email'];
  $bank = $_POST['bank'];



	// form validation: ensure that the form is correctly filled
	if (empty($naammoeder)) { array_push($errors, "Naam is nodig"); }
	if (empty($naamvader)) { array_push($errors, "Naam is nodig"); }
	if (empty($adres)) { array_push($errors, "Adres is nodig"); }
  if (empty($postcode)) { array_push($errors, "Postcode is nodig"); }
  if (empty($email)) { array_push($errors, "Email is nodig"); }
  if (empty($bank)) { array_push($errors, "Bankrekeningnummer is nodig"); }

  if ($_SESSION['idea'] > 0) {


    $input = array();
    array_push($input, $naammoeder, $naamvader, $adres, $postcode, $email, $bank);
    // print_r($input);

  }

  if ($idea == $id) {
    $query = "UPDATE personen_info SET Naam_moeder='$naammoeder', Naam_vader='$naamvader',  Adres='$adres',
    postcode_woonplaats='$postcode', Email='$email', bankrekening='$bank' WHERE id='$idea' ";
    $update = mysqli_query($conn, $query);


 } else if (count($errors) == 0) {
		$bank = md5($bank);//encrypt the password before saving in the database
	  $query = "INSERT INTO personen_info (Naam_moeder, Naam_vader, Adres, postcode_woonplaats, Email, bankrekening)
	        VALUES('$naammoeder', '$naamvader', '$adres', '$postcode', '$email', '$bank')";
	  $add = mysqli_query($conn, $query);


		// header('location: index.php');
	}




}
?>
<!DOCTYPE html>
<html>
 <head>
   <title>Home</title>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=yes">
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
   <link rel="stylesheet" href="cssfiles/edit.css" type="text/css">

 </head>
<body>

<header>
 <nav class="nav">
  <container class="bak">
  <div class="imgedit">
   <img src="cssfiles/petteflet.jpg"></img>
 </div>
   <ul class="list">
   <li class="listit"><a class="navmenu" href="login.php">Uitloggen</a></li>
   <li class="listit"><p class="navmenu"><?php echo $gebruikersnaam ?></p></li>


   </ul>
  </container>
 </nav>
 <div id="navMain" class="nav-tabs-container">


   <div class="row">
   <div class="navdrawer">

        <a class="btn" href="index.php">Home</a><br>
   </div>
   <div class="navdrawer">

        <a class="btn" href="info.php">Persoonlijke informatie</a><br>
   </div>
   <div class="navdrawer">

        <a class="btn" href="facturen.php">Facturen</a><br>
      </div>
      <div class="navdrawer">

           <a class="btn" href="contact.php">Contact</a><br>
         </div>
   </div>

 </div>
</header>
<main>
<div class="container">

  <form method="post">
      <?php include('errors.php'); ?>
    <div class="input-group">
      <div class="container">
        <div class="row">
          <div class="col-sm-4">
            <label>Naam moeder</label>
         </div>
         <div class="col-sm-8">
           <input type="text" class="floater" id="moeder" name="naammoeder" value="<?php echo $naammoeder; ?>">
       </div>
      </div>
     </div>
    </div>
    <div class="input-group">
      <div class="container">
        <div class="row">
          <div class="col-sm-4">
            <label>Naam vader</label>
         </div>
         <div class="col-sm-8">
           <input type="text" class="floater" id="vader" name="naamvader" value="<?php echo $naamvader; ?>">
       </div>
      </div>
     </div>
    </div>
    <div class="input-group">
      <div class="container">
        <div class="row">
          <div class="col-sm-4">
            <label>Adres</label>
         </div>
         <div class="col-sm-8">
           <input type="text" class="floater" id="adres" name="adres" value="<?php echo $adres; ?>">
       </div>
      </div>
     </div>
    </div>
    <div class="input-group">
      <div class="container">
        <div class="row">
          <div class="col-sm-4">
            <label>Postcode + Woonplaats</label>
         </div>
         <div class="col-sm-8">
           <input type="text" class="floater" id="postcode" name="postcode" value="<?php echo $postcode; ?>">
       </div>
      </div>
     </div>
    </div>
    <div class="input-group">
      <div class="container">
        <div class="row">
          <div class="col-sm-4">
            <label>Email</label>
         </div>
         <div class="col-sm-8">
           <input type="text" class="floater" id="email" name="email" value="<?php echo $email; ?>">
       </div>
      </div>
     </div>
    </div>
    <div class="input-group">
      <div class="container">
        <div class="row">
          <div class="col-sm-4">
            <label>Bankrekeningnummer</label>
         </div>
         <div class="col-sm-8">
           <input type="text" class="floater"  id="bank" name="bank" value="<?php echo $bank; ?>">
       </div>
      </div>
     </div>
    </div>
    <div class="input-group">
      <button type="submit" class="btn" name="save">Opslaan</button>
      <a class="btn" href="index.php">Home</a>
    </div>
  </form>

</div>
</main>
</body>
</html>
