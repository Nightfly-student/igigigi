<?php

require_once __DIR__ . '/repository.php';
require __DIR__ . '/../models/restaurant.php';
require __DIR__ . '/../models/restaurantpage.php';
require __DIR__ . '/../models/adminsession.php';
require __DIR__ . '/../models/adminrestaurant.php';


class RestaurantRepository extends Repository
{
    // gets all restaurants and the food event page
    function getAll()
    {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM restaurant, `page` WHERE page_title = 'Food Event' ");
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Restaurant');
            $restaurants = $stmt->fetchAll();

            return $restaurants;
        } catch (PDOException $e) {
            echo $e;
        }
    }
    
    // gets food page data //
    function getPage()
    {
        try {
            //all sessions from the selected restaurant //
            $sql = ("SELECT * FROM `page` WHERE page_title = 'Food Event'");
            $stmt = $this->connection->prepare($sql);
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Restaurant');
            $page = $stmt->fetchAll();

            return $page;
            
        } catch (PDOException $e) {
            echo $e;
        }
    }

    // gets restaurant data and sessions from that restaurant //
    function getRestaurant($restaurant_id)
    {
        try {
            $sql = ("SELECT restaurant.*, event.event_session_id, event.date_time, event.amount_available, 'food' AS category FROM event_session AS event  
            INNER JOIN event_session_restaurant as resto ON event.event_session_id = resto.event_session_id
            INNER JOIN restaurant ON resto.restaurant_id = restaurant.restaurant_id WHERE event.amount_available > 0 AND restaurant.restaurant_id = :restaurant_id");
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(':restaurant_id', $restaurant_id, PDO::PARAM_INT);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Restaurantpage');
            $restaurant_sessions = $stmt->fetchAll();

            return $restaurant_sessions;
            
        } catch (PDOException $e) {
            echo $e;
        }
    }

    // gets all sessions from the food event //
    function getSessions()
    {
        try {
            $sql = ("SELECT restaurant.*, event.* FROM event_session AS `event`  
            INNER JOIN event_session_restaurant as resto ON event.event_session_id = resto.event_session_id
            INNER JOIN restaurant ON resto.restaurant_id = restaurant.restaurant_id WHERE event.amount_available > 0");
            $stmt = $this->connection->prepare($sql);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Adminsession');
            $restaurant_sessions = $stmt->fetchAll();

            return $restaurant_sessions;
            
        } catch (PDOException $e) {
            echo $e;
        }
    }

    // creates new session //
    function createSessions($event_session_id, $duration, $date_time, $amount_available, $img_link, $price)
    {
        try {
            $sql = ("INSERT INTO `event_session`(`event_session_id`, `duration`, `date_time`, `amount_available`, `img_link`, `price`) VALUES (':event_session_id',':duration',':date_time',':amount_available',':img_link',':price')");
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(':event_session_id', $event_session_id, PDO::PARAM_INT);
            $stmt->bindParam(':duration', $duration, PDO::PARAM_STR);
            $stmt->bindParam(':date_time', $date_time, PDO::PARAM_STR);
            $stmt->bindParam(':amount_available', $amount_available, PDO::PARAM_STR);
            $stmt->bindParam(':img_link', $img_link, PDO::PARAM_STR);
            $stmt->bindParam(':price', $price, PDO::PARAM_STR);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Restaurantpage');
            $event_session = $stmt->fetchAll();

            return $event_session;
        } catch (PDOException $e) {
            echo $e;
        }
    }

    // edits existing session //
    function editSessions($event_session_id, $duration, $date_time, $amount_available, $img_link, $price)
    {
        try {
            $sql = ("UPDATE event_session SET `event_session_id`=':event_session_id',`duration`=':duration',`date_time`=':date_time',`amount_available`=':amount_available',`img_link`=':img_link',`price`=':price' WHERE event_session_id = :event_session_id");
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(':event_session_id', $event_session_id, PDO::PARAM_INT);
            $stmt->bindParam(':duration', $duration, PDO::PARAM_STR);
            $stmt->bindParam(':date_time', $date_time, PDO::PARAM_STR);
            $stmt->bindParam(':amount_available', $amount_available, PDO::PARAM_STR);
            $stmt->bindParam(':img_link', $img_link, PDO::PARAM_STR);
            $stmt->bindParam(':price', $price, PDO::PARAM_STR);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Restaurantpage');
            $event_session = $stmt->fetchAll();

            return $event_session;
        } catch (PDOException $e) {
            echo $e;
        }
    }

    // removes session //
    function removeSessions($event_session_id)
    {
        try {
            $sql = ("DELETE FROM event_session WHERE event_session_id = :event_session_id");
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(':event_session_id', $event_session_id, PDO::PARAM_INT);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Restaurantpage');
            $event_session = $stmt->fetchAll();

            return $event_session;
        } catch (PDOException $e) {
            echo $e;
        }
    }
    
    //removes reservation from database//
    function removeReservation($ticket_id)
    {
        try {
            $sql = ("DELETE FROM ticket WHERE ticket_id = :ticket_id");
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(':ticket_id', $ticket_id, PDO::PARAM_STR);
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Restaurant');
            $restaurants = $stmt->fetchAll();

            return $restaurants;
            
        } catch (PDOException $e) {
            echo $e;
        }
    }


    //Anel get all restaurants, (Only restaurants).
    function getAllRestaurants()
    {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM restaurant");
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, 'AdminRestaurant');
            $restaurants = $stmt->fetchAll();

            return $restaurants;
        } catch (PDOException $e) {
            echo $e;
        }
    }

    public function createRestaurant($restaurant)
    {
        try {
            $stmt = $this->connection->prepare(
                "INSERT INTO restaurant (location, title, body, img_link, openingtime, cuisine, accessibility) 
                VALUES (:location, :title, :body, :img_link, :openingtime, :cuisine, :accessibility)"
            );
            $stmt->execute([
                ':location' => $restaurant->getLocation(), ':title' => $restaurant->getTitle(),
                ':body' => $restaurant->getBody(), ':img_link' => $restaurant->getImgLink(),
                ':openingtime' => $restaurant->getOpeningtime(), ':cuisine' => $restaurant->getCuisine(),
                ':accessibility' => $restaurant->getAccessibility()
            ]);

            return json_encode(['passed' => true, 'message' => 'Restaurant was created']);
        } catch (PDOException $e) {
            return json_encode(['passed' => false, 'message' => 'Something went wrong the restaurant could not be created.']);
        }
    }

    public function updateRestaurant($restaurant)
    {
        try {
            $stmt = $this->connection->prepare("UPDATE restaurant SET location = :location, 
            title = :title, body = :body, img_link = :img_link, openingtime = :openingtime, cuisine = :cuisine, accessibility = :accessibility 
                WHERE restaurant_id = :restaurantId");

            $stmt->execute([':restaurantId' => $restaurant->getId(), ':location' => $restaurant->getLocation(), ':title' => $restaurant->getTitle(),
                ':body' => $restaurant->getBody(), ':img_link' => $restaurant->getImgLink(),
                ':openingtime' => $restaurant->getOpeningtime(), ':cuisine' => $restaurant->getCuisine(),
                ':accessibility' => $restaurant->getAccessibility()]);

            return json_encode(['passed' => true, 'message' => 'Restaurant was updated!']);

        } catch (PDOException $e) {
            return json_encode(['passed' => false, 'message' => 'Something went wrong the restaurant could not be updated. Try again']);
        }
    }

    public function deleteRestaurant($id)
    {
        try {
            $stmt = $this->connection->prepare("DELETE FROM restaurant WHERE restaurant_id = :id");
            $stmt->execute([':id' => $id]);

            return 'Restaurant is being deleted..';
        } catch (PDOException $e) {
            return 'Restaurant could not be deleted.';
        }
    }

    public function checkIfRestaurantExists($id){
        $restaurant = $this->getRestaurantById($id);
        if($restaurant != null){
            return true;
        }else{
            return false;
        }
    }

    public function getRestaurantById($id)
    {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM restaurant WHERE restaurant_id = :id");
            $stmt->execute([':id' => $id]);
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Restaurant');

            if($stmt->rowCount() > 0){
                $restaurant = $stmt->fetchObject();
            }else{
                $restaurant = null;
            }
            return $restaurant;

        } catch (PDOException $e) {
            return 'Restaurant could not be loaded.';
        }
    }
}
