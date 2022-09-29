<?php
  declare(strict_types = 1); 

  require_once(__DIR__ . '/../utils/session.php');
  $session = new Session();

  require_once(__DIR__ . '/../database/connection.db.php');
  require_once(__DIR__ . '/../database/user.class.php');

  $db = getDatabaseConnection();
  $username = $session->getUsername();
  $user = User::getUser($db, $username);

  try {
    if ($_POST['address'] != null){
    $address = $_POST['address']; 
    $user->updateAddress($db, $username, $address);
    $session->setAddress($address);
    }

    if ($_POST['name'] != null){
    $name = $_POST['name']; 
    $user->updateName($db, $username, $name);
    $session->setName($name);
    }

    if ($_POST['phone'] != null){
      $phone = $_POST['phone']; 
      $user->updatePhone($db, $username, $phone);
      $session->setPhone($phone);
    }

    if ($_POST['password'] != null){
      $password = $_POST['password']; 
      $user->updatePassword($db, $username, $password);
      $session->setPassword($password);
    }
    
    header('Location: ../pages/editProfile.php');
  } catch (PDOException $e) {
    die($e->getMessage());
    $session->addMessage('error', 'Failed to signup!');
    header('Location: ../pages/signup.php');
  }

  ?>