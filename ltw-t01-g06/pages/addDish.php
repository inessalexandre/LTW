<?php 
  declare(strict_types = 1);

  require_once(__DIR__ . '/../utils/session.php');
  $session = new Session();

  require_once(__DIR__ . '/../database/connection.db.php');

  $db = getDatabaseConnection();

  require_once(__DIR__ . '/../templates/common.tpl.php');
  require_once(__DIR__ . '/../templates/restaurant.tpl.php');
  require_once(__DIR__ . '/../templates/dish.tpl.php');

  $sign = true;
    $session->setRestaurant((int)$_GET['restaurant_id']);
  drawHeader($session, $sign);
  drawAddDishForm($session,(int)$_GET['restaurant_id']);
  drawFooter($sign);
?>