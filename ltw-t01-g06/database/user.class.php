<?php
  declare(strict_types = 1);

  class User {
    public string $username;
    public string $name;
    public string $address;
    public string $phone;
    public string $owner;
    public string $photo;

    public function __construct(string $username, string $name, string $address, string $phone, string $owner, string $photo)
    {
      $this->username = $username;
      $this->name = $name;
      $this->address = $address;
      $this->phone = $phone;
      $this->owner = $owner;
      $this->photo = $photo;
    }

    function save($db) {
      $stmt = $db->prepare('
        UPDATE User SET name = ?
        WHERE username = ?
      ');

      $stmt->execute(array($this->name, $this->username));
    }
    
    function getUserWithPassword(PDO $db, string $username, string $password) : ?User {
      $stmt = $db->prepare('SELECT * FROM User WHERE username = ? AND password = ?');
      
      $stmt->execute(array(strtolower($username), $password));
      
      if ($user = $stmt->fetch()) {
        return new User(
        $user['username'],
        $user['name'],
        $user['address'],
        $user['phone'],
        $user['owner'],
        $user['photo'] 
        );
      } else return null;
    }

    function insertUser(PDO $db, string $username, string $name, string $address, string $phone, string $owner, string $photo=null, string $password) {

      $options = ['cost' => 12]; 

      $stmt = $db->prepare('INSERT INTO User VALUES(?, ?, ?, ?, ?, ?, ?)');
      $stmt->execute(array($username, $name, $address, $phone, $owner, $photo, password_hash($password, PASSWORD_DEFAULT, $options)));
    }
    
    function getUser(PDO $db, string $username) : ?User {
      $stmt = $db->prepare('SELECT * FROM User WHERE username = ?');

      $stmt->execute(array(strtolower($username)));

      if ($user = $stmt->fetch()) {
        return new User(
        $user['username'],
        $user['name'],
        $user['address'],
        $user['phone'],
        $user['owner'],
        $user['photo'] 
        );
      } else return null;
    }

    function updateName(PDO $db, string $username, string $name){
      $stmt = $db->prepare('UPDATE User SET name = ? WHERE username = ?');
      $stmt->execute(array($name, $username));
    }

    function updateAddress(PDO $db, string $username, string $address){
      $stmt = $db->prepare('UPDATE User SET address = ? WHERE username = ?');
      $stmt->execute(array($address, $username));
    }

    function updatePhone(PDO $db, string $username, string $phone){
      $stmt = $db->prepare('UPDATE User SET phone = ? WHERE username = ?');
      $stmt->execute(array($phone, $username));
    }

    function updatePassword(PDO $db, string $username, string $password){
      $stmt = $db->prepare('UPDATE User SET password = ? WHERE username = ?');
      $stmt->execute(array($password, $username));
    }

    function deleteUser(PDO $db, string $username) {
      $stmt = $db->prepare('DELETE FROM User WHERE username= ?');
      $stmt->execute(array($username));
    }

    function deleteProfilePhoto(string $photo) {
      unlink();
    }
    function insertFavoriteRestaurant(PDO $db, string $username, int $restaurant_id){
      $stmt = $db->prepare('INSERT INTO FavoriteRestaurant VALUES(?, ?)');
      $stmt->execute(array($username, $restaurant_id));
      if($stmt->fetch()){
        return true;
      } else return false;
    }
    
    function deleteFavoriteRestaurant(PDO $db, string $username, int $restaurant_id) {
      $stmt = $db->prepare('DELETE FROM FavoriteRestaurant WHERE username = ? AND restaurant_id = ?');//mudar
      $stmt->execute(array($username, $restaurant_id));
    }

    function insertFavoriteDish(PDO $db, string $username, int $dish_id){
      $stmt = $db->prepare('INSERT INTO FavoriteDish VALUES(?, ?)');
      $stmt->execute(array($username, $dish_id));
      if($stmt->fetch()){
        return true;
      } else return false;
    }
    function deleteFavoriteDish(PDO $db, string $username, int $dish_id) {
      $stmt = $db->prepare('DELETE FROM FavoriteDish WHERE username = ? AND dish_id = ?');
      $stmt->execute(array($username, $dish_id));
    }




  }

?>