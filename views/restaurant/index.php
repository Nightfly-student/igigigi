<? $restaurant = $model[0]; ?>
<div class="container-xxl">
    <div class="pt-2">
        <a class="fs-5 text-start text-decoration-none nounderline text-light" href="/food"><i class="fas fa-arrow-left"></i> Back to Food Event</a>
    </div>
    <header class="row text-center">
        <div class="col-xl-12 text-light">        
            <h1 class="p-4"><?php echo $restaurant->getTitle() ?></h1>
            <div class="row p-3">
                <div class="col-lg-7 col-md-6 col-sm-12 text-center">
                    <img class="img-fluid" alt="<?php echo $restaurant->getTitle() ?>" style="max-height:250px;" src="<?php echo $restaurant->getImage() ?>" />                    
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12 text-light pt-2">
                    <p class="fs-5 text-start"><?php echo $restaurant->getContent() ?></p>   
                    <p class="fs-5 text-start">Location: <?php echo $restaurant->getLocation() ?></p>
                    <p class="fs-5 text-start">Cuisine: <?php echo $restaurant->getCuisine() ?></p>          
                </div>
                <div class="col-sm-8 p-2">
                    <p class="text-start color-secondary">Food Event/Restaurants/<?php echo $restaurant->getTitle() ?></p>
                </div>
                <div class="row p-4">
                    <div class="col-8">
                        <p class="fs-5">Reservation costs &euro;10 per person. This will be reduced from the restaurant bill.</p>
                    </div>
                    <div class="col-4">
                        <button onclick="idKeeper(<? echo $restaurant->getEventSessionId() ?>, '<? echo $restaurant->getCategory() ?>', '<? echo $restaurant->getAmount() ?>')" class="btn btn-primary m-auto align-middle fs-5 text-center">Set Reservation</button>
                    </div>
                </div>
            </div>
        </div>    
    </header>
    <hr class="text-secondary" /> 
</div>


<!-- ADD TO CART CODE BY JELLE - FROM THE TICKET PAGE - EDIT BY WERNO FOR RESERVATION -->
<script type=text/javascript>
    var id = 0;
    var category = '';
    var quantityAdult = 0;
    var quantityChildren = 0;
    var amountAvailable = 0;
    var ticketsAvailable = [];

    function idKeeper(event_session_id, event_category, amount_available) {
        $("#setQuantity").modal('show');
        id = event_session_id;
        category = event_category;
        amountAvailable = amount_available;
    }

    function adultKeeper(value) {
        quantityAdult = value;
    }

    function childKeeper(value) {
        quantityChildren = value;
    }

    const addToCart = async () => 
    {
        var event_session_id = $("#selectsession").val();
        
        if (quantityAdult === 0 && quantityChildren === 0) {
            document.getElementById("errorMessage").innerHTML = "Please Give Quantity"
            setTimeout(() => {
                document.getElementById("errorMessage").innerHTML = ""
            }, 2000);
            return;
        }
        if (quantityAdult === 0) {
            document.getElementById("errorMessage").innerHTML = "Children are not allowed to go alone"
            setTimeout(() => {
                document.getElementById("errorMessage").innerHTML = ""
            }, 2000);
            return;
        }
        if (amountAvailable < (parseInt(quantityAdult) + parseInt(quantityChildren))) {
            document.getElementById("errorMessage").innerHTML = "Not enough tickets available"
            setTimeout(() => {
                document.getElementById("errorMessage").innerHTML = ""
            }, 2000);
            return;
        }
        if (ticketsAvailable.find((events) => events.eventId === id)) {
            if (ticketsAvailable.find((events) => events.available < (parseInt(quantityAdult) + parseInt(quantityChildren)))) {
                document.getElementById("errorMessage").innerHTML = "Not enough tickets available"
                setTimeout(() => {
                    document.getElementById("errorMessage").innerHTML = ""
                }, 2000);
                return;
            }
        }
        try {
            const data = {
                result: event_session_id,
                adults: parseInt(quantityAdult),
                children: parseInt(quantityChildren),
                category: category,
            };
            var result = await fetch('/api/tickets', {
                method: 'POST',
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({
                    data
                })
            })
            var response = await result.json();
            console.log(response);
            $("#setQuantity").modal('hide');
            setTimeout(() => { $('#gotoshoppingModal').modal("show");});
        } catch (error) {
            console.warn(error);
        }
    };
</script>

<!-- Add Reservation Modal -->
<div class="modal fade" id="setQuantity" role="dialog" aria-labelledby="setQuantity" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="text-light text-center">Set Reservation</h4>
                </button>
            </div>
            <p class="text-center text-danger m-0 p-0" id="errorMessage"></p>
            <div class="modal-body text-light">
                <div class="row text-center">
                    <div class="col-3">
                    </div>
                    <div class="col-3">
                        <h5>Adults</h5>
                    </div>
                    <div class="col-6">
                        <input class="popupnumber" autocomplete="off" type="number" onchange="adultKeeper(this.value)" id="iAdult" min="0" value="0" name="iAdult"><br>
                    </div>
                </div>
                <div class="row text-center">
                    <div class="col-3">
                    </div>
                    <div class="col-3">
                        <h5>Children</h5>
                    </div>
                    <div class="col-6">
                        <input class="popupnumber" autocomplete="off" type="number" onchange="childKeeper(this.value)" id="iChildren" min="0" value="0" name="iChildren"><br>
                    </div>
                </div>
                <div class="col-12 text-center">
                    <label class="col-form-label text-start fs-4">Available Dates and Times </label>
                        <select id="selectsession" name="event_session_id" class="custom-select text-end text-center fs-5 " required="required">
                            <?php
                            foreach ($model as $session) 
                            { ?>
                            <option value="<?php echo $session->getEventSessionId() ?>"><? echo date_format(date_create($session->getDatetime()), ' l jS F - H:i:s') ?></option>
                            
                            <? } ?>
                        </select>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="addToCart()" class="btn btn1 btn-primary">Add to Cart</button>
            </div>
        </div>
    </div>
</div>

<!-- Added to cart modal -->
<div class="modal fade" id="gotoshoppingModal" role="dialog" aria-labelledby="gotoshoppingModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close-button topright" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body modal-text1">
                Added to the cart!
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn1 btn-primary p-2" data-bs-dismiss="modal">Continue Shopping</button>
                <button type="button" class="btn btn1 btn-primary p-2" onclick="location.href = 'cart' ">Go to Cart</button>
            </div>
        </div>
    </div>
</div>