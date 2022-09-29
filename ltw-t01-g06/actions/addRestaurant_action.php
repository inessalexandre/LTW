<?php
  declare(strict_types = 1); 

  require_once(__DIR__ . '/../utils/session.php');
  $session = new Session();

  require_once(__DIR__ . '/../database/connection.db.php');
  require_once(__DIR__ . '/../database/restaurant.class.php');
  require_once(__DIR__ . '/../database/user.class.php');


  $db = getDatabaseConnection();
  $username = $session->getUsername();
  $user = User::getUser($db, $username);

  $name = $_POST['name'];
  $address = $_POST['address'];
  $category = $_POST['category'];
  $photo = $_POST['photo'];

  try {
    Restaurant::insertRestaurant($db, $username, $name, $address, $category, $photo);
    $session->addMessage('success', 'Add Restaurant with sucess!');
    if($session->getOwner()=="No"){
       $session->setOwner("Yes");
    }
    header('Location: ../pages/index.php'); 
  } catch (PDOException $e) {
    die($e->getMessage());
    $session->addMessage('error', 'Failed to add restaurant!');
    header('Location: ../pages/addRestaurant.php');
  }
?>