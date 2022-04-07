<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Haarlem Festival</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Select Flag Form -->
    <link rel="stylesheet" href="//unpkg.com/bootstrap-select-country@4.0.0/dist/css/bootstrap-select-country.min.css" type="text/css" />
    <link href="/css/style.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>
<body>
    <section>
        <div class="background">
            <div class="row border-bottom border-dark">
                <nav class="navbar navbar-expand-lg navbar-dark backgroundnav">
                    <div class="container-fluid navbarborder">
                        <div class="row">
                            <div class="col">
                                <a class="navbar-brand" href="/home">
                                    <img src="/images/logo.png" width="110" height="60" alt="Haarlem Festival">
                                </a>
                            </div>
                        </div>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse text-dark" id="navbarNav">
                            <ul class="navbar-nav ms-md-auto gap-2">
                                <li class="nav-item rounded-lg">
                                    <button type="button" class="btn navHome <?=echoActiveClassIfRequestMatches("home")?>" id="homeButton">
                                        <a class="nav-link text-light fs-5" href="/home">HOME</a>
                                    </button>
                                </li>
                                <li class="nav-item dropdown-lg">
                                    <button type="button" class="btn navHome <?=echoActiveClassIfRequestMatches("food")?><?=echoActiveClassIfRequestMatches("dance")?><?=echoActiveClassIfRequestMatches("historic")?><?=echoActiveClassIfRequestMatches("restaurant")?>" id="eventDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <a class="nav-link dropdown-toggle text-light fs-5" href="#">EVENTS </a>
                                    </button>
                                    <div class="dropdown-menu bg-dark text-dark pb-0 pt-6" aria-labelledby="eventDropdown">
                                        <a class="dropdown-item bg-dark text-white text-center fs-5 <?=echoActiveClassIfRequestMatches("food")?><?=echoActiveClassIfRequestMatches("restaurant")?>" href="/food">FOOD</a>
                                        <a class="dropdown-item bg-dark text-white text-center fs-5 <?=echoActiveClassIfRequestMatches("historic")?>" href="/historic">HISTORIC</a>
                                        <a class="dropdown-item bg-dark text-white text-center fs-5 <?=echoActiveClassIfRequestMatches("dance")?>" href="/dance">DANCE</a>
                                    </div>
                                </li>
                                <li class="nav-item rounded-lg">
                                    <button type="button" class="btn navHome <?=echoActiveClassIfRequestMatches("tickets")?>" id="ticketButton" >
                                        <a class="nav-link text-light fs-5" href="/tickets">TICKETS</a>
                                    </button>
                                </li>
                                <li class="nav-item dropdown-lg">
                                    <button type="button" class="btn navHome <?=echoActiveClassIfRequestMatches("login")?> <?=echoActiveClassIfRequestMatches("dashboard")?> <?=echoActiveClassIfRequestMatches("dashboard")?>" id="loginDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <a class="nav-link dropdown-toggle text-light fs-5" href="#"><i class="fas fa-user"></i>
                                        <?php
                                         if (checkLogin())
                                         {
                                             echo $_SESSION['username'];
                                         }
                                        ?></a>
                                    </button>
                                    <div class="dropdown-menu bg-dark text-dark pb-0 mt-1 pt-0" aria-labelledby="loginDropdown">
                                        <?php 
                                        if (checkLogin())
                                        {
                                        ?>
                                            <a class="dropdown-item bg-dark text-white text-center fs-5 <?=echoActiveClassIfRequestMatches("dashboard")?>" href="/dashboard">Dashboard</a>
                                            <a class="dropdown-item bg-dark text-white text-center fs-5" href="/login/logout">Logout</a>
                                            <?php
                                        }
                                        else
                                        {
                                            ?>
                                            <a class="dropdown-item bg-dark text-white text-center fs-5 <?=echoActiveClassIfRequestMatches("login")?>" href="/login">Login</a>
                                            <a class="dropdown-item bg-dark text-white text-center fs-5 <?=echoActiveClassIfRequestMatches("register")?>" href="/register">Register</a>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                </li>
                                <li class="nav-item rounded-lg">
                                    <button type="button" class="btn navHome <?=echoActiveClassIfRequestMatches("cart")?>" id="cartButton">
                                        <a class="nav-link text-light fs-5" href="/cart"><i class="fas fa-shopping-cart"></i></a>
                                    </button>
                                </li>
                                <!-- <li class="nav-item btn search-box">
                                    <button class="btn-search">
                                        <i class="fas fa-search"></i>
                                    </button>
                                    <input type="text" class="input-search" placeholder="Type to search...">
                                </li> -->
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
            <main>
                {{content}}
            </main>
        </div>
    </section>
    <footer>
        <div class="text-center text-white">
            <div class="container p-4">
            </div>

            <section class="">
                <div class="row">

                    <div class="col-lg-5 col-md-5 col-sm-4 col-xs-12nounderline">
                        <h3>Haarlem Festival</h3>
                        <a href="/food" class="text-white">Food Event</a>
                        <a href="/dance" class="text-white mx-2">Dance Event</a>
                        <a href="/historic" class="text-white">Historic Event</a>
                    </div>

                    <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                        <h3>Support</h3>
                        <a href="/tickets" class="text-white">Tickets</a>
                        <a href="/contact" class="text-white mx-2">Contact</a>
                        <a href="#!" class="text-white">About Us</a>
                    </div>

                    <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                        <h3>Stay Connected</h3>
                        <form action="news/insertEmail" method="post" enctype="multipart/form-data" onsubmit="return confirm('Do you really want to submit the form?');">
                            <div class="row d-flex justify-content-center">
                                <div class="col-md-8 col-12">
                                    <div class="form-outline form-white mb-2">
                                        <input type="email" name="email" method="post" id="email" class="form-control" placeholder="Enter Email" />
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <button type="submit" name="submit" value="submit" class="btn btn-primary mb-4">Sign Up</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </section>
            <hr>
            </hr>
            <section class="">
                <div class="col-lg-5 col-md-5 col-sm-4 col-xs-12">
                    <a href="#!" class="text-white">Privacy Policy</a>&nbsp;
                    <a href="#!" class="text-white">Terms of Service</a>&nbsp;
                    <a href="#!" class="text-white">Cookies</a>&nbsp;
                    <a href="#!" class="text-white">Sponsors</a>
                </div>
            </section>
            <section class="">
                <div class="row d-flex mt-1 justify-content-between">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-xl-5 color-grey mt-3">
                        <h6>Copyright &#169; <?= date("Y") ?> GRET Media Group </h6>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-xl-3 d-flex justify-content-center mt-2">
                        <a class="btn m-1" href="#"><i class="fa fa-instagram mx-1 fa-2x"></i></a>
                        <a class="btn m-1" href="#"><i class="fa fa-facebook mx-1 fa-2x"></i></a>
                        <a class="btn m-1" href="#"><i class="fa fa-twitter mx-1 fa-2x"></i></a>
                    </div>
                </div>
            </section>
        </div>
    </footer>
    </script>
    <script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <?php 
    function echoActiveClassIfRequestMatches($requestUri) {
        $current_file_name = basename($_SERVER['REQUEST_URI']);
        if ($current_file_name == $requestUri)
            echo 'backgroundnavbar';
    }
    ?>
</body>
</html>