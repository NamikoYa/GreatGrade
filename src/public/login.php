<?php

//Session starten
session_start();
if(isset($_SESSION['loggedin'])) {
    session_unset();
    session_destroy();
}

// Include database connection
include '../db_connector.php';

$error = '';
$message = '';


// Formular wurde gesendet und Benutzer ist noch nicht angemeldet.
if ($_SERVER["REQUEST_METHOD"] == "POST"){
	if(isset($_POST['username'])){
		//trim
        $username = trim($_POST['username']);
    }
	// password
	if(isset($_POST['password'])){
		//trim
        $password = trim($_POST['password']);
    }

    // kein fehler
	if(empty($error)){

		// TODO SELECT Query erstellen, user und passwort mit Datenbank vergleichen
		$query = "SELECT username, password FROM tbl_users where  username = ?";

		// TODO prepare()
		$stmt = $mysqli->prepare($query);
			if($stmt === false){
				$error .= 'prepare() failed '. $mysqli->error . '<br>';
			}

		// TODO bind_param()
		if (!$stmt->bind_param('s', $username)) {
			$error .= 'bind_param() failed ' . $mysqli->error . '<br>';
		}
		// TODO execute()
		if (!$stmt->execute()) {
			$error .= 'execute() failed ' . $mysqli->error . '<br>';
		}

		// Daten auslesen
		$result = $stmt->get_result();

		//Benutzer vorhanden
		if ($result->num_rows) {
			
			//Daten lesen
			$row = $result->fetch_assoc();
		
			// TODO Passwort auslesen und mit dem eingegeben Passwort vergleichen
			if (password_verify($password, $row['password'])) {
				
                //Variablen setzten
                session_start();
				$_SESSION['loggedin'] = true;
                $_SESSION['username'] = $row['username'];
                $_SESSION['password'] = $password;
                session_regenerate_id(true);

				header("Location: ./index.php?view=home");
			// TODO: wenn Passwort korrekt:  $message .= "Sie sind nun eingeloggt"; 
			//$message .= "Sie haben sich erfolgreich eingeloggt!";

			// TODO: wenn Passwort falsch, oder kein Benutzer mit diesem Benutzernamem in DB:
			}else{
				$error .= "Benutzername oder Passwort sind falsch";
			}
		}else{
			$error .= "Benutzername oder Passwort sind falsch";
        }
	}
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="description" content="Projektarbeit Modul 151">
    <meta name="author" content="Natascha Wernli and Sara Roth">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- Icons -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css"
        integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
    <!-- Stylesheets -->
    <link rel="stylesheet" type="text/css" href="../css/gg_stylesheet.css">

    <title>GreatGrade</title>
</head>

<body>
    <div class="background">
        <div class="user_login">
        <?php
                // print error or message
                if(!empty($message)){
                    echo "<div class=\"alert alert-success\" role=\"alert\">" . $message . "</div>";
                } else if(!empty($error)){
                    echo "<div class=\"alert alert-danger\" role=\"alert\">" . $error . "</div>";
                }
            ?>
            <div class="d-flex justify-content-center">
                <img src="../../img/GreatGrade.png" class="d-inline-block align-top" alt="GreatGrade" width="220" height="220">
            </div>
            <div class="d-flex justify-content-center form_container">
                <form action="" method="POST">
                    <div class="input-group mb-3">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                            <input type="text" name="username" id="username" class="form-control input_user" value=""
                                placeholder="Benutzername">
                        </div>
                    </div>
                    <div class="input-group mb-2">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fas fa-key"></i></span>
                            <input type="password" name="password" id="password" class="form-control input_pass"
                                value="" placeholder="Passwort">
                        </div>
                    </div>
                    <div class="d-flex justify-content-center mt-3 login_container">
                        <button type="submit" name="button" value="submit"
                            class="btn btn-outline-dark">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  
</body>
</html>