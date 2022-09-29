<?php
  declare(strict_types = 1);

  class Restaurant {
    public int $restaurant_id;
    public string $name;
    public string $address;
    public string $category;
    public float $score;
    public string $photo;

    public function __construct(int $id, string $name, string $address, string $category, float $score=0, string $photo=null)
    {
      $this->restaurant_id = $id;
      $this->name = $name;
      $this->address = $address;
      $this->category = $category;
      $this->score = $score;
      $this->photo = $photo;
    }

  function getRestaurants(PDO $db){
      $stmt = $db->prepare('SELECT * from Restaurant');
        
      $stmt->execute();
      $restaurants = array();
        while ($restaurant = $stmt->fetch()) {
            $restaurants[] = new Restaurant(
                (int)$restaurant['restaurant_id'],
                $restaurant['name'],
                $restaurant['address'],
                $restaurant['category'],
                (real)$restaurant['score'],
                $restaurant['photo']
              );
        }
        return $restaurants;
    }

    function searchRestaurant(PDO $db, string $search, int $count) {
      $stmt = $db->prepare('SELECT * FROM Restaurant WHERE name LIKE ? LIMIT ?');
      $stmt->execute(array($search . '%', $count));

      $restaurants = array();
      if ($search == "") {
        return $restaurants;
      }
      while ($restaurant = $stmt->fetch()) {
        $restaurants[] = new Restaurant(
          (int)$restaurant['restaurant_id'],
          $restaurant['name'],
          $restaurant['address'],
          $restaurant['category'],
          (real)$restaurant['score'],
          $restaurant['photo']
        );
      }

      return $restaurants;
    }
    
    function getRestaurantWithType(PDO $db, string $category) : ?Restaurant {
        //fzr a coisa do explode e tal $tags = explode(',', $article['tags']); N FAZER N DA TEMPO
        
        $stmt = $db->prepare('SELECT restaurant_id, name, address, category, score, photo
          FROM Restaurant
          WHERE lower(category) = ?
        ');
        
        $stmt->execute(array(strtolower($category)));
        
        if ($restaurant = $stmt->fetch()) {
          return new Restaurant(
          (int)$restaurant['restaurant_id'],
          $restaurant['name'],
          $restaurant['address'],
          $restaurant['category'],
          (float)$restaurant['score'],
          $restaurant['photo'] 

          );
        } else return null;
    }

    function getRestaurantWithId(PDO $db, int $restaurant_id) : ?Restaurant {
      $stmt = $db->prepare('SELECT * from Restaurant where restaurant_id = ?');
      
      $stmt->execute(array($restaurant_id));
      
      if ($restaurant = $stmt->fetch()) {
        return new Restaurant(
        (int)$restaurant['restaurant_id'],
        $restaurant['name'],
        $restaurant['address'],
        $restaurant['category'],
        (float)$restaurant['score'],
        $restaurant['photo'] 

        );
      } else return null;
  }


    static function getFavoriteRestaurants(PDO $db, string $username) : array {
        $stmt = $db->prepare('SELECT * from Restaurant where Restaurant.restaurant_id in (SELECT restaurant_id FROM FavoriteRestaurant WHERE username = ?)');
        
        $stmt->execute(array($username));
        
        $favorites = array();
        while ($favorite = $stmt->fetch()) {
            $favorites[] = new Restaurant(
                (int)$favorite['restaurant_id'],
                $favorite['name'],
                $favorite['address'],
                $favorite['category'],
                (real)$favorite['score'],
                $favorite['photo']
              );
        }
        return $favorites;
    }

    function insertRestaurant(PDO $db, string $username, string $name, string $address, string $category, string $photo=null) {
      $count = $db->prepare('SELECT restaurant_id FROM Restaurant ORDER BY restaurant_id DESC LIMIT 1');
      $count->execute();
      $count = $count->fetchAll();
      $stmt = $db->prepare('INSERT INTO Restaurant VALUES(?, ?, ?, ?, ?, ?)');
      $stmt->execute(array($count[0]["restaurant_id"]+1, $name, $address, $category, 0, $photo));

      $owner = $db->prepare('INSERT INTO RestaurantOwner VALUES (?, ?)');
      $owner->execute(array($username, $count[0]["restaurant_id"]+1));
    }

    function isRestaurantFavorite(PDO $db, string $username, int $restaurant_id) {
      $stmt = $db->prepare('SELECT * FROM FavoriteRestaurant WHERE username = ? AND restaurant_id = ?');
      $stmt->execute(array($username, $restaurant_id));
      if($stmt->fetch()){
        return true;
      } else return false;
    }

    function getRestaurantsOfOwner(PDO $db, string $username) : array {
      $stmt = $db->prepare('SELECT * from Restaurant where Restaurant.restaurant_id in (SELECT restaurant_id FROM RestaurantOwner WHERE username = ?)');
      
      $stmt->execute(array($username));
      
      $restaurants = array();
      while ($restaurant = $stmt->fetch()) {
          $restaurants[] = new Restaurant(
              (int)$restaurant['restaurant_id'],
              $restaurant['name'],
              $restaurant['address'],
              $restaurant['category'],
              (real)$restaurant['score'],
              $restaurant['photo']
            );
      }
      return $restaurants;
  }
  function isRestaurantOwner(PDO $db, string $username, int $restaurant_id) {
    $stmt = $db->prepare('SELECT * FROM RestaurantOwner WHERE username = ?');
    $stmt->execute(array($username));
    $items = $stmt->fetchAll();
    foreach ($items as $item) {
      if ($item["restaurant_id"] == (string) $restaurant_id) {
        return true;
      }
    }
    return false;

  }

  function updateRestaurantName(PDO $db, int $restaurant_id, string $name){
    $stmt = $db->prepare('UPDATE Restaurant SET restaurant_id = ? AND name = ?');
    $stmt->execute(array( $restaurant_id, $name));
  }

  function updateRestaurantAddress(PDO $db, int $restaurant_id, string $address){
    $stmt = $db->prepare('UPDATE Restaurant SET address = ? WHERE restaurant_id = ?');
    $stmt->execute(array($restaurant_id, $address));
  }

  function updateRestaurantCategory(PDO $db, int $restaurant_id, string $category){
    $stmt = $db->prepare('UPDATE Restaurant SET name = ? WHERE restaurant_id = ?');
    $stmt->execute(array($restaurant_id, $category));
  }

}
?>