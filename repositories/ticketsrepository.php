<?php

require_once __DIR__ . '/repository.php';
require __DIR__ . '/../models/event.php';

class TicketsRepository extends Repository
{
    function getAll()
    {
        try {
            $historic_events = [];
            $dance_events = [];
            $restaurant_events = [];

            $stmt = $this->connection->prepare("SELECT event.*, dance_event.title, dance_event.body, ven.venue_address as `location`, dance_event.dance_session AS extra, 'dance' AS category FROM event_session AS event 
            INNER JOIN event_session_dance as dance ON event.event_session_id = dance.event_session_id
            INNER JOIN dance_event ON dance.dance_event_id = dance_event.dance_event_id 
            INNER JOIN venue as ven ON dance_event.venue_id = ven.venue_id
            WHERE event.amount_available > 0");
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Event');
            $dance_events = $stmt->fetchAll();

            $stmt = $this->connection->prepare("SELECT event.*, historic_event.title, historic_event.body, historic_event.location, guide.guide_language AS extra,'historic' AS category FROM event_session AS event 
            INNER JOIN event_session_historic as historic ON event.event_session_id = historic.event_session_id
            INNER JOIN historic_event ON historic.historic_event_id = historic_event.historic_event_id
            INNER JOIN guide ON guide.historic_event_id = historic.historic_event_id WHERE event.amount_available > 0");
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Event');
            $historic_events = $stmt->fetchAll();

            $stmt = $this->connection->prepare("SELECT event.*, restaurant.title, restaurant.body, restaurant.location, restaurant.cuisine_info as extra, 'food' AS category FROM event_session AS event 
            INNER JOIN event_session_restaurant as resto ON event.event_session_id = resto.event_session_id
            INNER JOIN restaurant ON resto.restaurant_id = restaurant.restaurant_id WHERE event.amount_available > 0");
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Event');
            $restaurant_events = $stmt->fetchAll();

            $events = array_merge($dance_events, $historic_events, $restaurant_events);
            return $events;
        } catch (PDOException $e) {
            echo $e;
        }
    }
    function getCart($arr)
    {

        $dance = [];
        $historic = [];
        $food = [];

        foreach ($arr as $event) {
            if ($event->category === 'dance') {
                array_push($dance, $event->event_id);
            }
            if ($event->category === 'historic') {
                array_push($historic, $event->event_id);
            }
            if ($event->category === 'food') {
                array_push($food, $event->event_id);
            }
        }
        try {
            $historic_events = [];
            $dance_events = [];
            $restaurant_events = [];
            if (count($dance) > 0) {
                $stmt = $this->connection->prepare("SELECT event.*, dance_event.title, dance_event.body, ven.venue_address as `location`, dance_event.dance_session AS extra, 'dance' AS category FROM event_session AS event 
                INNER JOIN event_session_dance as dance ON event.event_session_id = dance.event_session_id
                INNER JOIN dance_event ON dance.dance_event_id = dance_event.dance_event_id
                INNER JOIN venue as ven ON ven.venue_id = dance_event.venue_id
                WHERE event.amount_available > 0 
                AND FIND_IN_SET(event.event_session_id, :placeholdersDance)");
                $stmt->execute(array(":placeholdersDance" => implode(',', $dance)));
                $stmt->setFetchMode(PDO::FETCH_CLASS, 'Event');
                $dance_events = $stmt->fetchAll();
            }
            if (count($historic) > 0) {
                $stmt = $this->connection->prepare("SELECT event.*, historic_event.title, historic_event.body, historic_event.location, guide.guide_language AS extra,'historic' AS category FROM event_session AS event 
                INNER JOIN event_session_historic as historic ON event.event_session_id = historic.event_session_id
                INNER JOIN historic_event ON historic.historic_event_id = historic_event.historic_event_id
                INNER JOIN guide ON guide.historic_event_id = historic.historic_event_id 
                WHERE event.amount_available > 0 
                AND FIND_IN_SET(event.event_session_id, :placeholdersHistoric)");
                $stmt->execute(array(":placeholdersHistoric" => implode(',', $historic)));
                $stmt->setFetchMode(PDO::FETCH_CLASS, 'Event');
                $historic_events = $stmt->fetchAll();
            }
            if (count($food) > 0) {
                $stmt = $this->connection->prepare("SELECT event.*, restaurant.title, restaurant.body, restaurant.location, restaurant.cuisine as extra, 'food' AS category FROM event_session AS event 
                INNER JOIN event_session_restaurant as resto ON event.event_session_id = resto.event_session_id
                INNER JOIN restaurant ON resto.restaurant_id = restaurant.restaurant_id 
                WHERE event.amount_available > 0 
                AND FIND_IN_SET(event.event_session_id, :placeholdersFood)");
                $stmt->execute(array(":placeholdersFood" => implode(',', $food)));
                $stmt->setFetchMode(PDO::FETCH_CLASS, 'Event');
                $restaurant_events = $stmt->fetchAll();
            }
            $events = array_merge($dance_events, $historic_events, $restaurant_events);
            return $events;
        } catch (PDOException $e) {
            echo $e;
        }
    }
    function checkTickets($arr)
    {
        $id = $arr->event;
        $amount = $arr->amount;

        try {
            $stmt = $this->connection->prepare("SELECT event.amount_available FROM event_session AS event WHERE event.amount_available > :amount AND event.event_session_id = :id");
            $stmt->execute(array(':amount' => $amount, ':id' => $id));
            if ($stmt->rowCount() > 0) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo $e;
        }
    }
    function getEvent($event_id)
    {
        try {
            $historic_event = [];
            $dance_event = [];
            $restaurant_event = [];

            $stmt = $this->connection->prepare("SELECT event.*, dance_event.title, dance_event.body, ven.venue_address as `location`, dance_event.dance_session AS extra, 'dance' AS category FROM event_session AS event 
            INNER JOIN event_session_dance as dance ON event.event_session_id = dance.event_session_id
            INNER JOIN dance_event ON dance.dance_event_id = dance_event.dance_event_id
            INNER JOIN venue as ven ON ven.venue_id = dance_event.venue_id
            WHERE event.event_session_id = :event_id");
            $stmt->execute(array(':event_id' => $event_id));
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Event');
            $dance_event = $stmt->fetchAll();

            $stmt = $this->connection->prepare("SELECT event.*, historic_event.title, historic_event.body, historic_event.location, guide.guide_language AS extra,'historic' AS category FROM event_session AS event 
            INNER JOIN event_session_historic as historic ON event.event_session_id = historic.event_session_id
            INNER JOIN historic_event ON historic.historic_event_id = historic_event.historic_event_id
            INNER JOIN guide ON guide.historic_event_id = historic.historic_event_id WHERE event.event_session_id = :event_id");
            $stmt->execute(array(':event_id' => $event_id));
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Event');
            $historic_event = $stmt->fetchAll();

            $stmt = $this->connection->prepare("SELECT event.*, restaurant.title, restaurant.body, restaurant.location, 'restaurant.cuisine_info' as extra, 'food' AS category FROM event_session AS event 
            INNER JOIN event_session_restaurant as resto ON event.event_session_id = resto.event_session_id
            INNER JOIN restaurant ON resto.restaurant_id = restaurant.restaurant_id WHERE event.event_session_id = :event_id");
            $stmt->execute(array(':event_id' => $event_id));
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Event');
            $restaurant_event = $stmt->fetchAll();

            $event = array_merge($dance_event, $historic_event, $restaurant_event);
            return $event;
        } catch (PDOException $e) {
            echo $e;
        }
    }
    function updateAmountAvailable($tickets)
    {
        try {
            $stmt = $this->connection->prepare("UPDATE `event_session` as eve SET eve.amount_available = eve.amount_available + :persons 
            WHERE eve.event_session_id = :id");

            foreach ($tickets as $ticket) {
                $stmt->execute(array(':persons' => $ticket['persons'], ':id' => $ticket['event_session_id']));
            }
            return;
        } catch (PDOException $e) {
            echo $e;
        }
    }
}
