CREATE TABLE user (
user_ID INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
firstName VARCHAR(20),
lastName VARCHAR(20),
email VARCHAR(50),
phoneNumber INT(10),
password VARCHAR(20)
)

CREATE TABLE hotel (

hotel_id INT(10) PRIMARY KEY AUTO_INCREMENT,
rating FLOAT,
hotel_name VARCHAR(20),
hotel_location  VARCHAR(20) ,
phoneNum INT(10)

)

CREATE TABLE guide(

guide_id INT(10) PRIMARY KEY AUTO_INCREMENT,
guide_name VARCHAR(50),
phone_num INT(10),
languages_spoken VARCHAR(50)

)

CREATE TABLE travel_plan (
    travel_id INT(10) PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(50),
    date DATE,
   price DECIMAL(10, 2),
    duration INT(10),
    availability BOOLEAN,
   description TEXT(10000),
    guide_id INT(10),
    hotel_id INT(10),
   estination VARCHAR(1000),
    image1_url VARCHAR(1000),
    image2_url VARCHAR(1000),
    image3_url VARCHAR(1000),
    CONSTRAINT fk_guide FOREIGN KEY (guide_id) REFERENCES guide(guide_id) ON DELETE CASCADE,
    CONSTRAINT fk2_guide FOREIGN KEY (hotel_id) REFERENCES hotel(hotel_id) ON DELETE CASCADE
)

CREATE TABLE comment (
comment_id PRIMARY KEY AUTO_INCREMENT,
date DATE,
time  int(11) ,
content TEXT,
user_id INT(10),
travel_plan_id INT(10),
rating FLOAT,
CONSTRAINT fk_comment FOREIGN KEY (user_id) REFERENCES user(user_ID) ON DELETE CASCADE,
CONSTRAINT fk2_comment FOREIGN KEY (travel_plan_id) REFERENCES travel_plan(travel_id) ON DELETE CASCADE

);

CREATE TABLE review (
review_id PRIMARY KEY AUTO_INCREMENT,
review_date DATE,
review_time  int(11)  ,
review_content TEXT,
user_id INT(10),
travel_plan_id INT(10),
CONSTRAINT fk_review FOREIGN KEY (user_id) REFERENCES user(user_ID) ON DELETE CASCADE,
CONSTRAINT fk2_review FOREIGN KEY (travel_plan_id) REFERENCES travel_plan(travel_id) ON DELETE CASCADE

)

CREATE TABLE destination (
name_destination VARCHAR(50),
city VARCHAR(50),
description VARCHAR(50),
CONSTRAINT Pk_activity PRIMARY KEY(name_destination, city)

)

CREATE TABLE reservation (
user_ID INT;
travel_plan_id INT(10),
reservation_id PRIMARY KEY AUTO_INCREMENT,
reservation_date DATE,
CONSTRAINT fk_reservation FOREIGN KEY (user_ID) REFERENCES user(user_ID) ON DELETE CASCADE,
CONSTRAINT fk2_reservation FOREIGN KEY (travel_plan_id) REFERENCES travel_plan(travel_id) ON DELETE CASCADE

)

CREATE TABLE request (
user_ID INT;
requested_destination VARCHAR(50),
budget DECIMAL(10, 2),
traveldate DATE,
travel_plan_suggestion VARCHAR(50),

CONSTRAINT Pk_activity PRIMARY KEY(user_ID, requested_destination)
CONSTRAINT fk_activity FOREIGN KEY (user_ID) REFERENCES user(user_ID) ON DELETE CASCADE,
)


CREATE TABLE activity (
activity_name VARCHAR(50),
activity_date DATE,
activity_price  DECIMAL(10, 2),
travel_plan_id INT(10),
name_destination VARCHAR(50),
CONSTRAINT fk_activity FOREIGN KEY (name_destination) REFERENCES destination(name_destination) ON DELETE CASCADE,
CONSTRAINT fk2_activity FOREIGN KEY (travel_plan_id) REFERENCES travel_plan(travel_id) ON DELETE CASCADE,
CONSTRAINT Pk_activity PRIMARY KEY(activity_name, travel_plan_id)

)

CREATE TABLE payment (
payment_id PRIMARY KEY AUTO_INCREMENT,
user_ID INT;
payment_method VARCHAR(50),
payment_date DATE,
amount DECIMAL(10, 2),

CONSTRAINT fk_paymentFOREIGN KEY (user_ID) REFERENCES user(user_ID) ON DELETE CASCADE,

)

CREATE TABLE trending_plan (

travel_id INT(10) PRIMARY KEY,
number_of_booking INT (10);
price DECIMAL(10, 2),
description TEXT(10000),

CONSTRAINT fk_trending_plan FOREIGN KEY (travel_id) REFERENCES travel_plan(travel_id) ON DELETE CASCADE

)

CREATE TABLE transport (

travel_id INT(10),
type VARCHAR(50),
date_dep DATE,
date_arv DATE,

CONSTRAINT Pk_activity PRIMARY KEY(travel_id, type , date_dep),
CONSTRAINT fk_transport FOREIGN KEY (travel_id) REFERENCES travel_plan(travel_id) ON DELETE CASCADE

)

INSERT INTO `travel_plan` (`travel_id`, `name`, `date`, `price`, `duration`, `availability`, `description`, `guide_id`, `hotel`, `destination`, `image1_url`, `image2_url`, `image3_url`) VALUES (NULL, 'discover bejaiaaaaa', '2023-05-01', '2000.00', '1', '1', 'this is a descriptionnn', NULL, NULL, 'bejaiaaaa', 'https://images.unsplash.com/photo-1630838788300-bf37622a54e6?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1527&q=80', 'https://images.unsplash.com/photo-1630838788300-bf37622a54e6?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1527&q=80', 'https://images.unsplash.com/photo-1630838788300-bf37622a54e6?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1527&q=80');

INSERT INTO `travel_plan` (`travel_id`, `name`, `date`, `price`, `duration`, `availability`, `description`, `guide_id`, `hotel`, `destination`, `image1_url`, `image2_url`, `image3_url`) VALUES (NULL, 'discover bejaia', '2023-05-01', '2000.00', '1', '1', 'helloo', NULL, NULL, 'bejaia', 'https://images.unsplash.com/photo-1630838788300-bf37622a54e6?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1527&q=80', 'https://images.unsplash.com/photo-1630838788300-bf37622a54e6?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1527&q=80', 'https://images.unsplash.com/photo-1630838788300-bf37622a54e6?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1527&q=80');

INSERT INTO `travel_plan` (`travel_id`, `name`, `date`, `price`, `duration`, `availability`, `description`, `guide_id`, `hotel`, `destination`, `image1_url`, `image2_url`, `image3_url`) VALUES (NULL, 'discover bejaia', '2023-05-01', '2000.00', '1', '1', 'this is a descriptionnnnnnnnnn', NULL, NULL, 'bejaia', 'https://images.unsplash.com/photo-1630838788300-bf37622a54e6?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1527&q=80', 'https://images.unsplash.com/photo-1630838788300-bf37622a54e6?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1527&q=80', 'https://images.unsplash.com/photo-1630838788300-bf37622a54e6?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1527&q=80');



