<?php
require_once 'auth.php';

if(checkAuth()) 
{
  header("Location: home.php");
  exit;
}   

   // Verifica l'esistenza di dati POST
   if(!empty($_POST["username"]) && !empty($_POST["password"]) && !empty($_POST["email"]) && !empty($_POST["confirmpassword"]))
   {
    $error = array();
    $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']) or die(mysqli_error($conn));

    //controllo username
    //la funzione preg_match ha come primo parametro il pattern e secondo la stringa che deve matchare
    //restituisce 0 se non matcha 
    //il pattern "/^[a-zA-Z0-9]+$/" corrisponde a una stringa che contiene solo caratteri alfanumerici
    if(!preg_match('/^[a-zA-Z0-9]+$/', $_POST['username'])) 
    {
        $error[] = "L'username può contenere solo caratteri alfanumerici";
    } 
    else 
    {
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $query = "SELECT username FROM users WHERE username = '$username'";
        $res = mysqli_query($conn, $query);
        if(mysqli_num_rows($res) > 0) 
        {
            $error[] = "Username già utilizzato. Provane un altro";
        }
    }

    //controllo password
    //controllo lunghezza minima
    if(strlen($_POST["password"]) < 7)
    {
        $error[] = "La password deve avere almeno 7 caratteri";
    }
    //strpos ritorna la posizione del carattere nella stringa, false se non lo trova
    if(strpos($_POST["password"], ' ') !== false)
    {
        $error[] = "La password non può contenere spazi";
    }

    //confirm password
    if(strcmp($_POST["password"], $_POST["confirmpassword"]) != 0) 
    {
        $error[] = "Le password non coincidono";
    }

    //controllo e-mail
    if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) 
    {
        $error[] = "E-mail non valida";
    } 
    //nel DB l'email è unique
    else 
    {
        $email = mysqli_real_escape_string($conn, strtolower($_POST['email']));
        $res = mysqli_query($conn, "SELECT email FROM users WHERE email = '$email'");
        if (mysqli_num_rows($res) > 0) 
        {
            $error[] = "Email già utilizzata";
        }
    }

    //se l'array error è vuoto possiamo inserire l'user nel DB 
    if(count($error) == 0) 
    {
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $password = password_hash($password, PASSWORD_BCRYPT);

        $query = "INSERT INTO users(username, email, password) VALUES('$username', '$email', '$password')";

        if(mysqli_query($conn, $query)) 
        {
            $_SESSION["_session_username"] = $_POST["username"];
            $_SESSION["_session_id"] = mysqli_insert_id($conn);
            mysqli_close($conn);
            header("Location: home.php");
            exit;
        } 
        else 
        {
            $error[] = "Errore di connessione al Database";
        }
    }
    mysqli_close($conn);

  }
  else if(isset($_POST["username"]))
  {
    $error = array("Riempi tutti i campi");
  }

?>

<html>

<head>
    <title>HW1 SIGN UP</title>

    <link rel="stylesheet" href="reg.css"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="reg.js" defer></script>

  </head>
  
<body>

<div id='register'>
<h1>Create your account<br><img id="profile" src="athletic-man-torso-icon-digital-blue-vector-25339057.png"></h1>

 <!-- -->
 <!--metodo post per non far comparire i dati nell'url-->
 <form name='cred' method='post' autocomplete='off'>

    <!--metto ogni elemento del form dentro un label per allineare gli elementi tramite css-->
    <!--quando effettuiamo il submit, se non va a buon fine torniamo su questa pagina e ricarichiamo i dati-->
      <label><img class="icon" src="64572.png"><input class="campoform" type='text' name='username' placeholder="Your username"
      <?php if(isset($_POST["username"]))
      {
        echo "value=".$_POST["username"];
      } 
      ?>></label>
      <em id="emuser"></em>

      <label><img class="icon" src="icona-email-.png"><input class="campoform" type='text' name='email' placeholder="Your e-mail address"
      <?php if(isset($_POST["email"]))
      {
        echo "value=".$_POST["email"];
      } 
      ?>></label>
      <em id="ememail"></em>

      <label><img class="icon" src="img_131108.png"><input class="campoform" type='password' name='password' placeholder="Your password"
      <?php if(isset($_POST["password"]))
      {
        echo "value=".$_POST["password"];
      } 
      ?>></label>
      <em id="empass"></em>

      <label><img class="icon" src="img_131108.png"><input class="campoform" type='password' name='confirmpassword' placeholder="Confirm your password"
      <?php if(isset($_POST["confirmpassword"]))
      {
        echo "value=".$_POST["confirmpassword"];
      } 
      ?>></label>
      <em id="emconf"></em>



<?php if(isset($error)) 
      {
        foreach($error as $err)
        {
            echo "<div class='errorj'><span>".$err."<img src='1274013.png'></span></div>";        
        }

      } 
?>

      <label>&nbsp;<input class="signup" type='submit' value="SIGN UP"></label>
</form>

<div>Hai un account? <a id="log" href="login.php">Accedi</a>

</div>



</body>

</html>