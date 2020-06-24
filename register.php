<?php
include 'includes/session.php';

if (isset($_POST['signup'])) {
    $firstname=$_POST['firstname'];
    $lastname=$_POST['lastname'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $repassword = $_POST['c-password'];
  $_SESSION['email'] = $email;
  $_SESSION['firstname'] = $firstname;
  $_SESSION['lastname'] = $lastname;



  if ($password != $repassword) {
    $_SESSION['error'] = 'Passwords did not match';
    header('location: signup.php');
  } else {
    $conn = $pdo->open();

    $stmt = $conn->prepare("SELECT COUNT(*) AS numrows FROM users WHERE email=:email");
    $stmt->execute(['email' => $email]);
    $row = $stmt->fetch();
    if ($row['numrows'] > 0) {
      $_SESSION['error'] = 'Email already taken';
      header('location: signup.php');
    } else {
      $now = date('Y-m-d');
      $password = password_hash($password, PASSWORD_DEFAULT);
   
      try {
       $stmt = $conn->prepare("INSERT INTO users (firstname, lastname, email, password, created_on) VALUES (:firstname, :lastname, :email, :password, :created_on)");
        $stmt->execute(['firstname'=> $firstname, 'lastname'=> $lastname, 'email' => $email, 'password' => $password, 'created_on' => $now]);
        $userid = $conn->lastInsertId();
                

  } catch (PDOException $e) {
        $_SESSION['error'] = $e->getMessage();
      }
      $pdo->close();
    }
  }
} else {
  $_SESSION['error'] = 'Fill up signup form first';
}
header('location: signup.php');
