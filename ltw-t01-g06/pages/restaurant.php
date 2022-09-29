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
  require_once(__DIR__ . '/../database/user.class.php');
  require_once(__DIR__ . '/../database/comment.class.php');


  $restaurant = Restaurant::getRestaurantWithId($db, (int)$_GET['restaurant_id']);
  $dishes = Dish::getDishes($db, (int)$_GET['restaurant_id']);
  $comments = CommentRestaurant::getComments($db, (int)$_GET['restaurant_id']);
  $owner = Restaurant::isRestaurantOwner($db, $session->getUsername(), (int)$_GET['restaurant_id']);

  drawHeader($session);
  drawARestaurant($session, $restaurant, $dishes);
  if(!$owner){
    drawCart($session, $restaurant);
    drawComments($session, $restaurant, $comments);
    drawReview($session, $restaurant);
  }
  drawFooter();

?>