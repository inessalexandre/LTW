<?php
  declare(strict_types = 1);

  require_once(__DIR__ . '/../utils/session.php');
  $session = new Session();

  require_once(__DIR__ . '/../database/connection.db.php');
  require_once(__DIR__ . '/../database/user.class.php');

  $db = getDatabaseConnection();

  $user = User::getUserWithPassword($db, $_POST['username'], $_POST['password']);
  
  if ($user) {
    $session->setUsername($user->username);
    $session->setName($user->name);
    $session->setAddress($user->address);
    $session->setPhone($user->phone);
    $session->setOwner($user->owner);
    $session->addMessage('success', 'Login successful!');
    header('Location: ../pages/index.php');
  } else {
    $session->addMessage('error', 'Wrong password!');
    header('Location: ../pages/signin.php');
  }

?>
