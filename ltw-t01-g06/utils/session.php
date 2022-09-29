<?php
  class Session {
    private array $messages;

    public function __construct() {
      session_start();

      $this->messages = isset($_SESSION['messages']) ? $_SESSION['messages'] : array();
      unset($_SESSION['messages']);
    }

    public function isLoggedIn() : bool {
      return isset($_SESSION['username']);    
    }

    public function logout() {
      session_destroy();
    }

    //user
    public function getUsername() : ?string {
      return isset($_SESSION['username']) ? $_SESSION['username'] : null;
    }

    public function getName() : ?string {
      return isset($_SESSION['name']) ? $_SESSION['name'] : null;
    }

    public function getAddress() : ?string {
      return isset($_SESSION['address']) ? $_SESSION['address'] : null;
    }

    public function getPhone() : ?string {
      return isset($_SESSION['phone']) ? $_SESSION['phone'] : null;
    }

    public function getPassword() : ?string {
      return isset($_SESSION['password']) ? $_SESSION['password'] : null;
    }

    public function getOwner() : ?string {
      return isset($_SESSION['owner']) ? $_SESSION['owner'] : null;
    }

    public function getRestaurant() {
      return isset($_SESSION['restaurant_id']) ? $_SESSION['restaurant_id'] : null;
    }

    public function setUsername(string $username) {
      $_SESSION['username'] = $username;
    }

    public function setName(string $name) {
      $_SESSION['name'] = $name;
    }

    public function setAddress(string $address) {
      $_SESSION['address'] = $address;
    }

    public function setPhone(string $phone) {
      $_SESSION['phone'] = $phone;
    }
    
    public function setPassword(string $password) {
      $_SESSION['password'] = $password;
    }
    public function setOwner(string $owner) {
      $_SESSION['owner'] = $owner;
    }
    

    public function addMessage(string $type, string $text) {
      $_SESSION['messages'][] = array('type' => $type, 'text' => $text);
    }

    public function getMessages() {
      return $this->messages;
    }

    public function setRestaurant(int $restaurant_id) {
      $_SESSION['restaurant_id'] = $restaurant_id;
    }

  }
?>