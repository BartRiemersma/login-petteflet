<?php
session_start();

//establish an connection to the database
$conn = mysqli_connect('localhost', 'root', '', 'petteplet');

//create an array
$errors = array();

//create varables
$id = "";
$naammoeder = "";
$naamvader = "";
$adres    = "";
$postcode = "";
$email    = "";
$bank = "";

//get the session id.
$idea = $_SESSION['idea'];

//receve data from the database.
echo $idea;
$sql = "SELECT * FROM personen_info WHERE id='$idea' ";
$results = mysqli_query($conn, $sql);
$resultcheck = mysqli_num_rows($results);

if ($resultcheck > 0) {

while($row = mysqli_fetch_assoc($results)) {
  $id = $row['id'];
  $naammoeder = $row['Naam_moeder'];
  $naamvader = $row['Naam_vader'];
  $adres    = $row['Adres'];
  $postcode = $row['postcode_woonplaats'];
  $email    = $row['Email'];
  $bank = $row['bankrekening'];
}


$data = array();
array_push($data, $naammoeder, $naamvader, $adres, $postcode, $email, $bank);
// print_r($data);
}

$errors = array();




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
   <meta name='title' content='De petteflet`s informatiescherm'/>
   <meta name=’description’ content='pas hier uw informatie aan op de website van de petteflet'/>
   <title>Wijzig info</title>
   <link rel="stylesheet" href="cssfiles/edit.css" type="text/css">
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
   <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
   <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
   <script src=" http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>
 </head>
 <body>
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
     </div>
     </div>
   </div>
 </body>
</html>
