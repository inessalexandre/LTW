<?php
  declare(strict_types = 1);

  require_once(__DIR__ . '/../utils/session.php');
  $session = new Session();

  require_once(__DIR__ . '/../templates/common.tpl.php');
  require_once(__DIR__ . '/../templates/restaurant.tpl.php');
  require_once(__DIR__ . '/../database/restaurant.class.php');

  require_once(__DIR__ . '/../database/connection.db.php');
  $db = getDatabaseConnection();
  $username = $session->getUsername();

  $restaurants = Restaurant::getRestaurants($db);
  $sorted_restaurants = $restaurants;
  usort($sorted_restaurants, function($a, $b)
             {
                if ($a->score == $b->score)
                  return (0);
                return (($a->score > $b->score) ? -1 : 1);
             });

  
  drawHeader($session);
  drawRestaurants($session, $restaurants, $sorted_restaurants);
  drawFooter();
?>
