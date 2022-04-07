<?php
require_once __DIR__ . '/Controller.php';

require __DIR__ . '/../services/adminuserservice.php';
require __DIR__ . '/../services/danceservice.php';
require __DIR__ . '/../services/restaurantservice.php';
require __DIR__ . '/../services/restaurantpageservice.php';

require_once __DIR__ . '/../helpers/validator.php';
require_once __DIR__ . '/../helpers/salt.php';

require __DIR__ . '/../models/venue.php';
require __DIR__ . '/../models/artist.php';
require __DIR__ . '/../models/adminrestaurant.php';
require __DIR__ . '/../models/adminsession.php';
require __DIR__ . '/../models/adminuser.php';
require __DIR__ . '/../models/billing.php';
require __DIR__ . '/../models/restaurant.php';
require __DIR__ . '/../models/restaurantpage.php';
require __DIR__ . '/../models/danceprogramme.php';

class AdminController extends Controller
{
	private $userService;
	private $restaurantService;
	private $danceService;
	private $salt;
	private $validator;
	private $allowedImageExtensions = [];
	private $maxImageSize = 2048;

	public function __construct()
	{
		$this->userService = new AdminUserService();
		$this->restaurantService = new RestaurantService();
		$this->restaurantPageService = new RestaurantPageService();
		$this->danceService = new DanceService();
		$this->validator = new Validator();
		$this->salt = new Salt();
		$this->allowedImageExtensions = ['jpg', 'jpeg', 'png'];
	}
	public function index()
	{
		echo $this->displayAltViewOnly();
	}

	public function sessions(){
		$model['sessions'] = $this->restaurantPageService->getSessions();
		$model['restaurant'] = $this->restaurantService->getAllRestaurants();
		echo $this->displayAltView($model);
	}

	//Anel update artist
	public function updateartist()
	{
		$currentArtist = $this->danceService->getArtistById($_POST['artistId']);
		if ($currentArtist != null) {
			$allowedExtensions = ['jpeg', 'jpg', 'png'];
			$name = '/images/' . basename($_FILES["artistImage"]["name"]);

			if (basename($_FILES["artistImage"]["name"] == '')) {
				$name = $currentArtist->artist_image;
			}

			$extension = pathinfo($name, PATHINFO_EXTENSION);
			$target = './../public' . $name;

			$artist = new Artist();
			$artist->setId($_POST['artistId']);
			$artist->setName($_POST['artistName']);
			$artist->setInformation($_POST['artistInformation']);
			$artist->setGenre($_POST['artistGenre']);
			$artist->setImage($name);

			if (!file_exists($target)) {
				if (move_uploaded_file($_FILES["artistImage"]["tmp_name"], $target)) {
					unlink('./../public' . $currentArtist->artist_image);
					echo $this->danceService->updateArtist($artist);
				}
			} else {
				echo $this->danceService->updateArtist($artist);
			}
		} else {
			echo 'Something went wrong, the update was not done.';
		}
	}

	//anel update artist
	public function createartist()
	{
		$allowedExtensions = ['jpeg', 'jpg', 'png'];
		$name = '/images/' . basename($_FILES["artistImage"]["name"]);
		$extension = pathinfo($name, PATHINFO_EXTENSION);
		$target = './../public' . $name;

		$artist = new Artist();
		$artist->setName($_POST['artistName']);
		$artist->setInformation($_POST['artistInformation']);
		$artist->setGenre($_POST['artistGenre']);
		$artist->setImage($name);

		if (in_array($extension, $allowedExtensions)) {
			if (move_uploaded_file($_FILES["artistImage"]["tmp_name"], $target)) {
				echo $this->danceService->createArtist($artist);
			}
		} else {
			echo 'Something went wrong. The artist was not created.';
		}
	}

	//show artists - (anel)
	public function artists()
	{
		if ($_SERVER['REQUEST_METHOD'] == 'DELETE' && isset($_GET['id']) && is_numeric($_GET['id'])) {
			$id = $_GET['id'];

			$user = $this->danceService->getArtistById($id);
			if ($user == null) {
				echo 'This artist does not exist. ';
			} else {
				if (file_exists('./../public' . $user->artist_image)) {
					unlink('./../public' . $user->artist_image);
				}
				echo $this->danceService->deleteArtist($id);
			}
		}

		$model['artists'] = $this->danceService->getAllArtists();
		echo $this->displayAltView($model);
	}

