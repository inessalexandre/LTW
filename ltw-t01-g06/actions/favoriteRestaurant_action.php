<?php
  declare(strict_types = 1);

  require_once(__DIR__ . '/../utils/session.php');
  $session = new Session();

  require_once(__DIR__ . '/../database/connection.db.php');
  require_once(__DIR__ . '/../database/user.class.php');

  $db = getDatabaseConnection();
  $username = $session->getUsername();
  $restaurant_id = $_POST['restaurant_id'];
  if($restaurant_id){
    User::insertFavoriteRestaurant($db, $username, (int)$restaurant_id);
     header('Location: ' . $_SERVER['HTTP_REFERER']); 
  }


?>