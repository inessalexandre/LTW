<?php 
  declare(strict_types = 1); 
?>

<?php function drawRestaurants($session, array $restaurants, array $sorted_restaurants) { ?>
    <?php 

  require_once(__DIR__ . '/../database/connection.db.php');
  $db = getDatabaseConnection();

    ?>
    <section id="restaurants">
        <div class="row">
            <?php foreach($restaurants as $restaurant) {?>
                <div class="column">
                    <a href="../pages/restaurant.php?restaurant_id=<?=$restaurant->restaurant_id?>">
                        <div class="restaurantCard">
                            <img src="../img/restaurantImgs/<?=$restaurant->photo?>" alt="restaurant" width="100">
                            <div class="container">
                                <h3><?=$restaurant->name?></h3>
                                <p id="score"><?=$restaurant->score?><span class="fa fa-star checked"></span></p>
                                <p><?=$restaurant->category?></p>
                                <?php if($session->isLoggedIn()) {?>
                                    <?php if(Restaurant::isRestaurantFavorite($db, $session->getUsername(), $restaurant->restaurant_id)) {?>    
                                        <form action="../actions/removeFavoriteRestaurant_action.php" method="post">
                                            <label class="question-favorite"><i class="fa fa-heart"></i>
                                                <input type='checkbox' name="restaurant_id" value='<?=$restaurant->restaurant_id?>' onclick='this.form.submit();'>
                                            </label>
                                        </form>
                                        
                                    <?php } else {?>
                                        <form action="../actions/favoriteRestaurant_action.php" method="post">
                                            <label class="question-favorite"><i class="far fa-heart"></i>
                                                <input type='checkbox' name="restaurant_id" value='<?=$restaurant->restaurant_id?>' onclick='this.form.submit();'>
                                            </label>
                                        </form>
                                        
                                    <?php }?>
                                <?php }?>
                            </div>
                            
                        </div>
                    </a>
                </div>
            <?php }?>
        </div>
    </section>
    <h1>Top 5 - Best reviews</h1>
    <section>
        <div class="top5Row">
            <?php foreach(array_slice($sorted_restaurants, 0, 5) as $restaurant) {?>
                <div class="column">
                    <a href="../pages/restaurant.php?restaurant_id=<?=$restaurant->restaurant_id?>">
                        <div class="restaurantCard">
                            <img src="../img/restaurantImgs/<?=$restaurant->photo?>" alt="restaurant" width="100">
                            <div class="container">
                                <h3><?=$restaurant->name?></h3>
                                <p id="score"><?=$restaurant->score?><span class="fa fa-star checked"></span></p>
                                <p><?=$restaurant->category?></p>
                            </div>
                            
                        </div>
                    </a>      
                </div>
            <?php }?>
        </div>
    </section>
<?php } ?>

<?php function drawARestaurant($session, Restaurant $restaurant, array $dishes) { ?>
    <?php 

    require_once(__DIR__ . '/../database/connection.db.php');
    $db = getDatabaseConnection();

    ?>
    <h1 restaurant-id="<?=$restaurant->restaurant_id?>" id="nameRestaurant"><?=$restaurant->name?></h1>
    <section id="dishes">
        <?php foreach($dishes as $dish) { ?>
            <article data-id="<?=$dish->dish_id?>">
                <img src="../img/foodImgs/<?=$dish->photo?>" alt="dish" width="100">
                <h3><?=$dish->name?></h3>
                
                <p class="price"><?=$dish->price?></p>

                <?php if($session->isLoggedIn()) {?>
                    <?php if(Dish::isDishFavorite($db, $session->getUsername(), $dish->dish_id)) {?>    
                        <form class="formFavoriteDish" action="../actions/removeFavoriteDish_action.php" method="post">
                            <label class="question-favoriteDish"><i class="fa fa-heart"></i>
                                <input type='checkbox' name="dish_id" value='<?=$dish->dish_id?>' onclick='this.form.submit();'>
                            </label>
                        </form>
                                        
                    <?php } else {?>
                        <form class="formFavoriteDish" action="../actions/favoriteDish_action.php" method="post">
                            <label class="question-favoriteDish"><i class="far fa-heart"></i>
                                <input type='checkbox' name="dish_id" value='<?=$dish->dish_id?>' onclick='this.form.submit();'>
                            </label>
                        </form>
                                        
                    <?php }?>
                <?php }?>

                <input class="quantity" type="number" value="1">
                <button class="buy">Buy</button>

            </article>
        <?php } ?> 
    </section>
    <?php if((Restaurant::isRestaurantOwner($db, $session->getUsername(), $restaurant->restaurant_id))) {

        ?>
        <div>
            <a href="../pages/editRestaurant.php?restaurant_id=<?=$restaurant->restaurant_id?>" class="click">Edit restaurant</a>
            <a href="../pages/addDish.php?restaurant_id=<?=$restaurant->restaurant_id?>" class="click">Add dish</a>
        </div>
    <?php } ?>
<?php } ?>

