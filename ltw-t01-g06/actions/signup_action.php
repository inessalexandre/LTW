<?php
  declare(strict_types = 1); /*qq isso?*/

  require_once(__DIR__ . '/../utils/session.php');
  $session = new Session();

  require_once(__DIR__ . '/../database/connection.db.php');
  require_once(__DIR__ . '/../database/user.class.php');

  $db = getDatabaseConnection();
  
  $username = $_POST['username'];
  $password = $_POST['password'];
  $name = $_POST['name'];
  $address = $_POST['address']; 
  $phone = $_POST['phone'];
  $owner = $_POST['owner'];
  $photo = $_POST['photo'];

  try {
    User::insertUser($db, $username, $name, $address, $phone, $owner, $photo, $password);
    $session->setName($name);
    $session->setUsername($username);
    $session->setAddress($address);
    $session->setPhone($phone);
    $session->setOwner($owner);
    $session->addMessage('success', 'Signed up and logged in!');
    header('Location: ../pages/index.php'); 
  } catch (PDOException $e) {
    die($e->getMessage());
    $session->addMessage('error', 'Failed to signup!');
    header('Location: ../pages/signup.php');
  }
?>