	// create/update venue - anel
	public function putvenue()
	{
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$errors = [];
			$venueName = ($this->validator->validateTextInput($_POST['venueName'], 5)) ? $this->validator->sanitize($_POST['venueName']) :
				array_push($errors, 'Venue Name must be at least 10 characters long.');
			$venueAddress = ($this->validator->validateTextInput($_POST['venueAddress'], 10)) ? $this->validator->sanitize($_POST['venueAddress']) :
				array_push($errors, 'Venue address needs to be 10 characters.');
			$venueDescription = ($this->validator->validateTextInput($_POST['venueDescription'], 20)) ? $this->validator->sanitize($_POST['venueDescription']) :
				array_push($errors, 'Description needs to be 20 characters at least.');

			if (!empty($errors)) {
				echo json_encode(['passed' => false, 'message' => $errors[0]]);
				die();
			}

			$venue = new Venue();
			$venue->setName($_POST['venueName']);
			$venue->setAddress($_POST['venueAddress']);
			$venue->setDescription($_POST['venueDescription']);

			if (isset($_POST['venueId'])) {
				$venue->setId($_POST['venueId']);
				echo $this->danceService->updateVenue($venue);
			} else {
				echo $this->danceService->createVenue($venue);
			}
		} else {
			header("Location: /admin/venues");
		}
	}

	//show/delete venues - anel
	public function venues()
	{
		if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
			$id = (isset($_GET['id']) && is_numeric($_GET['id'])) ? $_GET['id'] : false;
			if ($id != false) {
				echo $this->danceService->deletevenue($id);
			}
		} else {
			$id = (isset($_GET['id']) && is_numeric($_GET['id'])) ? $_GET['id'] : null;
			$model['singleVenue'] = ($id != null) ? $this->danceService->getVenueById($id) : null;
			$model['venues'] = $this->danceService->getAllVenues();
			echo $this->displayAltView($model);
		}
	}

	public function programs()
	{
		echo $this->displayAltViewOnly();
	}

	public function historicprogram()
	{
		echo $this->displayAltViewOnly();
	}

	public function danceprogram()
	{
			$model['venues'] = $this->danceService->getAllVenues();
			$model['artists'] = $this->danceService->getAllArtists();
			$model['programme'] = $this->danceService->getAllDanceSessions();
			echo $this->displayAltView($model);
	}

	public function deletedanceprogram()
	{
		$programmeid = $_GET['programmeid'];
		$sessionid = $_GET['sessionid'];

		$this->danceService->deleteProgrammeItem($programmeid, $sessionid);

		header("Location: /admin/danceprogram");

	}

	public function createprogrammeitem()
	{
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

			if (empty($_POST['venue']) || empty($_POST['title']) || empty($_POST['session']) || empty($_POST['datetime']) || empty($_POST['price']) || empty($_POST['ticketsavailable']) ||
			 empty($_POST['duration']) || empty($_POST['description']))
			{
				/*one or more fields are empty*/
				header('Location: ' . 'danceprogram');	
			}
			else{
				$data = [
					'venue' => trim($_POST['venue']),
					'title' => trim($_POST['title']),
					'session' => trim($_POST['session']),
					'datetime' => trim($_POST['datetime']),
					'price' => trim($_POST['price']),
					'ticketsavailable' => trim($_POST['ticketsavailable']),
					'duration' => trim($_POST['duration']),
					'description' => trim($_POST['description'])
				];

				$location = $this->danceService->getVenueById($data['venue']);

				$programmeitem = new DanceProgramme();
				$programmeitem->setVenueId($data['venue']);
				$programmeitem->setTitle($data['title']);
				$programmeitem->setSession($data['session']);
				$programmeitem->setDateTime($data['datetime']);
				$programmeitem->setPrice($data['price']);
				$programmeitem->setTicketsAvailable($data['ticketsavailable']);
				$programmeitem->setDuration($data['duration']);
				$programmeitem->setDescription($data['description']);
				$programmeitem->setLocation($location->venue_name);

				$this->danceService->createProgrammeItem($programmeitem);
				header('Location: ' . '/admin/danceprogram');
			}
		}
	}

	public function editprogrammeitem()
	{
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

			if (empty($_POST['venue']) || empty($_POST['title']) || empty($_POST['session']) || empty($_POST['datetime']) || empty($_POST['price']) || empty($_POST['ticketsavailable']) ||
			empty($_POST['duration']) || empty($_POST['description']))
		   {
			   /*one or more fields are empty*/
			   header('Location: ' . 'danceprogram');	
		   }
		   else{
			$data = [
				'venue' => trim($_POST['venue']),
				'title' => trim($_POST['title']),
				'session' => trim($_POST['session']),
				'datetime' => trim($_POST['datetime']),
				'price' => trim($_POST['price']),
				'ticketsavailable' => trim($_POST['ticketsavailable']),
				'duration' => trim($_POST['duration']),
				'description' => trim($_POST['description']),
				'danceeventid' => trim($_POST['danceeventid']),
				'dancesessionid' => trim($_POST['dancesessionid'])
			];

			$location = $this->danceService->getVenueById($data['venue']);

			$programmeitem = new DanceProgramme();
			$programmeitem->setVenueId($data['venue']);
			$programmeitem->setTitle($data['title']);
			$programmeitem->setSession($data['session']);
			$programmeitem->setDateTime($data['datetime']);
			$programmeitem->setPrice($data['price']);
			$programmeitem->setTicketsAvailable($data['ticketsavailable']);
			$programmeitem->setDuration($data['duration']);
			$programmeitem->setDescription($data['description']);
			$programmeitem->setLocation($location->venue_name);
			$programmeitem->setDanceEventId($data['danceeventid']);
			$programmeitem->setDanceSessionId($data['dancesessionid']);

			$this->danceService->editProgrammeItem($programmeitem);
			header('Location: ' . '/admin/danceprogram');
		   }
		}
	}

	public function dance()
	{
		echo $this->displayAltViewOnly();
	}

	//show users anel
	public function users()
	{
		$model['users'] = $this->userService->getAllUsers();
		$model['roles'] = $this->userService->getRoles();
		echo $this->displayAltView($model);
	}

	//delete user anel
	public function deleteuser()
	{
		if ($_SERVER['REQUEST_METHOD'] == 'DELETE' && isset($_GET['id']) && is_numeric($_GET['id'])) {
			echo $this->userService->deleteUser($_GET['id']);
		} else {
			header("Location: /admin/users");
		}
	}

	//Update user - Anel
	public function updateuser()
	{
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$errors = [];
			$userToUpdate = $this->userService->getUserById($_POST['userId']);
			if ($userToUpdate == false) {
				echo 'User could not be updated.';
				return;
			}
			$boolPasswords = ($this->validator->validatePassword($_POST['password']) &&
				$_POST['password'] == $_POST['passwordConfirm']) ? true : false;

			$salt = (isset($_POST['passwordBool']) && $boolPasswords == true) ? $this->salt->generateSalt() : $userToUpdate->salt;
			$username = (!empty($_POST['username']) && $this->validator->validateTextInput($_POST['username'], 6)) ?
				$this->validator->sanitize($_POST['username']) : array_push($errors, 'Username is not entered, minimum of 6 characters. ');
			$email = (!empty($_POST['email']) && $this->validator->validateEmail($_POST['email'])) ?
				$this->validator->sanitize($_POST['email']) : array_push($errors, 'The entered email is not correct, please enter a valid email.');
			$password = (isset($_POST['passwordBool']) && $_POST['password'] == $_POST['passwordConfirm']
				&& $this->validator->validatePassword($_POST['password'])) ?
				hash('sha256', $salt . $this->validator->sanitize($_POST['password'])) :
				$userToUpdate->password;
			$role = (is_numeric($_POST['userRoles'])) ? $_POST['userRoles'] :
				array_push($errors, 'Role was incorrect.');
			
			$billingId = ($userToUpdate->billing_info_id != null) ? $userToUpdate->billing_info_id : 0; 
			
			$user = new AdminUser();
			$user->fillObject($userToUpdate->users_id, $role, $username, $billingId, null, $email, $password, $salt, '');

			if (isset($_POST['billingInformationBool'])) {
				$name = ($this->validator->validateTextInput($_POST['firstname'], 2)) ?
					$this->validator->sanitize($_POST['firstname']) : array_push($errors, 'Enter firstname');
				$lastname = ($this->validator->validateTextInput($_POST['lastname'], 3)) ?
					$this->validator->sanitize($_POST['lastname']) : array_push($errors, 'Enter lastname.');
				$phone = ($this->validator->validatePhonenumber($_POST['phonenumber'])) ?
					$this->validator->sanitize($_POST['phonenumber']) : array_push($errors, 'Enter phone number.');
				$address = ($this->validator->validateTextInput($_POST['address'], 8)) ?
					$this->validator->sanitize($_POST['address']) : array_push($errors, 'Enter valid address.');
				$country = ($this->validator->validateTextInput($_POST['country'], 1)) ?
					$this->validator->sanitize($_POST['country']) : array_push($errors, 'Enter valid country.');

				$billing = new Billing();
				$billing->fillObject($billingId, $name, $lastname, $phone, $address, $country);
				$user->setBillingInfo($billing);
			}

			if(!empty($errors)){
				echo json_encode(['passed' => false, 'message' => $errors[0]]);
			}else{
				echo $this->userService->updateUser($user);
			}

		} else {
			header("Location: /admin/users");
		}
	}

	//Creates user from submitted post data - Anel Gusinac
	public function createuser()
	{
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$errors = [];
			$username = (!empty($_POST['username']) && $this->validator->validateTextInput($_POST['username'], 6)) ?
				$this->validator->sanitize($_POST['username']) : array_push($errors, 'Username is not entered, minimum of 6 characters. ');
			if ($this->userService->checkIfUsernameIsTaken($username) == true)
				array_push($errors, 'This username is taken.');

			$email = (!empty($_POST['email']) && $this->validator->validateEmail($_POST['email'])) ?
				$this->validator->sanitize($_POST['email']) : array_push($errors, 'The entered email is not correct, please enter a valid email.');
			if ($this->userService->checkIfEmailIsTaken($email) == true)
				array_push($errors, 'This email is taken.');

			$salt = $this->salt->generateSalt();
			$roleId = (!empty($_POST['userRoles']) && is_numeric($_POST['userRoles'])) ?
				$this->validator->sanitize($_POST['userRoles']) : array_push($errors, 'Role id was not set.');

			$password = ($this->validator->validatePassword($_POST['password']) && $_POST['password'] == $_POST['passwordConfirm']) ?
				hash('sha256', $salt . $this->validator->sanitize($_POST['password'])) :
				array_push($errors, 'The password was incorrect, please make sure both password match and contain 1 number 1 upper-case and must be at least 8 characters long');

			$user = new AdminUser();
			$user->setUsername($username);
			$user->setEmail($email);
			$user->setSalt($salt);
			$user->setPassword($password);
			$user->setUserRoleId($roleId);

			if (isset($_POST['billingInformationBool'])) {
				$name = (!empty($_POST['firstname']) && $this->validator->validateTextInput($_POST['firstname'], 2)) ?
					$this->validator->sanitize($_POST['firstname']) : array_push($errors, 'Firstname was not entered, or its too short minimum of 2 characters. ');

				$lastname = (!empty($_POST['lastname']) && $this->validator->validateTextInput($_POST['lastname'], 3)) ?
					$this->validator->sanitize($_POST['lastname']) : array_push($errors, 'Firstname was not entered, or its too short minimum of 3 characters. ');

				$phone = (!empty($_POST['phonenumber']) && $this->validator->validateTextInput($_POST['phonenumber'])) ?
					$this->validator->sanitize($_POST['phonenumber']) : array_push($errors, 'Please enter a valid phone number. ');

				$address = (!empty($_POST['address']) && $this->validator->validateTextInput($_POST['address'], 10)) ?
					$this->validator->sanitize($_POST['address']) : array_push($errors, 'Enter a valid address');

				$country = (!empty($_POST['country']) && $this->validator->validateTextInput($_POST['country'], 2)) ?
					$this->validator->sanitize($_POST['country']) : array_push($errors, 'Enter a country.');

				$billingInformation = new Billing();
				$billingInformation->setName($name);
				$billingInformation->setLastname($lastname);
				$billingInformation->setAddress($address);
				$billingInformation->setPhone($phone);
				$billingInformation->setCountry($country);
				$user->setBillingInfo($billingInformation);
			} else {
				$user->setBillingInfo(null);
			}
			if (!empty($errors)) {
				echo json_encode(['passed' => false, 'message' => $errors[0]]);
				die();
			} else {
				echo $this->userService->createUser($user);
			}
		}
	}

	public function foodprogram()
	{
		echo $this->displayAltViewOnly();
	}

	//show restaurants anel
	public function restaurants()
	{
		$model['restaurants'] = $this->restaurantService->getAllRestaurants();
		echo $this->displayAltView($model);
	}

	//anel
	public function deleterestaurant()
	{
		if (isset($_GET['id']) && is_numeric($_GET['id']) && $_SERVER['REQUEST_METHOD'] == 'DELETE') {
			$restaurant = $this->restaurantService->getRestaurantById($_GET['id']);
			unlink('./../public' . $restaurant->img_link);
			echo $this->restaurantService->deleteRestaurant($_GET['id']);
		} else {
			header("Location: /admin/restaurants");
		}
	}

	//anel
	public function updateRestaurant()
	{
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$errors = [];
			$id = (is_numeric($_POST['restaurantId'])) ? $this->validator->sanitize($_POST['restaurantId']) : array_push($errors, 'Something went wrong. Try again.');

			$currentRestaurant = '';

			if ($this->restaurantService->getRestaurantById($id) != null) {
				$currentRestaurant = $this->restaurantService->getRestaurantById($id);
				$name = '/images/' . basename($_FILES["restaurantImage"]["name"]);

				$extension = pathinfo($name, PATHINFO_EXTENSION);
				$target = './../public' . $name;
			} else {
				array_push($errors, 'The restaurant does not exist. Select other restaurant to update');
			}

			$cuisine = [];
			if (isset($_POST['frenchCuisine'])) array_push($cuisine, $_POST['frenchCuisine']);
			if (isset($_POST['dutchCuisine'])) array_push($cuisine, $_POST['dutchCuisine']);
			if (isset($_POST['chineseCuisine'])) array_push($cuisine, $_POST['chineseCuisine']);
			if (isset($_POST['greekCuisine'])) array_push($cuisine, $_POST['greekCuisine']);
			if (isset($_POST['italianCuisine'])) array_push($cuisine, $_POST['italianCuisine']);
			if (isset($_POST['japaneseCuisine'])) array_push($cuisine, $_POST['japaneseCuisine']);
			if (isset($_POST['turkishCuisine'])) array_push($cuisine, $_POST['turkishCuisine']);
			if (isset($_POST['indianCuisine'])) array_push($cuisine, $_POST['indianCuisine']);
			if (isset($_POST['indonesianCuisine'])) array_push($cuisine, $_POST['indonesianCuisine']);
			if (isset($_POST['vietnameseCuisine'])) array_push($cuisine, $_POST['vietnameseCuisine']);

			$stringCuisine = '';
			foreach ($cuisine as $c) {
				$stringCuisine .= ' ' . $c;
			}

			$restaurantName = ($this->validator->validateTextInput($_POST['restaurantName'])) ?
				$this->validator->sanitize($_POST['restaurantName']) : array_push($errors, 'Restaurant title was not entered. Minimum of 10 characters.');

			$restaurantLocation = ($this->validator->validateTextInput($_POST['restaurantLocation'])) ?
				$this->validator->sanitize($_POST['restaurantLocation']) : array_push($errors, 'Restaurant location was not entered. Minimum of 10 characters.');

			$restaurantBody = ($this->validator->validateTextInput($_POST['restaurantBody'], 50)) ?
				$this->validator->sanitize($_POST['restaurantBody']) : array_push($errors, 'Restaurant body text was not entered. Minimum of 50 characters.');

			$restaurantOpeningtime = $this->validator->sanitize($_POST['restaurantOpeningtime']);

			$accessibility = (isset($_POST['wheelchair'])) ? '<i class="fa fa-wheelchair text-light"></i> Wheelchair Friendly' : '<p></p>';

			if ($name == '/images/') {
				$name = $currentRestaurant->img_link;
			} else {
				try {
					if (!in_array($extension, $this->allowedImageExtensions)) array_push($errors, 'The selected file type is not allowed, only png or jpg/jpeg ar allowed.');
					if (file_exists($target)) {
						$name = '/images/' . random_int(1250, 10000) . basename($_FILES["restaurantImage"]["name"]);
						$target = './../public' . $name;
					}
					if (file_exists('./../public' . $currentRestaurant->img_link)) {
						unlink('./../public' . $currentRestaurant->img_link);
					}
					move_uploaded_file($_FILES["restaurantImage"]["tmp_name"], $target);
				} catch (\Throwable $th) {
					array_push($errors, 'Something went wrong uploading the file.');
				}
			}
			if (!empty($errors)) {
				echo json_encode(['passed' => false, 'message' => $errors[0]]);
				die();
			} else {
				$restaurant = new AdminRestaurant();
				$restaurant->setId($id);
				$restaurant->setTitle($restaurantName);
				$restaurant->setOpeningtime($restaurantOpeningtime);
				$restaurant->setLocation($restaurantLocation);
				$restaurant->setCuisine(htmlspecialchars($stringCuisine));
				$restaurant->setBody($restaurantBody);
				$restaurant->setAccessibility($accessibility);
				$restaurant->setImgLink($name);
				echo $this->restaurantService->updateRestaurant($restaurant);
			}
		} else {
			Header("Location: /admin/restaurants");
		}
	}

	//anel
	public function createrestaurant()
	{
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$errors = [];
			$name = '/images/' . basename($_FILES["restaurantImage"]["name"]);
			$extension = pathinfo($name, PATHINFO_EXTENSION);
			$target = './../public' . $name;
			$cuisine = [];
			if (isset($_POST['frenchCuisine'])) array_push($cuisine, ($_POST['frenchCuisine']));
			if (isset($_POST['dutchCuisine'])) array_push($cuisine, ($_POST['dutchCuisine']));
			if (isset($_POST['chineseCuisine'])) array_push($cuisine, ($_POST['chineseCuisine']));
			if (isset($_POST['greekCuisine'])) array_push($cuisine, $_POST['greekCuisine']);
			if (isset($_POST['italianCuisine'])) array_push($cuisine, $_POST['italianCuisine']);
			if (isset($_POST['japaneseCuisine'])) array_push($cuisine, $_POST['japaneseCuisine']);
			if (isset($_POST['turkishCuisine'])) array_push($cuisine, $_POST['turkishCuisine']);
			if (isset($_POST['indianCuisine'])) array_push($cuisine, $_POST['indianCuisine']);
			if (isset($_POST['indonesianCuisine'])) array_push($cuisine, $_POST['indonesianCuisine']);
			if (isset($_POST['vietnameseCuisine'])) array_push($cuisine, $_POST['vietnameseCuisine']);

			$stringCuisine = '';
			foreach ($cuisine as $c) {
				$stringCuisine .= ' ' . $c;
			}
			$restaurantName = ($this->validator->validateTextInput($_POST['restaurantName'])) ?
				$this->validator->sanitize($_POST['restaurantName']) : array_push($errors, 'Restaurant title was not entered. Minimum of 10 characters.');

			$restaurantLocation = ($this->validator->validateTextInput($_POST['restaurantLocation'])) ?
				$this->validator->sanitize($_POST['restaurantLocation']) : array_push($errors, 'Restaurant location was not entered. Minimum of 10 characters.');

			$restaurantBody = ($this->validator->validateTextInput($_POST['restaurantBody'], 50)) ?
				$this->validator->sanitize($_POST['restaurantBody']) : array_push($errors, 'Restaurant body text was not entered. Minimum of 50 characters.');

			$restaurantOpeningtime = $this->validator->sanitize($_POST['restaurantOpeningtime']);

			if ($name == '/images/') array_push($errors, 'No image was selected, please select an image. ');
			if (!in_array($extension, $this->allowedImageExtensions)) array_push($errors, 'The selected file type is not allowed, only png or jpg/jpeg ar allowed.');

			if (file_exists($target)) {
				$name = '/images/' . random_int(1250, 10000) . basename($_FILES["restaurantImage"]["name"]);
				$target = './../public' . $name;
			}

			$accessibility = (isset($_POST['wheelchair'])) ? '<i class="fa fa-wheelchair text-light"></i> Wheelchair Friendly' : '<p></p>';

			if (!empty($errors)) {
				echo json_encode(['passed' => false, 'message' => $errors[0]]);
				die();
			} else {
				$session = new AdminSession();
				$session->setTitle($restaurantName);
				$session->setOpeningtime($restaurantOpeningtime);
				$session->setLocation($restaurantLocation);
				$session->setCuisine(htmlspecialchars($stringCuisine));
				$session->setBody($restaurantBody);
				$session->setAccessibility($accessibility);
				$session->setImgLink($name);
			}
			if (move_uploaded_file($_FILES["restaurantImage"]["tmp_name"], $target)) {
				echo $this->restaurantService->createRestaurant($restaurant);
			} else {
				echo "Something went wrong while uploading the image, please try again. ";
			}
		} else {
			header("Location: /admin/restaurants");
		}
	}




	//Werno - show sessions
	public function foodsessions()
	{
		$model['sessions'] = $this->restaurantPageService->getRestaurant();
		echo $this->displayAltView($model);
	}

	//Werno - Add Sessions
	public function createsession()
	{
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

			if (empty($_POST['event_session_id']) || empty($_POST['title']) || empty($_POST['datetime']) || empty($_POST['duration']))
			{
				/*one or more fields are empty*/
				header('Location: ' . 'sessions');	
			}
			else{
				$data = [
					'event_session_id' => trim($_POST['event_session_id']),
					'title' => trim($_POST['title']),
					'datetime' => trim($_POST['datetime']),
					'duration' => trim($_POST['duration']),
					'img_link' => trim($_POST['img_link']),

				];

				$session = new AdminSession();
				$session->setTitle($title);
				$session->setOpeningtime($openingtime);
				$session->setDuration($duration);
				$session->setDatetime($datetime);
				$session->setImgLink($name);


				$this->restaurantPageService->createSession($event_session_id, $duration, $date_time, $amount_available, $img_link, $price);
				header('Location: ' . '/admin/danceprogram');	
			}
		}
	}

	//werno - update session
	public function updateSession()
	{
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$errors = [];
			$id = (is_numeric($_POST['event_session_id'])) ? $this->validator->sanitize($_POST['event_session_id']) : array_push($errors, 'Something went wrong. Try again.');

			$currentSession = '';

			if ($this->restaurantPageService->getEventSessionById($id) != null) {
				$currentSession = $this->restaurantPageService->getEventSessionById($id);
				$name = '/images/' . basename($_FILES["restaurantImage"]["name"]);

				$extension = pathinfo($name, PATHINFO_EXTENSION);
				$target = './../public' . $name;
			} else {
				array_push($errors, 'The restaurant does not exist. Select other restaurant to update');
			}


			$restaurantName = ($this->validator->validateTextInput($_POST['restaurantName'])) ?
				$this->validator->sanitize($_POST['restaurantName']) : array_push($errors, 'Restaurant title was not entered. Minimum of 10 characters.');

			$sessionDuration = $this->validator->sanitize($_POST['duration']);
			$sessionDateTime = $this->validator->sanitize($_POST['date_time']);

			$sessionOpeningtime = $this->validator->sanitize($_POST['openingtime']);

			if ($name == '/images/') {
				$name = $currentSession->img_link;
			} else {
				try {
					if (!in_array($extension, $this->allowedImageExtensions)) array_push($errors, 'The selected file type is not allowed, only png or jpg/jpeg ar allowed.');
					if (file_exists($target)) {
						$name = '/images/' . random_int(1250, 10000) . basename($_FILES["restaurantImage"]["name"]);
						$target = './../public' . $name;
					}
					if (file_exists('./../public' . $currentSession->img_link)) {
						unlink('./../public' . $currentSession->img_link);
					}
					move_uploaded_file($_FILES["restaurantImage"]["tmp_name"], $target);
				} catch (\Throwable $th) {
					array_push($errors, 'Something went wrong uploading the file.');
				}
			}
			if (!empty($errors)) {
				echo json_encode(['passed' => false, 'message' => $errors[0]]);
				die();
			} else {
				$session = new AdminRestaurant();
				$session->setId($id);
				$restaurant->setTitle($restaurantName);
				$restaurant->setOpeningtime($restaurantOpeningtime);
				$restaurant->setLocation($restaurantLocation);
				$restaurant->setCuisine(htmlspecialchars($stringCuisine));
				$restaurant->setBody($restaurantBody);
				$restaurant->setAccessibility($accessibility);
				$restaurant->setImgLink($name);
				echo $this->restaurantService->updateRestaurant($restaurant);
			}
		} else {
			Header("Location: /admin/restaurants");
		}
	}

	//werno - delete session
	public function deletesession()
	{
		if (isset($_GET['id']) && is_numeric($_GET['id']) && $_SERVER['REQUEST_METHOD'] == 'DELETE') {
			$event_session = $this->restaurantPageService->getEventSessionById($_GET['id']);
			unlink('./../public' . $event_session->img_link);
			echo $this->restaurantPageService->deleteSession($_GET['id']);
		} else {
			header("Location: /admin/restaurants");
		}
	}




	public function tickets()
	{
		echo $this->displayAltViewOnly();
	}

	public function settings()
	{
		echo $this->displayAltViewOnly();
	}
}
