<?php 
    session_start();

    $restaurant_id = $_GET["restaurant_id"];

    $db = new PDO('sqlite:../Database/database.db');
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    
    $response = array();
    if (isset($_SESSION["cart"][$restaurant_id])) {
        global $db;
        foreach (array_keys($_SESSION["cart"][]) as $dish_id) {
            $query1 = $db->prepare('SELECT * FROM Dish WHERE dish_id = :dish_id');
            $query1->bindParam(':dish_id', $dish_id);
            $query1->execute();

            $dishes = $query1->fetchAll();
            $response[$dish]["dish_id"] = $dish;
            $response[$dish]["name"] = $dishes[0]["name"]
           
            $response[$dish]["price"] = $dishes[0]["price"]
            $response[$dish]["quantity"] = $_SESSION["cart"][$restaurant_id][$dish];
        }
        echo json_encode($response);
    } else {
        echo json_encode($response);
    }
?>