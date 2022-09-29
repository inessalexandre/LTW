<?php
  declare(strict_types = 1);

  require_once(__DIR__ . '/../utils/session.php');
  $session = new Session();

  //if(!isset($_SESSION['restaurant_id'])) die(header('Location: /'));

  require_once(__DIR__ . '/../templates/common.tpl.php');
  require_once(__DIR__ . '/../templates/restaurant.tpl.php');
  require_once(__DIR__ . '/../templates/user.tpl.php');
  require_once(__DIR__ . '/../database/connection.db.php');
  $db = getDatabaseConnection();

  require_once(__DIR__ . '/../database/restaurant.class.php');
  require_once(__DIR__ . '/../database/dish.class.php');

  $username = $session->getUsername();
  $restaurants = Restaurant::getRestaurantsOfOwner($db, $username);


  drawHeader($session);
  drawRestaurantsOfOwner($restaurants);
  drawFooter();
?>