<?php
session_start();

// initializing variables
$username = "";
$email    = "";
$errors = array(); 

// connect to the database
$db = mysqli_connect('localhost', 'iwa_2021', 'foi2021', 'iwa_2021_vz_projekt');

// REGISTER USER
if (isset($_POST['reg_user'])) {
  // receive all input values from the form
  $korime = mysqli_real_escape_string($db, $_POST['korime']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $lozinka = mysqli_real_escape_string($db, $_POST['lozinka']);


  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($korime)) { array_push($errors, "Potreban je korime"); }
  if (empty($email)) { array_push($errors, "Potreban je email"); }
  if (empty($lozinka)) { array_push($errors, "Potrebna je lozinka"); }
 

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM korisnik WHERE korime='$korime' OR email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists
    if ($user['korime'] === $korime) {
      array_push($errors, "Korime već postoji");
    }

    if ($user['email'] === $email) {
      array_push($errors, "Email već postoji");
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
  	$password = md5($lozinka);//encrypt the password before saving in the database

  	$query = "INSERT INTO korisnik (korime, email, lozinka) 
  			  VALUES('$korime', '$email', '$lozinka')";
  	mysqli_query($db, $query);
  	$_SESSION['korime'] = $korime;
  	$_SESSION['success'] = "Ulogirani ste";
  	header('location: index.php');
  }
}

// LOGIN USER
if (isset($_POST['login_user'])) {
  $korime = mysqli_real_escape_string($db, $_POST['korime']);
  $lozinka = mysqli_real_escape_string($db, $_POST['lozinka']);

  if (empty($korime)) {
  	array_push($errors, "Potreban je korime");
  }
  if (empty($lozinka)) {
  	array_push($errors, "Potrebna je lozinka");
  }

  if (count($errors) == 0) {
  	$lozinka = md5($lozinka);
  	$query = "SELECT * FROM korisnik WHERE korime='$korime' AND lozinka='$lozinka'";
  	$results = mysqli_query($db, $query);
  	if (mysqli_num_rows($results) == 1) {
  	  $_SESSION['korime'] = $korime;
  	  $_SESSION['success'] = "Ulogirani ste";
  	  header('location: index.php');
  	}else {
  		array_push($errors, "Netolan korime ili lozinka");
  	}
  }
}

?>