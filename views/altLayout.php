<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Haarlem Festival - Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="/css/stylesheet.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
</head>
<body>
    <section>
        <div>
            <div class="modal fade" id="modalSimpleMessage" tabindex="1" role="dialog" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content bg-dark">
                        <div class="row">
                            <div class="col-xl-2 p-1">
                                <div class="mt-2 mx-1">
                                    <div class="loadingspinner mx-2"></div>
                                </div>
                            </div>
                            <div class="col-xl-9">
                                <div class="modal-header">
                                    <h5 id="simpleMessage">Modal title</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="grey col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-3 mb-2">
                    <img src="/images/logo.png" class="logo p-4" alt="logo" />
                </div>
                <div class="col d-lg-flex justify-content-center col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-9 mb-2">
                    <?php if (!checkAdminLogin()) { ?>
                        <nav class="navbar navbar-expand-lg navbar-dark">

                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse" id="navbarNav">
                                <ul class="navbar-nav ms-md-auto gap-2">
                                    <li class="nav-item rounded">
                                        <button type="button" class="btn btn-current"> <a class="nav-link text-light " href="/admin"><i class="fas fa-home"></i></a></button>
                                    </li>

                                    <li class="nav-item rounded">
                                        <div class="dropdown">
                                            <button type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="btn btn-dark">
                                                <a class="nav-link text-light" href="#">
                                                    <!--<i class="fas fa-table mx-2"></i>-->Historic<i class="fas fa-caret-down mx-1"></i>
                                                </a>
                                            </button>
                                            <div class="dropdown-menu bg-dark text-light text-center" aria-labelledby="dropdownMenuButton">
                                                <a class="dropdown-item" href="/admin/tours">Tours</a>
                                                <a class="dropdown-item" href="/admin/historicpage">Historic Page</a>
                                                <a class="dropdown-item" href="/admin/historicevents">Events</a>
                                            </div>

                                        </div>
                                    </li>

                                    <li class="nav-item rounded">
                                        <div class="dropdown">
                                            <button type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="btn btn-dark">
                                                <a class="nav-link text-light" href="#">
                                                    <!-- <i class="fas fa-table mx-2"> </i> -->Food<i class="fas fa-caret-down mx-2"></i>
                                                </a>
                                            </button>
                                            <div class="dropdown-menu bg-dark text-light text-center" aria-labelledby="dropdownMenuButton">
                                                <a class="dropdown-item" href="/admin/restaurants">Restaurants</a>
                                                <a class="dropdown-item" href="/admin/sessions">Sessions</a>
                                                <a class="dropdown-item" href="/admin/foodpage">Food Page</a>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="nav-item rounded">
                                        <div class="dropdown dropright">
                                            <button type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="btn btn-dark">
                                                <a class="nav-link text-light" href="#">
                                                    <!-- <i class="fas fa-table mx-2"></i> -->Dance<i class="fas fa-caret-down mx-1"></i>
                                                </a>
                                            </button>
                                            <div class="dropdown-menu bg-dark text-light text-center" aria-labelledby="dropdownMenuButton">
                                                <a class="dropdown-item" href="/admin/artists">Artists</a>
                                                <a class="dropdown-item" href="/admin/venues">Venues</a>
                                                <a class="dropdown-item" href="/admin/danceprogram">Dance Program</a>

                                            </div>
                                        </div>
                                    </li>
                                    <li class="nav-item rounded">
                                        <button type="button" class="btn btn-dark"> <a class="nav-link text-light " href="/admin/tickets"><i class="fas fa-ticket mx-2"></i>Tickets</a></button>
                                    </li>
                                    <li class="nav-item rounded">
                                        <button type="button" class="btn btn-dark"> <a class="nav-link text-light " href="/admin/tickets"><i class="fas fa-ticket mx-2"></i>Tickets</a></button>
                                    </li>
                                    <li class="nav-item rounded">
                                        <button type="button" class="btn btn-dark"> <a class="nav-link text-light " href="/admin/settings"><i class="fas fa-cog mx-2"></i>Settings </a></button>
                                    </li>
                                    <li class="nav-item rounded">
                                        <button type="button" class="btn btn-dark"> <a class="nav-link text-light " href="/contact"><i class="fas fa-sign-out-alt"></i></a></button>
                                    </li>
                                </ul>

                            </div>
                        <?php } ?>
                        </nav>
                </div>
            </div>
            <main>
                {{content}}
            </main>
            <div class="row color-grey mt-1 mb-4 justify-content-center text-center">
                <div class="col-xs-12 col-md-6 col-xl-3 text-white item">
                    <img src="/images/logo.png" class="p-4" width="80%" alt="logo" />
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-xl-9 text-white d-flex justify-content-end">
                    <?php if (!checkAdminLogin()) { ?>
                        <ul class="list-group list-group-horizontal">
                            <li class="mx-2"><a href=""><i class="fas fa-home mx-2 "></i>Home</a></li>
                            <li class="mx-2"><a href="#"><i class="fas fa-ticket mx-2"></i>Tickets</a></li>
                            <li class="mx-2 lead-4"><a href="#"><i class="fas fa-table mx-2"></i> Programs</a></li>
                            <li class="mx-2 lead-4"><a href="#"><i class="fas fa-table mx-2"></i>Events</a></li>
                            <li class="mx-2 lead-4"><a href="#"><i class="fas fa-cog mx-2"></i>Settings</a></li>
                            <li class="mx-2 lead-4"><a href="#"><i class="fas fa-sign-out mx-2"></i>Login</a></li>
                        </ul>
                    <?php } ?>
                </div>
            </div>
            <div class="row d-flex footer-row mt-1 justify-content-between mb-5">
                <div class="col-xs-12 col-sm-12 col-md-12 col-xl-10 color-grey mt-3">
                    <h5 class="lead">Website created by GRET Media &#169; <?= date("Y") ?></h5>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-xl-2 d-flex justify-content-center mt-2">
                    <a href="#"><i class="fab fa-instagram mx-2 fa-2x"></i></a>
                    <a href="#"><i class="fab fa-facebook mx-2 fa-2x"></i></a>
                    <a href="#"><i class="fab fa-twitter mx-2 fa-2x"></i></a>
                </div>
            </div>
        </div>
    </section>
    <script>
        // Data Picker Initialization
        //$('.datepicker').datepicker();
    </script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- jquery bootstrap -->
    <script src="/js/venues.js"></script>
    <script src="/js/artists.js"></script>
    <script src="/js/restaurant.js"></script>
    <script src="/js/user.js"></script>
    <script src="/js/danceprogramme.js"></script>

    <!-- Include the Quill library -->
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

    <!-- Initialize Quill editor -->
    <script>
        //var quill = new Quill('#editor', {
        //  theme: 'snow'
        //});
    </script>
</body>

</html>

