<?php
require_once __DIR__ . '/Controller.php';

require __DIR__ . '/../services/danceservice.php';


class DanceController extends Controller{
        
        private $danceService;
        function __construct()
        {
            $this->danceService = new DanceService();
        }
        function index(){

			$merged_model = array(
				$this->danceService->getAll(),
				$this->danceService->getAllArtists(),
				$this->danceService->getAllClubs(),
                $this->danceService->getDancePageInfo()
			  );
            echo $this->displayView($merged_model);


        }
    
}