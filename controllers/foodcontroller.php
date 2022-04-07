<?php
require_once __DIR__ . '/Controller.php';

require __DIR__ . '/../services/restaurantservice.php';



class FoodController extends Controller{
        
    private $restaurantService;
    function __construct()
    {
        $this->restaurantService = new RestaurantService();
    }
    function index(){
        $model = $this->restaurantService->getAll();
        echo $this->displayView($model);
    }
}