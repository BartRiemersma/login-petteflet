<?php

session_start();

//make a connection
$conn = mysqli_connect('localhost', 'root', '', 'petteplet');

//create variables
$id = "";
$naamkind = "";
$leeftijd = "";
$geslacht = "";
$gebruikersnaam = "";

//get the session id
$idea = $_SESSION['idea'];

//this part receives the username from the database
$sql = "SELECT * FROM users WHERE id='$idea' ";
$results = mysqli_query($conn, $sql);
$resultcheck = mysqli_num_rows($results);

//check if there are acual values in the variable
if ($resultcheck > 0) {

//and put it into an official varaible
  while($row = mysqli_fetch_assoc($results)) {
    $gebruikersnaam = $row['gebruikersnaam'];
  }
}



//establish errorarrays (will use for errorpopups)
$errors = array();
$nodata = array();

//now get the info from the database that the consumer will use
$idea = $_SESSION['idea'];


$sql = "SELECT * FROM kinderen_info WHERE id='$idea'";
$results = mysqli_query($conn, $sql);
$resultcheck = mysqli_num_rows($results);
//check if there are values
if (empty($resultcheck)) {

 //if there is no data then there will be an errorpopup
  array_push($nodata, "Geen data gevonden");


//the variables will stay empty and will display that
  $id = $_SESSION['idea'];
  $naamkind = 'Leeg!';
  $leeftijd = 'Leeg!';
  $geslacht = 'Leeg!';



} else {




  while($row = mysqli_fetch_assoc($results)) {
  $id = $row['id'];
  $naamkind = $row['Naam_kind'];
  $leeftijd = $row['Leeftijd'];
  $geslacht = $row['Geslacht'];

  }


}


//$datas[] = $row;
//   $datas = array();
//   $exitdata = array();
//
// //if there is data then run it through here
//
//each piece of data will be displayed in its own box
//
//
// <?php if (count($nodata) == 0) :
//
//
// <?php  foreach ($datas as $data) :
//     <div class=results>
//
//         <div class="resultations">
//          <p class="input"><?php echo $naamkind ?</p>
//         </div>
//
//         <div class="resultations">
//          <p class="input"><?php echo $leeftijd ?</p>
//         </div>
//
//         <div class="resultations">
//          <p class="input"><?php echo $geslacht ?</p>
//         </div>
//
//
//     </div>
//
//   <?php endforeach ?
// <?php endif

?>














 <!DOCTYPE html>
 <html>
  <head>
    <title>Home</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=yes">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link rel="stylesheet" href="cssfiles/alteredit.css" type="text/css">
    <script src="http://code.jquery.com/jquery-latest.min.js"></script>
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
        <p class="welkom">Informatie kinderen</p>
        <form method="post">


        <div class="menu">

          <a class="knop1" id="add">Toevoegen</a>
          <button class="knop2" name="save">Opslaan</button>
          <?php include('errors.php'); ?>


        </div>
          <div class="input-group">


               <div id="addhere">
                 <div class="parent" id="parent">
                   <div class="bak1">
                    <div class="headline">
                     <div class="textholder">

                       <div class="label">
                           <p>Naam kind</p>
                       </div>

                       <div class="textbalk">
                          <input type="text" class="savethis, floater" name="naamkind"></input>

                       </div>
                     </div>
                    </div>
                   </div>
                   <div class="bak2">
                    <div class="headline">
                     <div class="textholder">

                      <div class="label">
                       <p>Leeftijd</p>
                      </div>

                      <div class="textbalk">
                      <input type="text" class="savethis, floater" name="leeftijd"></input>
                      </div>

                     </div>
                    </div>
                   </div>
                   <div class="bak3">
                    <div class="headline">
                     <div class="textholder">

                      <div class="label">
                       <p>Geslacht</p>
                      </div>

                      <div class="textbalk">
                       <input type="text" class="savethis, floater" name="geslacht"></input>
                      </div>

                     </div>
                    </div>
                   </div>
                   <a id="minWord" class="min">Verwijderen</a>
                 </div>
              </div>


              <div id="results">

                <div class="resultations">
                 <p class="input"><?php echo $naamkind ?></p>
                </div>

                <div class="resultations">
                 <p class="input"><?php echo $leeftijd ?></p>
                </div>

                <div class="resultations">
                 <p class="input"><?php echo $geslacht ?></p>
                </div>


              </div>


            </div>
        </form>


    </main>

    <?php

    if (isset($_POST['save'])) {


      // receive all input values from the form
      $naamkind = $_POST['naamkind'];
      $leeftijd = $_POST['leeftijd'];
      $geslacht = $_POST['geslacht'];


      // form validation: ensure that the form is correctly filled
      if (empty($naamkind)) { array_push($errors, "Naam is nodig"); }
      if (empty($leeftijd)) { array_push($errors, "Leeftijd is nodig"); }
      if (empty($geslacht)) { array_push($errors, "kies een geslacht"); }

      //
      // unset($id);
      // unset($naamkind);
      // unset($leeftijd);
      // unset($geslacht);
      //





      if (count($errors) == 0) {



        // while ($arraynumber < 0) {
        //
        //   if ([i] == $newdata[i]) {
        //
        //   }
        // }
        $query = "INSERT INTO kinderen_info (id, Naam_kind, Leeftijd, Geslacht)
              VALUES('$id',  '$naamkind', '$leeftijd', '$geslacht')";
        $add = mysqli_query($conn, $query);





     } else {

       $query = "UPDATE kinderen_info SET Naam_kind='$naamkind', Leeftijd='$leeftijd', Geslacht='$geslacht' WHERE id='$idea' ";
       $update = mysqli_query($conn, $query);


     }




    }
     ?>

    <script>





    $(document).on('click', '#add', function() {

    $("#parent").show();
    });


    $(document).on('click', '#minWord', function() {
      $("#parent").hide();
    });




    </script>
    {{> hello}}
  </body>


  <template name="hello">
    <p>hello</p>
  </template>
  </html>
