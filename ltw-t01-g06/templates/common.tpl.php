<?php 
  declare(strict_types = 1); 

  require_once(__DIR__ . '/../utils/session.php');
?>

<?php function drawHeader($session, $sign=null, $sign2=null) { ?>
<!DOCTYPE html>
<html lang="en">
   <head>
        <title>LunchBox</title>
        <link rel="icon" href="../img/box.png" type="image/icon">
        <link href="../css/common.css" rel="stylesheet">
        <link href="../css/style.css" rel="stylesheet">
        <?php if ($sign) { ?>
            <link href="../css/login.css" rel="stylesheet">
        <?php } ?>
        <?php if ($sign2) { ?>
            <link href="../css/changeprofile.css" rel="stylesheet">
        <?php } ?>
        <link href="../css/user.css" rel="stylesheet">
        <link href="../css/restaurant.css" rel="stylesheet">
        <link href="../css/profile.css" rel="stylesheet">
        <script src="../javascript/search.js" defer></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://kit.fontawesome.com/yourcode.js" crossorigin="anonymous"></script>
        <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
   <body>
        <header>
            <?php drawSidebar($session, $sign) ?>
        </header>
        
<?php } ?>

<?php function drawSidebar($session, $sign = null) { ?>
    <div class="wrapper">
        <div class="sidebar">
            <div class="profile">
           
            <?php if ($session->isLoggedIn()) {?>
                    <h2>
                    <?=$session->getName()?> 
                    </h2>
            <?php } else {?>
                <a href="../pages/signin.php">Log in</a>
            <?php }?>
            </div>
            <ul>
                <li>
                    <a href="../pages/index.php">
                        <span class="item">Home</span>
                    </a>
                </li>
                <li>
                    <a href="../pages/main.php">
                        <span class="item">Restaurants</span>
                    </a>
                </li>
                <li>
                    <a href="../pages/editprofile.php">
                        <span class="item">Edit your profile</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="item">Previous orders</span>
                    </a>
                </li>
                <?php if ($session->getOwner()=="Yes") {?>
                <li>
                    <a href="../pages/restaurantOwner.php">
                        <span class="item">Your Restaurants</span>
                    </a>
                </li>
                <?php }?>
                <li>
                    <a href="../pages/addRestaurant.php">
                        <span class="item">Add your restaurant</span>
                    </a>
                </li>
            </ul>
            <?php if ($session->isLoggedIn()) {
                drawLogoutForm();
            } ?>
        </div>
            <?php if ($sign==null) { ?>
                <div class="section">
                    <div class="top_navbar">
                        <input type="checkbox" id="hamburger"> 
                        <label class="hamburger" for="hamburger"></label>
                    </div>                
                    <a href="../pages/index.php">
                        <img src=../img/simb_logo.png height="47" id="simbol-logo" alt="lunchbox">
                        <img src=../img/txt_logo.png height="47" id="txt-logo" alt="name-lunchbox" class="logo-lunchbox">
                    </a>
                    <div class='pesquisa'>
                        <div id="pesquisalupa"></div>
                        <input type="text" id="searchRestaurant" placeholder="Search"/>
                        <img src="../img/lupa.png" width="25" id="btnBusca" alt="Pesquisar"/>
                    </div>
                    <a href="../pages/profile.php" id="user"><img src=../img/person.png width="38"  alt="user">
                    <a href="../pages/cart.php"><img src=../img/bag.png width="45" id="bag" alt="shoppingbag"></a>
                    <a href="../pages/favorite.php"><img src=../img/heart2.png width="40" id="heart2" alt="heart"></a>
                </div>
            <?php } ?>    
    </div>
<?php } ?>

<?php function drawHome() { ?>
    <main>
        <div class="tag-slider">
        <div class="marquee-down" id="marquee-down-text">
            <p>Take away</p>
            <div class="intermedia">
                <div class="sliding-words-wrapper">
                    <div class="sliding-words">
                        <span>Portuguese</span>
                        <span>Fast</span>
                        <span>Mexican</span>
                        <span>Italian</span>
                        <span>French</span>
                        <span>Portuguese</span>
                    </div>
                    <span>food</span>
                </div>
            </div>
        </div>
    </div>
    <div class="comidas">
        <div>
            <img src="../img/comida1.png" width="200" id="comida1">
   
        </div>
        <div>

            <img src="../img/comida2.png" width="200" id="comida2">

        </div>
        <div>
            <img src="../img/comida3.png" width="200" id="comida3">

        </div>
        <div>

            <img src="../img/comida4.png" width="200" id="comida4">

        </div>
        <div>
            <img src="../img/comida5.png" width="200" id="comida5">

        </div>
        
        
    </div>
    </main>


<?php } ?>

