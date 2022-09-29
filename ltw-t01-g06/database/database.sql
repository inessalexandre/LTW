PRAGMA foreign_keys = ON;

DROP TABLE IF EXISTS Reply;
DROP TABLE IF EXISTS CommentRestaurant;
DROP TABLE IF EXISTS FavoriteRestaurant;
DROP TABLE IF EXISTS FavoriteDish;
DROP TABLE IF EXISTS Lunchbox;
DROP TABLE IF EXISTS Dish;
DROP TABLE IF EXISTS RestaurantOwner;
DROP TABLE IF EXISTS Restaurant;
DROP TABLE IF EXISTS Type;
DROP TABLE IF EXISTS User;


CREATE TABLE User (
  username VARCHAR PRIMARY KEY,
  name VARCHAR,
  address VARCHAR NOT NULL DEFAULT 'unknown',
  phone VARCHAR NOT NULL,
  owner VARCHAR CONSTRAINT check_if_owner CHECK (owner=='No' OR owner=='Yes'),
  password VARCHAR NOT NULL,
  photo VARCHAR
);

CREATE TABLE Type (
    category VARCHAR PRIMARY KEY
);

CREATE TABLE Restaurant (
    restaurant_id INTEGER PRIMARY KEY,
    name VARCHAR NOT NULL,
    address VARCHAR NOT NULL DEFAULT 'unknown',
    category VARCHAR REFERENCES Type ON DELETE CASCADE ON UPDATE CASCADE,
    score REAL,
    photo VARCHAR
);
CREATE TABLE RestaurantOwner (
    username REFERENCES User ON DELETE CASCADE ON UPDATE CASCADE,
    restaurant_id REFERENCES Restaurant ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE Dish(
    dish_id INTEGER PRIMARY KEY,
    name VARCHAR NOT NULL,
    restaurant_id INTEGER REFERENCES Restaurant ON DELETE CASCADE ON UPDATE CASCADE,
    category VARCHAR REFERENCES Type ON DELETE CASCADE ON UPDATE CASCADE,
    price REAL,
    photo VARCHAR
);
CREATE TABLE Lunchbox ( --order
  quantity INTEGER,
  dish_id INTEGER REFERENCES Dish,
  state VARCHAR NOT NULL
);
CREATE TABLE FavoriteDish (
    username VARCHAR REFERENCES User ON DELETE CASCADE ON UPDATE CASCADE,
    dish_id REFERENCES Dish ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE FavoriteRestaurant (
    username VARCHAR REFERENCES User ON DELETE CASCADE ON UPDATE CASCADE,
    restaurant_id INTEGER REFERENCES Restaurant ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE CommentRestaurant (
  id_comment INTEGER PRIMARY KEY,            -- comment id
  restaurant_id INTEGER REFERENCES restaurant,   
  username VARCHAR REFERENCES User, -- User that wrote the comment
  score REAL,                
  comment VARCHAR                       -- comment text
);

CREATE TABLE Reply (
  id INTEGER PRIMARY KEY,            -- comment id
  id_comment INTEGER REFERENCES CommentRestaurant,   
  username VARCHAR REFERENCES User, -- User that wrote the comment
  published INTEGER,                 
  text VARCHAR                       -- comment text
);

INSERT INTO User VALUES ('bruna.blm', 'Bruna Marques', 'Rua x', '914833536', 'No','abcde', 'defaultPhoto.png');
INSERT INTO User VALUES ('iness', 'Ines Oliveira', 'Rua y', '914833535', 'No','12345', '');
INSERT INTO User VALUES ('malva', 'João Malva', 'Rua z', '914833534', 'Yes', '12345', '');

INSERT INTO Type VALUES ('chicken');
INSERT INTO Type VALUES ('meat');
INSERT INTO Type VALUES ('hamburger');
INSERT INTO Type VALUES ('sushi');
INSERT INTO Type VALUES ('fish');
INSERT INTO Type VALUES ('arroz');
INSERT INTO Type VALUES ('feijão');
INSERT INTO Type VALUES ('caril');
INSERT INTO Type VALUES ('italian');
INSERT INTO Type VALUES ('brazilian');
INSERT INTO Type VALUES ('sobremesa');
INSERT INTO Type VALUES ('pizza');
INSERT INTO Type VALUES ('mexican');
INSERT INTO Type VALUES ('fast food');
INSERT INTO Type VALUES ('portuguese');
INSERT INTO Type VALUES ('french');

INSERT INTO Restaurant VALUES (1, 'Mc Donalds', 'Rua a', 'fast food', 3,'McDonalds.jpg');
INSERT INTO Restaurant VALUES (2, 'Oishii', 'Rua b', 'sushi', 3.5,'oishii.jpg');
INSERT INTO Restaurant VALUES (3, 'Taco Bell', 'Rua c', 'mexican', 4,'tacobell.png');
INSERT INTO Restaurant VALUES (4, 'Sabor gaucho', 'Rua d', 'brazilian', 4.5,'Saborgaucho.jpg');
INSERT INTO Restaurant VALUES (5, 'Telepizza', 'Rua c', 'pizza', 4,'Telepizza.jpg');
INSERT INTO Restaurant VALUES (6, 'Churrasqueira', 'Rua c', 'portuguese', 4,'Churrasqueira do Amial.jpeg');
INSERT INTO Restaurant VALUES (7, 'Taskinha', 'Rua c', 'portuguese', 4,'tacobell.png');
INSERT INTO Restaurant VALUES (8, 'Casa Guedes', 'Rua c', 'portuguese', 4,'casa-guedes.jpg');
INSERT INTO Restaurant VALUES (9, 'KFC', 'Rua c', 'fast food', 4,'kfc.jpg');
INSERT INTO Restaurant VALUES (10, 'Restaurant', 'Rua c', 'mexican', 4,'tacobell.png');


INSERT INTO RestaurantOwner VALUES ('malva', 1);
INSERT INTO RestaurantOwner VALUES ('malva', 4);

INSERT INTO Dish VALUES (1,'Cheeseburger', 1, 'fast food', 4, 'CheeseBurger.jpeg');
INSERT INTO Dish VALUES (2,'Burrito', 3, 'mexican', 4, 'Burrito.jpg');
INSERT INTO Dish VALUES (3,'Pizza', 5, 'pizza', 3, 'pepperoni-pizza.jpg');

INSERT INTO FavoriteRestaurant VALUES ('iness', 2);
INSERT INTO FavoriteRestaurant VALUES ('bruna.blm', 2);
INSERT INTO FavoriteRestaurant VALUES ('bruna.blm', 3);

INSERT INTO FavoriteDish VALUES ('bruna.blm', 1);
INSERT INTO FavoriteDish VALUES ('bruna.blm', 2);

INSERT INTO CommentRestaurant VALUES (1, 2, 'iness', 2.0, 'Very good!');

