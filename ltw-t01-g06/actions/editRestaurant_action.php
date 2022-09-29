<?php
  declare(strict_types = 1); 

  require_once(__DIR__ . '/../utils/session.php');
  $session = new Session();

  require_once(__DIR__ . '/../database/connection.db.php');
  require_once(__DIR__ . '/../database/user.class.php');
  require_once(__DIR__ . '/../database/restaurant.class.php');


  $db = getDatabaseConnection();
  $restaurant_id = $session->getRestaurant();

  $restaurant = Restaurant::getRestaurantWithId($db, (int)$restaurant_id);
  

  try {
    if ($_POST['name'] != null){
    $name = $_POST['name']; 
    $restaurant->updateRestaurantName($db, (int)$restaurant_id, $name);
    }

    if ($_POST['address'] != null){
    $address = $_POST['address']; 
    $restaurant->updateRestaurantAddress($db, (int)$restaurant_id, $address);
    }

    if ($_POST['category'] != null){
      $category = $_POST['category']; 
      $restaurant->updateRestaurantCategory($db, (int)$restaurant_id, $category);
    }
    
    header('Location: ../pages/editRestaurant.php');
  } catch (PDOException $e) {
    die($e->getMessage());
    $session->addMessage('error', 'Failed to update!');
    header('Location: ../pages/editRestaurant.php');
  }

  ?>