<?php function drawFooter($sign = null) { ?>
    
    <?php if($sign==null) {?>
        <footer id="footer">
            <div class="aditionalInfo">
                <ul>
                    <li class="Desenvolvido">
                        <h2>Coded by</h2>
                        <p>Bruna Brasil, Inês Oliveira e João Malva</p>
                        <p></p>
                    </li>
                    <li class="VisitUs">
                        <h2>Visit us</h2>
                        <p>Rua Dr. Roberto Frias</p>
                        <p>Faculdade de Engenharia da Universidade do Porto</p>
                    </li>
                </ul>
            </div>
        </footer>
        <a href="#" class="toTop">&#8593;</a>
    <?php } ?>

    <script src="../javascript/sideBar.js" defer></script>
    <script src="../javascript/shoppingCart.js" defer></script>

    </body>
</html>
<?php } ?>

<?php function drawSigninForm($session) { ?>
    <form action="../actions/signin_action.php" method="post">
        <a href="../pages/index.php">
            <img src="../img/otherlogo.png" width="215" id="logoSignin" alt="logo">
        </a>
        <h3 id="signInTitle">Sign in</h3>

        <label for="username">Username</label>
        <input type="text" name="username" placeholder="username" id="username">

        <label for="password">Password</label>
        <input type="password" name="password" placeholder=" password" id="password">

        <button id="logInButton" type="submit">Log In</button>

        <a id="signUpLink" href="../pages/signup.php">Sign up</a>
    </form>
<?php } ?>

<?php function drawSignupForm() { ?>
    <form action="../actions/signup_action.php" method="post">
        
        <a href="../pages/index.php">
            <img src="../img/otherlogo.png" width="215" id="logoSignin" alt="logo">
        </a>
        <h3>Sign up</h3>
        <input type="text" name="username" placeholder="Username" id="username" autocomplete="off" autocorrect="off" autocapitalize="off" required>
        
        <input type="password" name="password" placeholder="Define password" id="password" pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{8,15}$" title="Must contain at least 1 number, 1 uppercase and lowercase letters, 1 special character and between 8 or 64 characters" autocomplete="off" autocorrect="off" autocapitalize="off" required>
        
        <input type="text" name="name" placeholder="First and last name" id="name" pattern="^\s*([a-zA-ZÀ-ÿ][a-zA-Z\s\-À-ÿ]*)$" title="Must only contain letters, spaces" autocomplete="off" autocorrect="off" autocapitalize="off" required>

        <input type="text" name="address" placeholder="Address" id="address" autocomplete="off" autocorrect="off" autocapitalize="off" required>

        <input type="tel" name="phone" placeholder="Phone number" id="phone" pattern="^[0-9]+$" title="Must only contain numbers" autocomplete="off" autocorrect="off" autocapitalize="off" required>
        
        <input type="text" name="photo" placeholder="Photo" id="photo" autocomplete="off" autocorrect="off" autocapitalize="off">

        <label class="question-owner">Are you a restaurant owner?
            <input type='hidden' name="owner" value='No'>
            <input type="checkbox" name="owner" value="Yes">
        </label> 
        <button type="submit">Submit</button>

        <a href="../pages/signin.php">Sign in</a>
    </form>
<?php } ?>

<?php function drawLogoutForm() { ?>
  <form action="../actions/logout_action.php" method="post" class="logout">
    <button type="submit">Log out</button>
  </form>
<?php } ?>


<?php function drawProfilePage($session) { ?>
  <section id="profile">
    <?php if ($session->isLoggedIn()) {?>

    <div class="main-body">
          <div class="row gutters-sm">
            <div class="col-md-4 mb-3">
              <div class="card">
                  <img src="../img/defaultphoto.png" alt="profilePicture" width="150">
                    <div class="mt-3">
                      <h4><?=$session->getName()?></h4>
                      <?php if ($session->getOwner()=="Yes") {?>
                        <p class="text-secondary mb-1">Restaurant owner</p>
                      <?php } else {?>
                        <p class="text-secondary mb-1">Not a restaurant owner</p>
                      <?php } ?>
                  </div>
              </div>
            </div>
            <div class="col-md-8">
              <div class="card mb-3">
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Full Name</h6>
                    </div>
                    <div class="col-sm-9 text-secondary"><?=$session->getName()?></div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3"><h6 class="mb-0">Username</h6></div>
                    <div class="col-sm-9 text-secondary"><?=$session->getUsername()?></div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3"><h6 class="mb-0">Phone</h6></div>
                    <div class="col-sm-9 text-secondary"><?=$session->getPhone()?></div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3"><h6 class="mb-0">Address</h6></div>
                    <div class="col-sm-9 text-secondary"><?=$session->getAddress()?></div>
                  </div>
                  <div class="row">
                    <div class="col-sm-12">
                        <a href="../pages/editProfile.php"  class="click">Edit </a>
                        <a href="../actions/delete_account_action.php"  class="click">Delete </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
    <?php } else {
       header('Location: ../pages/signin.php');
    }?>
  </section>

<?php } ?> 