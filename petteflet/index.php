<?php
session_start();
$conn = mysqli_connect('localhost', 'root', '', 'petteplet');
$gebruikersnaam = "";

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
?>
<!DOCTYPE html>
<html>
 <head>
   <title>Home</title>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=yes">
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
   <link rel="stylesheet" href="cssfiles/index.css" type="text/css">

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

        <a class="btn" href="#">Home</a><br>
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
  <p class="welkom">Welkom <?php echo $gebruikersnaam ?></p>
<div class="maincontainer">
  <div class="subcontainer">
    <a class="btn" href="berichten.php">Berichten</a>
    <a class="btn" href="themas.php">Thema's</a>
    <a class="btn" href="info.php">Gegevens Wijzigen</a>
  </div>
  <div class="subcontainer">
    <a class="btn" href="alteredit.php">Info Kinderen</a>
    <a class="btn" href="facturen.php">Facturen</a>
    <a class="btn" href="contact">Contact</a>
  </div>
</div>
</main>
</body>
</html>
