<?php

require_once __DIR__ . '/repository.php';
require __DIR__ . '/../models/dancepage.php';
require __DIR__ . '/../models/artist.php';
require __DIR__ . '/../models/club.php';
require __DIR__ . '/../models/venue.php';
require __DIR__ . '/../models/danceprogramme.php';

class DanceRepository extends Repository
{
    function getAll()
    {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM page_item WHERE page_item_category = 1");
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Dancepage');
            $dancepage = $stmt->fetchAll();

            return $dancepage;
        } catch (PDOException $e) {
            echo $e;
        }
    }
    function getAllArtists()
    {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM artist");
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Artist');
            $artists = $stmt->fetchAll();

            return $artists;
        } catch (PDOException $e) {
            echo $e;
        }
    }
    function getAllClubs()
    {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM venue");
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Club');
            $clubs = $stmt->fetchAll();

            return $clubs;
        } catch (PDOException $e) {
            echo $e;
        }
    }
    //get venues - anel
    function getAllVenues()
    {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM venue");
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Venue');
            $venues = $stmt->fetchAll();

            return $venues;
        } catch (PDOException $e) {
            echo $e;
        }
    }
    function getDancePageInfo()
    {
        try {
            $stmt = $this->connection->prepare("SELECT page_title, page_image FROM page WHERE page_id = 2;");
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Dancepage');
            $dancepageinfo = $stmt->fetchAll();

            return $dancepageinfo;
        } catch (PDOException $e) {
            echo $e;
        }
    }

    //get venue with id - anel
    function getVenueById($id)
    {
        try {

            $stmt = $this->connection->prepare("SELECT * FROM venue WHERE venue_id = :id");
            $stmt->execute([':id' => $id]);
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Venue');
            $venue = $stmt->fetchObject();
            return $venue;
        } catch (PDOException $e) {
            echo "Venue could not be loaded. ";
        }
    }

    //delete venue - anel
    public function deleteVenue($id)
    {
        try {
            $stmt = $this->connection->prepare("DELETE FROM venue WHERE venue_id = :id");
            $stmt->execute([':id' => $id]);
            return 'The venue is being deleted..';
        } catch (PDOException $e) {
            return 'The venue can not be deleted.';
        }
    }

    //create venue - anel
    public function createVenue($venue)
    {
        try {
            $stmt = $this->connection->prepare("INSERT INTO venue (venue_name, venue_description, venue_address) VALUES (:name, :desc, :address)");
            $stmt->execute([':name' => $venue->getName(), ':desc' => $venue->getDescription(), ':address' => $venue->getAddress()]);

            return json_encode(['passed' => true, 'message' => 'Created venue: '.$venue->getName()]);
        } catch (PDOException $e) {
            return json_encode(['passed' => false, 'message' => 'Something went wrong, venue could not be created.']);
        }
    }

    //update venue - anel
    public function updateVenue($venue)
    {
        try {
            $stmt = $this->connection->prepare("UPDATE venue SET venue_name = :name, venue_address = :address, venue_description = :description WHERE venue_id = :id");
            $stmt->execute([
                ':name' => $venue->getName(),
                ':address' => $venue->getAddress(),
                ':description' => $venue->getDescription(),
                ':id' => $venue->getId()
            ]);

            return json_encode(['passed' => true, 'message' => 'Updated venue: '.$venue->getName()]);
        } catch (PDOException $e) {
            return json_encode(['passed' => false, 'message' => 'Something went wrong, venue could not be updated.']);
        }
    }

    //get artist by id - anel
    public function getArtistById($id)
    {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM artist WHERE artist_id = :id");
            $stmt->execute([':id' => $id]);
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Artist');

            $artist = $stmt->fetchObject();

            return $artist;
        } catch (PDOException $e) {
            return 'Artist could not be found.';
        }
    }

    //create artist - anel
    public function createArtist($artist)
    {
        try {
            $stmt = $this->connection->prepare("INSERT INTO artist (artist_name, artist_information, genre, artist_image) VALUES (:name, :information, :musicgenre, :image)");
            $stmt->execute([
                ':name' => $artist->getName(),
                ':information' => $artist->getInformation(),
                ':musicgenre' => $artist->getGenre(),
                ':image' => $artist->getImage()
            ]);

            return 'The artist ' . $artist->getName() . ' was created!';
        } catch (PDOException $e) {
            return 'The artist could not be created.';
        }
    }

    //update artist - anel
    public function updateArtist($artist)
    {
        try {
            $stmt = $this->connection->prepare("UPDATE artist SET artist_name = :name, artist_information = :information, genre = :musicgenre, artist_image = :image WHERE artist_id = :id");
            $stmt->execute([
                ':name' => $artist->getName(),
                ':information' => $artist->getInformation(),
                ':musicgenre' => $artist->getGenre(),
                ':image' => $artist->getImage(),
                ':id' => $artist->getId()
            ]);

            return $artist->getName() . ' was updated';
        } catch (PDOException $e) {
            return 'The artist could not be updated.';
        }
    }

    //delete artist - anel
    public function deleteArtist($id)
    {
        try {
            $stmt = $this->connection->prepare("DELETE FROM artist WHERE artist_id = :id");
            $stmt->execute([':id' => $id]);

            return 'The artist was deleted.';
        } catch (PDOException $e) {
            return 'Artist could not be deleted.';
        }
    }
    function getAllDanceSessions()
    {
        try {
            $stmt = $this->connection->prepare("SELECT event_session_dance.dance_event_id, event_session_dance.event_session_id, title, dance_session, price, amount_available, date_time, duration, venue_name, body, dance_event.venue_id FROM (((event_session_dance 
            INNER JOIN event_session ON event_session_dance.event_session_id = event_session.event_session_id) 
            INNER JOIN dance_event ON event_session_dance.dance_event_id = dance_event.dance_event_id)
            INNER JOIN venue ON dance_event.venue_id = venue.venue_id) ORDER BY event_session_dance.dance_event_id;");
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, 'DanceProgramme');
            $danceSessions = $stmt->fetchAll();

            return $danceSessions;
        } catch (PDOException $e) {
            echo $e;
        }
    }
    public function deleteProgrammeItem($programmeid, $sessionid)
    {
        try {
            $stmt3 = $this->connection->prepare("DELETE FROM event_session_dance WHERE event_session_id = :sessionid");
            $stmt3->execute([':sessionid' => $sessionid]);
            $stmt = $this->connection->prepare("DELETE FROM dance_event WHERE dance_event_id = :programmeid");
            $stmt->execute([':programmeid' => $programmeid]);

            $stmt2 = $this->connection->prepare("DELETE FROM event_session WHERE event_session_id = :sessionid");
            $stmt2->execute([':sessionid' => $sessionid]);


            return 'Programme Item is deleted.';
        } catch (PDOException $e) {
            return $e;
        }
    }
    public function createProgrammeItem($programmeitem)
    {
        try {
            $stmt = $this->connection->prepare("INSERT INTO dance_event (venue_id, title, dance_session, body, location) VALUES (:venueid, :title, :session, :body, :location);");
            $stmt->execute([
                ':venueid' => $programmeitem->getVenueId(),
                ':title' => $programmeitem->getTitle(),
                ':session' => $programmeitem->getSession(),
                ':body' => $programmeitem->getBody(),
                ':location' => $programmeitem->getLocation()
            ]);

            $danceeventid = $this->connection->lastInsertId();

            $stmt2 = $this->connection->prepare("INSERT INTO event_session (duration, date_time, amount_available, img_link, price) VALUES (:duration, :datetime, :amount_available, 'test', :price);");
            $stmt2->execute([
                ':duration' => $programmeitem->getDuration(),
                ':datetime' => $programmeitem->getDateTime(),
                ':amount_available' => $programmeitem->getTickets(),
                ':price' => $programmeitem->getPrice(),
            ]);

            $eventsessionid = $this->connection->lastInsertId();

            $stmt2 = $this->connection->prepare("INSERT INTO event_session_dance (event_session_id, dance_event_id) VALUES (:eventsessionid, :danceeventid);");
            $stmt2->execute([
                ':danceeventid' => $danceeventid,
                ':eventsessionid' => $eventsessionid,
            ]);

            return 'Programme Item is created.';
        } catch (PDOException $e) {
            return 'Programme Item could not be created.';
        }
    }
    public function editProgrammeItem($programmeitem)
    {
        try {
            $stmt = $this->connection->prepare("UPDATE dance_event SET venue_id = :venueid, title = :title, dance_session = :session, body = :body, location = :location WHERE dance_event_id = :danceeventid;");
            $stmt->execute([
                ':venueid' => $programmeitem->getVenueId(),
                ':title' => $programmeitem->getTitle(),
                ':session' => $programmeitem->getSession(),
                ':body' => $programmeitem->getBody(),
                ':location' => $programmeitem->getLocation(),
                ':danceeventid' => $programmeitem->getDanceEventId()
            ]);

            $stmt2 = $this->connection->prepare("UPDATE event_session SET duration = :duration, date_time = :datetime, amount_available = :amount_available, price = :price WHERE event_session_id = :dancesessionid;");
            $stmt2->execute([
                ':duration' => $programmeitem->getDuration(),
                ':datetime' => $programmeitem->getDateTime(),
                ':amount_available' => $programmeitem->getTickets(),
                ':price' => $programmeitem->getPrice(),
                ':dancesessionid' => $programmeitem->getEventSessionId()
            ]);
            return 'Programme Item is edited.';
        } catch (PDOException $e) {
            return $e;
        }
    }
}
