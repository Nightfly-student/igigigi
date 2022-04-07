<?php
require __DIR__ . '/../repositories/dancerepository.php';
class DanceService
{
    private $repository;

    public function __construct()
    {
        $this->repository = new DanceRepository();
    }
    public function getAll()
    {
        return $this->repository->getAll();
    }
    public function getAllArtists()
    {
        return $this->repository->getAllArtists();
    }
    public function getAllClubs()
    {
        return $this->repository->getAllClubs();
    }

    public function getAllVenues()
    {
        return $this->repository->getAllVenues();
    }
    
    public function getDancePageInfo(){
        return $this->repository->getDancePageInfo();
    }

    public function getVenueById($id)
    {
        return $this->repository->getVenueById($id);
    }
    public function deleteVenue($id)
    {
        return $this->repository->deleteVenue($id);
    }
    public function createVenue($venue){
        return $this->repository->createVenue($venue);
    }

    public function updateVenue($venue){
        return $this->repository->updateVenue($venue);
    }

    public function createArtist($artist){
        return $this->repository->createArtist($artist);
    }

    public function updateArtist($artist){
        return $this->repository->updateArtist($artist);
    }
    public function deleteArtist($id){
        return $this->repository->deleteArtist($id);
    }
    public function getArtistById($id){
        return $this->repository->getArtistById($id);
    }
    public function getAllDanceSessions(){
        return $this->repository->getAllDanceSessions();
    }
    public function deleteProgrammeItem($programmeid, $sessionid){
        return $this->repository->deleteProgrammeItem($programmeid, $sessionid);
    }
    public function createProgrammeItem($programmeitem){
        return $this->repository->createProgrammeItem($programmeitem);
    }
    public function editProgrammeItem($programmeitem){
        return $this->repository->editProgrammeItem($programmeitem);
    }
}
