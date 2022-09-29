<?php 
  declare(strict_types = 1);

  require_once(__DIR__ . '/../utils/session.php');
  $session = new Session();
  if ($session->isLoggedIn()) die(header('Location: /'));


  require_once(__DIR__ . '/../templates/common.tpl.php');
  $sign = true;
  drawHeader($session, $sign);
  drawSignupForm();
  drawFooter($sign);
?>