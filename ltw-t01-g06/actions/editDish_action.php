<?php
  declare(strict_types = 1); 

  require_once(__DIR__ . '/../utils/session.php');
  $session = new Session();

  require_once(__DIR__ . '/../database/connection.db.php');
  require_once(__DIR__ . '/../database/user.class.php');

  $db = getDatabaseConnection();
  $dish_id = (int)$_GET['dish_id'] ;
  $dish = Dish::getDishWithId($db, (int)$_GET['dish_id']);
  
  try {
    if ($_POST['name'] != null){
        $name = $_POST['name']; 
        $restaurant->updateDishName($db, $dish_id, $name);
    }

    if ($_POST['category'] != null){
        $category = $_POST['category']; 
        $user->updatePhone($db, $dish_id, $category);
    }

    if ($_POST['price'] != null){
        $address = $_POST['price']; 
        $user->updateAddress($db, $dish_id, $price);
    }
    
    header('Location: ../pages/editDish.php');
  } catch (PDOException $e) {
    die($e->getMessage());
    $session->addMessage('error', 'Failed to update!');
    header('Location: ../pages/editDish.php');
  }

  ?>