<?php function drawAddRestaurantForm($session) { ?>
    <?php if ($session->isLoggedIn()) {?>

    <form action="../actions/addRestaurant_action.php" method="post">
        
        <a href="../pages/index.php">
            <img src="../img/otherlogo.png" width="215" id="logoSignin" alt="logo">
        </a>
        <h3>Add your restaurant</h3>
        
        <input type="text" name="name" placeholder="First and last name" id="name" title="Must only contain letters, spaces" autocomplete="off" autocorrect="off" autocapitalize="off" required>

        <input type="text" name="address" placeholder="Address" id="address" autocomplete="off" autocorrect="off" autocapitalize="off" required>

        <input type="text" name="category" placeholder="Category" id="category" pattern="^\s*([a-zA-ZÀ-ÿ][a-zA-Z\s\-À-ÿ]*)$" title="Must only contain letters, spaces"autocomplete="off" autocorrect="off" autocapitalize="off" required>

        <input type="file" name="photo" accept="image/png,image/jpeg" multiple>

        <button type="submit">Submit</button>

    </form>
    <?php } else {
       header('Location: ../pages/signin.php');
    }?>
<?php } ?>

<?php function drawRestaurantsOfOwner(array $restaurants) { ?>
    <h1>Your Restaurants</h1>
    <section>
        <div id="restaurantsOwner">
            <?php foreach($restaurants as $restaurant) {?>
                <div class="column">
                    <a href="../pages/restaurant.php?restaurant_id=<?=$restaurant->restaurant_id?>">
                        <div class="restaurantCard">
                            <img src="../img/restaurantImgs/<?=$restaurant->photo?>" alt="restaurant" width="100">
                            <div class="container">
                                <h3><?=$restaurant->name?></h3>
                                <p id="score"><?=$restaurant->score?><span class="fa fa-star checked"></span></p>
                                <p><?=$restaurant->category?></p>
                            </div>
                            
                        </div>
                    </a>      
                </div>
            <?php }?>
        </div>
    </section>
<?php } ?>

<?php function drawRestaurantEdit($session, Restaurant $restaurant) { 
            $session->setRestaurant($restaurant->restaurant_id);
    ?>
    <?php if ($session->isLoggedIn()) {?>
    <form action="../actions/editRestaurant_action.php" method="post">
    
    <a href="../pages/index.php">
            <img src="../img/otherlogo.png" width="215" id="logoSignin" alt="logo">
        </a>
        <h3>Edit you Restaurant</h3>

        <label for="name">Name - <?=$restaurant->name?> </label>
        <input type="text" name="name" placeholder="New name" id="name">

        <label for="address">Address - <?=$restaurant->address?> </label>
        <input type="text" name="address" placeholder="New address" id="address" >

        <label for="category">Category- <?=$restaurant->category?> </label>
        <input type="text" name="category" placeholder="New category" id="category" pattern="^\s*([a-zA-ZÀ-ÿ][a-zA-Z\s\-À-ÿ]*)$" title="Must only contain letters and spaces">

        <button type="submit">Change</button>
        <a>Just fill in what you want to change!</a>
  </form>

  <?php } else {
       header('Location: ../pages/restaurant.php');
    }?>

<?php } ?>

<?php function drawOrders($session, Restaurant $restaurant) { ?>

<h1>Orders to your restaurant</h1>


<?php } ?>


<?php function drawComments($session, Restaurant $restaurant, array $comments) { ?>

    <h1>Comments</h1>
    <section>
        <?php foreach($comments as $comment) { ?>
            <article">
                <h3><?=$comment->username?></h3>
                
                <p><?=$comment->text?></p>

                <p><?=$comment->score?></p>

            </article>
        <?php } ?> 
    </section>
   
<?php } ?>