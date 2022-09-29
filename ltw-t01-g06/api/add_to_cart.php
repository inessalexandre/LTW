<?php 
    session_start();

    $restaurant_id = $_GET['restaurant_id'];
    $dish = $_GET["dish_id"];
    $quantity = $_GET["quantity"];

    if (isset($_SESSION["cart"][$restaurant_id][$dish])) {
        $_SESSION["cart"][$restaurant_id][$dish] += $quantity;
    } else {
        $_SESSION["cart"][$restaurant_id][$dish] = $quantity;
    }

    echo $restaurant_id;
?>