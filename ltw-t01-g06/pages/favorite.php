<?php
  declare(strict_types = 1);

  require_once(__DIR__ . '/../utils/session.php');
  $session = new Session();

  require_once(__DIR__ . '/../templates/common.tpl.php');
  require_once(__DIR__ . '/../templates/user.tpl.php');

  require_once(__DIR__ . '/../database/connection.db.php');
  require_once(__DIR__ . '/../database/restaurant.class.php');
  require_once(__DIR__ . '/../database/dish.class.php');

  $db = getDatabaseConnection();
  $username = $session->getUsername();
  if($username!=null){
      $favorites = Restaurant::getFavoriteRestaurants($db, $username);
      $dishes =  Dish::getFavoriteDishes($db, $username);
  }

  drawHeader($session);
  drawFavorite($session, $favorites, $dishes);
  drawFooter();
?>