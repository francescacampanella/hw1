<?php
  //checkAuth ritorna la sessione, se esiste già, oppure zero
  include 'auth.php';
  if (checkAuth()){
    header('Location: home.php');
    exit;
  }

  //verifico che i campi sono pieni
  if (!empty($_POST["username"]) && !empty($_POST["password"]) ){
    //non serve includere il file dbconfig perché auth lo include già
    //mi collego al db
    $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']) or die(mysqli_error($conn));

    //cerco utenti con quelle credenziali 
    $username = mysqli_real_escape_string($conn, $_POST['username']);

    $query = "SELECT * FROM users WHERE username = '".$username."' ";
    
    $res = mysqli_query($conn, $query) or die(mysqli_error($conn));;
    
    if (mysqli_num_rows($res) > 0) {
      $entry = mysqli_fetch_assoc($res);
        //password_verify() è una funzione in PHP utilizzata per 
        //verificare se una password fornita dall'utente 
        //corrisponde ad una password precedentemente crittografata
        if (password_verify($_POST['password'], $entry['password'])) {
          $_SESSION["_session_username"]=$entry['username'];
          $_SESSION["_session_id"] = $entry['id'];
          //vado alla home
          header("Location: home.php");
          mysqli_free_result($res);
          mysqli_close($conn);
          exit;
        }
      }
    
    //se siamo qui significa che le credenziali inserite non sono corrette
    $error = "Credenziali non valide";
   }

   else if(isset($_POST["username"]) || isset($_POST["password"])) {
    $error = "Inserisci username e password";
   }

?>

<html>

<head>
    <title>HW1 LOG IN</title>

    <link rel="stylesheet" href="login.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">

  </head>
  

  <body>

<div id='register'>
<h1>Log into your account<br><img id="profile" src="athletic-man-torso-icon-digital-blue-vector-25339057.png"></h1>

 <form name='cred' method='post' autocomplete='off'>

    <!--metto ogni elemento del form dentro un label per allineare gli elementi tramite css-->
    <!--quando effettuiamo il submit, se non va a buon fine torniamo su questa pagina e ricarichiamo i dati-->
      <label><img class="icon" src="64572.png"><input class="campoform" type='text' name='username' placeholder="Your username"
      <?php if(isset($_POST["username"]))
      {
        echo "value=".$_POST["username"];
      } 
      ?>></label>

      <label><img class="icon" src="img_131108.png"><input class="campoform" type='password' name='password' placeholder="Your password"
      <?php if(isset($_POST["password"]))
      {
        echo "value=".$_POST["password"];
      } 
      ?>></label>

<?php 
if (isset($error)) {
  echo "<div class='errorj'><span>".$error."<img src='1274013.png'></span></div>";        
}
?>

      <label>&nbsp;<input class="signup" type='submit' value="LOG IN"></label>
</form>

<div>Non hai un account? <a id="reg" href="reg.php">Registrati</a>

</div>

</body>

</html>