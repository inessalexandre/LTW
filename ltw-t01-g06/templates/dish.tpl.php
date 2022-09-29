<?php 
  declare(strict_types = 1); 

  require_once(__DIR__ . '/../utils/session.php');
?>

<?php function drawDishEdit($session, Dish $dish) { ?>
    <?php if ($session->isLoggedIn()) {?>
    <form action="../actions/editDish_action.php" method="post">
    
    <a href="../pages/index.php">
            <img src="../img/otherlogo.png" width="215" id="logoSignin" alt="logo">
        </a>
        <h3>Edit the Dish</h3>

        <label for="name">Name - <?=$dish->name?> </label>
        <input type="text" name="name" placeholder="New name" id="name">

        <label for="category">Category- <?=$dish->category?> </label>
        <input type="text" name="category" placeholder="New category" id="category" pattern="^\s*([a-zA-ZÀ-ÿ][a-zA-Z\s\-À-ÿ]*)$" title="Must only contain letters and spaces">

        <label for="price">Price - <?=$dish->price?> </label>
        <input type="text" name="price" placeholder="New Price" id="price" >

        <button type="submit">Change</button>
        <a>Just fill in what you want to change!</a>
  </form>

  <?php } else {
       header('Location: ../pages/dish.php');
    }?>

<?php } ?>


<?php function drawAddDishForm($session, $restaurant_id) { ?>
   <?php if ($session->isLoggedIn()) {?>

    <form action="../actions/addDish_action.php" method="post">
        
        <a href="../pages/index.php">
            <img src="../img/otherlogo.png" width="215" id="logoSignin" alt="logo">
        </a>
        <h3>Add a Dish</h3>
        
        <input type="text" name="name" placeholder="First and last name" id="name" title="Must only contain letters, spaces" autocomplete="off" autocorrect="off" autocapitalize="off" required>

        <input type="text" name="price" placeholder="Price" id="price" autocomplete="off" autocorrect="off" autocapitalize="off" required>

        <input type="text" name="category" placeholder="Category" id="category" pattern="^\s*([a-zA-ZÀ-ÿ][a-zA-Z\s\-À-ÿ]*)$" title="Must only contain letters, spaces"autocomplete="off" autocorrect="off" autocapitalize="off" required>

        <input type="file" name="photo" accept="image/png,image/jpeg" multiple>

        <button type="submit">Submit</button>

    </form>
    <?php } else {
       header('Location: ../pages/signin.php');
    }?>
<?php } ?>