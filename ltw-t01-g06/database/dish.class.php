<?php
  declare(strict_types = 1);

  class Dish {
    public int $dish_id;
    public string $name;
    public int $restaurant_id;
    public string $category;
    public float $price;
    public string $photo;

    public function __construct(int $id, string $name, int $restaurant_id, string $category, float $price, string $photo)
    {
      $this->dish_id = $id;
      $this->name = $name;
      $this->restaurant_id = $restaurant_id;
      $this->category = $category;
      $this->price = $price;
      $this->photo = $photo;
    }

    function getDishWithId(PDO $db, int $dish_id) : ?Dish {
      $stmt = $db->prepare('SELECT * from Dish where dish_id = ?');
      
      $stmt->execute(array($id));
      
      if ($dish = $stmt->fetch()) {
        return new Restaurant(
        (int)$dish['dish_id'],
        $dish['name'],
        $dish['restaurant_id'],
        $dish['category'],
        (real)$restaurant['price'],
        $dish['photo']
        );
      } else return null;
  }
  
  function insertDish(PDO $db, string $name, int $restaurant_id, string $category, float $price, string $photo=null) {
    $count = $db->prepare('SELECT dish_id FROM Dish ORDER BY dish_id DESC LIMIT 1');
    $count->execute();
    $count = $count->fetchAll();
    $stmt = $db->prepare('INSERT INTO Dish VALUES(?, ?, ?, ?, ?, ?)');
    $stmt->execute(array($count[0]["dish_id"]+1, $name, $restaurant_id, $category, $price, $photo));
  }

    function getDishes(PDO $db, int $restaurant_id) : array{
      $stmt = $db->prepare('SELECT * from Dish where restaurant_id = ?');
      
      $stmt->execute(array($restaurant_id));
      $dishes = array();
      while ($dish = $stmt->fetch()) {
          $dishes[] = new Dish(
            (int)$dish['dish_id'],
            $dish['name'],
            (int)$dish['restaurant_id'],
            $dish['category'],
            (real)$dish['price'],
            $dish['photo']
            );
      }
      return $dishes;
  }
    static function getFavoriteDishes(PDO $db, string $username) : array {
        $stmt = $db->prepare('SELECT * FROM Dish WHERE dish_id in(SELECT dish_id FROM FavoriteDish where username = ?)
        ');
        $stmt->execute(array($username));
    
        $favorites = array();
        while ($favorite = $stmt->fetch()) {
          $favorites[] = new Dish(
            (int)$favorite['dish_id'],
            $favorite['name'],
            (int)$favorite['restaurant_id'],
            $favorite['category'],
            (real)$favorite['price'],
            $favorite['photo']
          );
        }
        return $favorites;
  
      }
    function isDishFavorite(PDO $db, string $username, int $dish_id) {
        $stmt = $db->prepare('SELECT * FROM FavoriteDish WHERE username = ? AND dish_id = ?');
        $stmt->execute(array($username, $dish_id));
        if($stmt->fetch()){
          return true;
        } else return false;
      }

      function updateDishName(PDO $db, string $dish_id, string $name){
        $stmt = $db->prepare('UPDATE User SET name = ? WHERE dish_id = ?');
        $stmt->execute(array($name, $dish_id));
      }
    
      function updateDishCategory(PDO $db, string $dish_id, string $category){
        $stmt = $db->prepare('UPDATE User SET category = ? WHERE dish_id = ?');
        $stmt->execute(array($category, $dish_id));
      }
    
      function updateDishPrice(PDO $db, string $dish_id, string $price){
        $stmt = $db->prepare('UPDATE User SET price = ? WHERE dish_id = ?');
        $stmt->execute(array($price, $dish_id));
      }
    
}
?>