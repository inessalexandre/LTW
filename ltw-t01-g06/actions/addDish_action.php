<?php
  declare(strict_types = 1); 

  require_once(__DIR__ . '/../utils/session.php');
  $session = new Session();

  require_once(__DIR__ . '/../database/connection.db.php');
  require_once(__DIR__ . '/../database/restaurant.class.php');
  require_once(__DIR__ . '/../database/dish.class.php');
  $db = getDatabaseConnection();
  $restaurant_id = $session->getRestaurant();

  $name = $_POST['name'];
  $category = $_POST['category'];
  $price = (real)$_POST['price'];
  $photo = $_POST['photo'];

  try {
    Dish::insertDish($db, $name, $restaurant_id, $category, $price, $photo);
    $session->addMessage('success', 'Add Dish with sucess!');
    header('Location: ../pages/restaurant.php');
  } catch (PDOException $e) {
    die($e->getMessage());
    $session->addMessage('error', 'Failed to add dish!');
    header('Location: ../pages/addDish.php');
  }
?> 