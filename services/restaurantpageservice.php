<?php 
require __DIR__ . '/../repositories/restaurantrepository.php';

class RestaurantpageService {
    // get all sessions from selected restaurant //
    public function getRestaurant($restaurant_id) {
        $repository = new RestaurantRepository();
        return $repository->getRestaurant($restaurant_id);
    }

    // gets all food event sessions // 
    public function getSessions() {
        $repository = new RestaurantRepository();
        return $repository->getSessions();
    }

    // creates new session //
    public function createSessions($event_session_id, $duration, $date_time, $amount_available, $img_link, $price) {
        $repository = new RestaurantRepository();
        return $repository->createSessions($event_session_id, $duration, $date_time, $amount_available, $img_link, $price);
    }

    // edits existing session //
    public function editSessions($event_session_id, $duration, $date_time, $amount_available, $img_link, $price) {
        $repository = new RestaurantRepository();
        return $repository->editSessions($event_session_id, $duration, $date_time, $amount_available, $img_link, $price);
    }

    // removes session //
    public function removeSessions($event_session_id) {
        $repository = new RestaurantRepository();
        return $repository->removeSessions($event_session_id);
    }

    // removes reservation / ticket //
    public function removeReservation($ticket_id) {
        $repository = new RestaurantRepository();
        return $repository->removeReservation($ticket_id);
    }
}