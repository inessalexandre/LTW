<?php 
  declare(strict_types = 1); 

  require_once(__DIR__ . '/../utils/session.php');
?>

<?php function drawCart($session, Restaurant $restaurant) { ?>

    <div class="center">
        <img src="../img/personWithBag.png" width="70" alt="personWithBag" id="personWithBag">
    </div>
    <?php if ($session->isLoggedIn()) {?>
      <section class="shoppingCart">
        <table>
          <thead>
            <tr>
              <th>Dish</th><th>Quantity</th><th>Price</th><th>Total</th><th></th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <td id="total" colspan="3">Total:</td><td>0</td><td></td>
            </tr>
          </tfoot>
        </table>
      <button id="buyButton">Finish purchase</button>
      </section>

    <?php } else {?>
      <h2>Log in to make your purchase!</h2>
    <?php } ?>

<?php } ?>

<?php function drawReview($session, Restaurant $restaurant) { ?>
  <?php if ($session->isLoggedIn()) {
    $session->setRestaurant($restaurant->restaurant_id);
    ?>
    
    <form action="../actions/addReview_action.php" method="post">
    <textarea name="text" id="text" rows="8" cols="100" placeholder="Make your review">
  </textarea>
  <input class="score" name="score" id="score" type="number" value="1">
  <button id="makeReview">Submit</button>
  </form>
    <?php } else {?>
      <h2>Log in to make your purchase!</h2>
    <?php } ?>
<?php } ?>

<?php function drawFavorite($session, $favorites, $dishes) { ?>
  <div class="center"><h1>Your favorites <i style="font-size:26px" class="fa fa-heart"></i></h1></div>
  
  <?php if ($session->isLoggedIn()) {?>
    <h2>Restaurants</h2>
    <table>
        <tbody>
          <?php foreach($favorites as $fav) { ?>
            <tr>
              <td><?=$fav->name?></td><td><i style="font-size:1em" class="fa">&#xf014;</i></td>
            </tr>
          <?php } ?>  
        </tbody>

    </table>
    <h2>Dishes</h2>
    <table>
      <tbody>
        <?php foreach($dishes as $dish) { ?>
          <tr>
            <td><?=$dish->name?></td><td><?=$dish->restaurant_id?></td><td><i style="font-size:1em" class="fa">&#xf014;</i></td>
          </tr>
        <?php } ?>   
      </tbody>

    </table>

  <?php } else {?>
    <h2>Log in to select your favorites!</h2>
  <?php } ?>


<?php } ?>

<?php function drawProfileEdit($session) { ?>
    <?php if ($session->isLoggedIn()) {?>
    <form action="../actions/editProfile_action.php" method="post">
    
    <a href="../pages/index.php">
            <img src="../img/otherlogo.png" width="215" id="logoSignin" alt="logo">
        </a>
        <h3>Change your Profile</h3>

        <label for="name">Name - <?=$session->getName()?> </label>
        <input type="text" name="name" placeholder="New name" id="name">

        <label for="password">Password</label>
        <input type="password" name="password" placeholder="New password" id="password" pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{8,25}$" title="Must contain at least 1 number, 1 uppercase and lowercase letters, 1 special character and between 8 or 25 characters" autocomplete="off" autocorrect="off" autocapitalize="off">

        <label for="address">Address - <?=$session->getAddress()?> </label>
        <input type="text" name="address" placeholder="New address" id="address" >

        <label for="phone">Phone Number - <?=$session->getPhone()?> </label>
        <input type="tel" name="phone" placeholder="New phone number" id="phone" pattern="^[0-9]+$" size="9" title="Must only contain numbers">

        <button type="submit">Change</button>
        <a>Just fill in what you want to change!</a>
  </form>

  <?php } else {
       header('Location: ../pages/signin.php');
    }?>

<?php } ?>
