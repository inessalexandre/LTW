<?php
  declare(strict_types = 1); 

  require_once(__DIR__ . '/../utils/session.php');
  $session = new Session();

  require_once(__DIR__ . '/../database/connection.db.php');
  require_once(__DIR__ . '/../database/restaurant.class.php');
  require_once(__DIR__ . '/../database/comment.class.php');


  $db = getDatabaseConnection();
  $username = $session->getUsername();
  $restaurant_id = $session->getRestaurant();

  $score = (float)$_POST['score'];
  $text = $_POST['text'];

  try {
    CommentRestaurant::insertComment($db, $restaurant_id, $username, (float)$score, $text);
    $session->addMessage('success', 'Add Comment with sucess!');
    header('Location: ' . $_SERVER['HTTP_REFERER']);
  } catch (PDOException $e) {
    die($e->getMessage());
    $session->addMessage('error', 'Failed to add comment!');
    header('Location: ' . $_SERVER['HTTP_REFERER']); 
  }
?>