<div class="container-xxl">
    <header class="row text-center">
        <div class="col-xl-12 text-light">
            <h1 class="p-4"><?php echo $model[0]->getPageTitle() ?></h1>
            <div class="row p-3">
                <div class="col-lg-7 col-md-6 col-sm-12 text-center">
                    <img class="img-fluid" alt="Haarlem In the summer" src="<?php echo $model[0]->getPageImage() ?>" />                    
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12 text-light pt-2">
                    <p class="fs-5"><?php echo $model[0]->getPageContent() ?></p>                   
                </div>
                <div class="col-sm-8 p-2">
                    <p class="text-start color-secondary">Food Event/Restaurants</p>
                </div>
                <div>
                    <h3 class="text-start text-center">See all participating restaurants below!</h3>
                </div>
            </div>
        </div>        
    </header>
    <!-- Filter -->
    <!-- <div class="card m-3">
        <div class="row">
            <div class="offset-xl-1 offset-lg-1 col-xl-10 col-lg-10 col-xs-12"> 
                <div class="card mx-auto">
                    <div class="row bg-dark-secondary text-light rounded  pt-3">
                        <div class="col-md-3 col-xs-12 pt-4">
                            <input class="form-text filter-text" placeholder="search..." type="text" />
                        </div>
                        <div class="col-md-3">
                            <div class="row">
                                <div class="col-3 text-end">
                                    <input id="foodCheckbox" class="form-check-input filter-checkbox" type="checkbox" onclick="validate()" />
                                </div>
                                <div class="col-9 text-start">
                                    <p class="fs-5">Dutch</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-3 text-end">
                                    <input id="foodCheckbox" class="form-check-input filter-checkbox" type="checkbox" onclick="validate()" />
                                </div>
                                <div class="col-9 text-start">
                                    <p class="fs-5">French</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="row">
                                <div class="col-3 text-end">
                                    <input id="foodCheckbox" class="form-check-input filter-checkbox" type="checkbox" onclick="validate()" />
                                </div>
                                <div class="col-9 text-start">
                                    <p class="fs-5">Argentinian</p>
                                </div>
                                </div>
                                <div class="row">
                                <div class="col-3 text-end">
                                    <input id="foodCheckbox" class="form-check-input filter-checkbox" type="checkbox" onclick="validate()" />
                                </div>
                                <div class="col-9 text-start">
                                    <p class="fs-5">Asian</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-sm-3 col-xs-12">
                            <div class="row">
                                <div class="col-3 text-end">
                                    <input id="foodCheckbox" class="form-check-input filter-checkbox" type="checkbox" onclick="validate()" />
                                </div>
                                <div class="col-9 text-start">
                                    <p class="fs-5">Italian</p>
                                </div>
                                </div>
                                <div class="row">
                                <div class="col-3 text-end">
                                    <input id="foodCheckbox" class="form-check-input filter-checkbox" type="checkbox" onclick="validate()" />
                                </div>
                                <div class="col-9 text-start">
                                    <p class="fs-5">European</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>  
        </div>
    </div>-->
    <hr class="text-secondary" />
    <!-- Restaurants -->
    <div class="card m-3">
        <div class="row">
            <?
            foreach ($model as $restaurant) {
            ?>
            <div class="col-xl-6 col-md-12 mb-4">
                <div class="card text-light h-100 bg-dark">
                    <!-- image, title and text -->
                    <div class="row p-3">
                        <div class="col-xl-4 col-lg-3 d-none d-lg-block">
                            <img src="<?php echo $restaurant->getImage() ?>" width="190" height="190" alt="">
                        </div>                                
                        <div class="col-xl-8 col-lg-9 col-xs-12">
                            <h4 class="font-ss"><?php echo $restaurant->getTitle() ?></h4>
                            <p class="card-text"><?php echo $restaurant->getContent() ?></p>
                        </div>
                    </div>
                    <!-- line below text and image -->
                    <div class="row mt-auto" style="margin-left: 0px;margin-right: 0px;">
                        <hr />
                    </div>
                    <!-- flags and buttons -->
                    <div class="row pb-3 mt-auto">
                        <div class="col-md-6">
                            <p class="m-3"><?php echo $restaurant->getCuisine() ?></p>                                
                        </div>
                        <div class="col-md-6 ">
                            <form method="POST" action="restaurant">
                                <input type="hidden" name="restaurant_id" value="<?php echo $restaurant->getId() ?>">
                                <button type="submit" class="btn btn-primary m-auto align-middle text-decoration-none text-light"><a class="btn btn-primary m-auto align-middle text-decoration-none text-light">View Info & Set Reservation</a></button>
                            </form>
                        </div>
                    </div>
                </div> 
            </div>
            <?
            }
            ?>  
        </div>
    </div>
    <div class="card m-2 pb-4 text-center">
        <h5 class="text-light">Keep up to date with the restaurants on Twitter!</h5>
        <div class="text-center">
            <a class="twitter-timeline" data-width="500" data-height="300" data-theme="dark" href="https://twitter.com/The_Haarlem_F">HaarlemFestival</a> 
            <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
        </div>
    </div>
    <div class="card bg-dark-secondary">
    <h5 class="text-light text-center">Share the Haarlem Festival Food Event on Social Media!</h5>
        <div class="row pb-3"> 
            <div class="col-6 text-center text-light">
                <button class="btn bg-dark">
                    <div class="pt-2">
                    <a href="https://twitter.com/share?ref_src=twsrc%5Etfw" class="twitter-share-button" data-size="large" data-text="I&#39;m going to the Haarlem Festival Food Event! " data-url="https://twitter.com/The_Haarlem_F" data-hashtags="HaarlemFoodEvent" data-show-count="false">Tweet</a>
                    <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script> 
                    </div>
                    
                </button>            
            </div>
            <div class="col-6 text-center text-light">    
                <button type="button" data-toggle="modal" data-target="#shareModal" class="fs-5 text-decoration-none btn bg-dark text-light">
                    <i class="fa fa-share-alt"></i> Share Food Event
                </button>
            </div>
        </div>
    </div>
</div>
<!-- Share modal, to share food event -->
<div class="modal fade" id="shareModal" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-dark">
            <div class="modal-header">
                <h5 class="modal-title text-light" id="exampleModalLongTitle">Share</h5>
                <button type="button lg" class="close btn text-light" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&#10006;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <i class="fa fa-instagram m-4"></i>
                    <i class="fa fa-facebook m-4"></i>
                    <i class="fa fa-twitter m-4"></i>
                    <i class="fa fa-share-alt m-4"></i>
                </div>
                <h5 class="text-light text-center fs-5 pt-3">Share the Food Event on social media!</h5>
            </div>
        </div>
    </div>
</div>