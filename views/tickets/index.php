<div class="container-xxl">
    <h1 class="text-center text-light p-4">Tickets</h1>
    <div class="row">
        <div class="col-xl-3 d-none d-xl-block">
            <div class="card text-light bg-dark p-2 m-2 mb-4">
                <h2 class="text-center">Filters</h2>
                <input class="form-text filter-text" id="search" onkeypress="searchEvent(event)" placeholder="search..." type="text" />
                <h2 class="text-center p-2">Event</h2>
                <div class="row">
                    <div class="col-3 text-end">
                        <input id="foodCheckbox" class="form-check-input filter-checkbox" type="checkbox" onclick="validate()" />
                    </div>
                    <div class="col-9 text-start">
                        <p class="fs-5">Food</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-3 text-end">
                        <input id="historicCheckbox" class="form-check-input filter-checkbox" onclick="validate()" type="checkbox" />
                    </div>
                    <div class="col-9 text-start">
                        <p class="fs-5">Historic</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-3 text-end">
                        <input id="danceCheckbox" class="form-check-input filter-checkbox" type="checkbox" onclick="validate()" />
                    </div>
                    <div class="col-9 text-start">
                        <p class="fs-5">Dance</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 d-xl-none text-light">
            <h3 class="text-end me-4 cursor" data-toggle="modal" data-target="#exampleModal">Filters</h3>
        </div>
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body text-light bg-dark border-0">
                        <h2 class="text-center">Filters</h2>
                        <input class="form-text filter-text m-auto position-relative d-block" onkeypress="searchEvent(event)" placeholder="search..." type="text" />
                        <h2 class="text-center p-2">Event</h2>
                        <div class="row">
                            <div class="col-3 text-end">
                                <input id="foodCheckboxModal" class="form-check-input filter-checkbox" type="checkbox" onclick="validate()" />
                            </div>
                            <div class="col-9 text-start">
                                <p class="fs-5">Food</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-3 text-end">
                                <input id="historicCheckboxModal" class="form-check-input filter-checkbox" onclick="validate()" type="checkbox" />
                            </div>
                            <div class="col-9 text-start">
                                <p class="fs-5">Historic</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-3 text-end">
                                <input id="danceCheckboxModal" class="form-check-input filter-checkbox" type="checkbox" onclick="validate()" />
                            </div>
                            <div class="col-9 text-start">
                                <p class="fs-5">Dance</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-9 col-lg-12 ">
            <div class="row">
                <? foreach ($model as $event) {
                ?>
                    <div class="col-12 mt-3 mb-3 filterDiv <? echo $event->getCategory() ?>" id="<? echo $event->getId() ?>">
                        <div class="card bg-dark text-light h-100">
                            <div class="row no-gutters">
                                <div class="col-auto d-none d-md-block ">
                                    <img src="<? echo $event->getImg() ?>" class="img-tickets" alt="">
                                </div>
                                <div class="col">
                                    <div class="card-body flex-column d-flex px-1 h-100">
                                        <div class="row">
                                            <div class="col-md-6 col-sm-8">
                                                <h4 class="pt-2 font-ss"><? echo $event->getTitle() ?></h4>
                                            </div>
                                            <div class="col-md-6 col-sm-4 ">
                                                <p class="text-end pt-2 pe-2"><? echo date_format(date_create($event->getDate()), ' l jS F') ?> </p>
                                            </div>
                                        </div>
                                        <div class="row text-center ">
                                            <div class="col-md-6 text-start">
                                                <p class="font-s">Location: <? echo $event->getLocation() ?></p>
                                            </div>
                                            <div class="col-md-6 text-start">
                                                <p class="font-s">Duration: <? echo sprintf("%s:%s", date("H", strtotime($event->getDuration())), date("i", strtotime($event->getDuration())))  ?> Hours</p>
                                            </div>
                                        </div>
                                        <p class="card-text"><? echo $event->getContent() ?></p>
                                        <div class="row align-items-center mt-auto">
                                            <div class="col-md-6">
                                                <? if ($event->getCategory() === 'historic') {
                                                ?>
                                                    <p class=""><? echo $event->getExtra() ?> Tour</p>
                                                <?
                                                }
                                                if ($event->getCategory() === 'food') {
                                                ?>
                                                    <p class="">Cuisine: <? echo $event->getExtra() ?></p>
                                                <?
                                                }
                                                if ($event->getCategory() === 'dance') {
                                                ?>
                                                    <p class="">Session: <? echo $event->getExtra() ?></p>
                                                <?
                                                }
                                                ?>
                                            </div>
                                            <div class="col-md-3">
                                                <p class="fs-4 p-0 m-0"><? echo number_format($event->getPrice(), 2, ',') ?>€</p>
                                                <p class="p-0 m-0">per person</p>
                                            </div>
                                            <div class="col-md-3">
                                                <button onclick="idKeeper(<? echo $event->getId() ?>, '<? echo $event->getCategory() ?>', <? echo $event->getAmount() ?>)" class="btn btn-primary m-auto align-middle">Add To Cart</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?
                }
                ?>
            </div>
        </div>
    </div>
</div>

<script type=text/javascript>
    const urlSearchParams = new URLSearchParams(window.location.search);
    const params = Object.fromEntries(urlSearchParams.entries());
    if (params.event) {
        //checked bug//
        $(".dance").attr("class", "d-none dance");
        $(".historic").attr("class", "d-none historic");
        $(".food").attr("class", "d-none food");
        $(`.${params.event}`).attr("class", `d-unset mt-3 mb-3 ${params.event}`);
    }
    var id = 0;
    var category = '';
    var quantityAdult = 0;
    var quantityChildren = 0;
    var amountAvailable = 0;
    var ticketsAvailable = [];
    document.querySelectorAll('input[type=checkbox]').forEach(el => el.checked = false);

    function validate() {
        if (!document.getElementById("foodCheckbox").checked &&
            !document.getElementById("danceCheckbox").checked &&
            !document.getElementById("historicCheckbox").checked) {

            $(".dance").attr("class", "d-unset mt-3 mb-3 dance");
            $(".historic").attr("class", "d-unset mt-3 mb-3 historic");
            $(".food").attr("class", "d-unset mt-3 mb-3 food");

        } else {
            $(".dance").attr("class", "d-none dance");
            $(".historic").attr("class", "d-none historic");
            $(".food").attr("class", "d-none food");

        }

        if (document.getElementById("foodCheckbox").checked || document.getElementById("foodCheckboxModal").checked) {
            $(".food").attr("class", "d-unset mt-3 mb-3 food");
        }

        if (document.getElementById("historicCheckbox").checked || document.getElementById("historicCheckboxModal").checked) {
            $(".historic").attr("class", "d-unset mt-3 mb-3 historic");
        }
        if (document.getElementById("danceCheckbox").checked || document.getElementById("danceCheckboxModal").checked) {
            $(".dance").attr("class", "d-unset mt-3 mb-3 dance");

        }
    }

    function searchEvent(event) {
        var events = eval('(<?php echo json_encode($model) ?>)');
        var query = document.getElementById("search").value;

        if (event.keyCode === 13) {
            event.preventDefault();
            console.log(query.length);
            events.forEach(event => {
                if (query.length !== 0) {
                    if (event.title.toLowerCase().includes(query.toLowerCase()) || event.body.toLowerCase().includes(query.toLowerCase())) {
                        console.log('found');
                    } else {
                        document.getElementById(event.event_session_id).setAttribute("class", "d-none");
                    }
                } else {
                    document.getElementById(event.event_session_id).setAttribute("class", `d-unset mt-3 mb-3 ${event.category}`);
                }
            });
            if (query.length === 0) {
                validate();
            }
        }
    }

    function idKeeper(event_id, event_category, event_amount_available) {
        $("#setQuantity").modal('show');
        id = event_id;
        category = event_category;
        amountAvailable = event_amount_available;
    }

    function adultKeeper(value) {
        quantityAdult = value;
    }

    function childKeeper(value) {
        quantityChildren = value;
    }

    const addToCart = async () => {

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
                result: id,
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
            if (result.status === 200) {
                $("#setQuantity").modal('hide');
                setTimeout(() => {
                    $('#gotoshoppingModal').modal("show");
                }, 100);
                if (ticketsAvailable.find((events) => events.eventId === id)) {
                    var index = ticketsAvailable.findIndex((events) => events.eventId === id);
                    ticketsAvailable[index].available -= (parseInt(quantityChildren) + parseInt(quantityAdult));
                } else {
                    ticketsAvailable.push({
                        eventId: id,
                        available: (amountAvailable - (parseInt(quantityChildren) + parseInt(quantityAdult)))
                    });
                }
            }
            if (result.status === 409) {
                document.getElementById("errorMessage").innerHTML = "Not enough tickets available"
                setTimeout(() => {
                    document.getElementById("errorMessage").innerHTML = ""
                }, 2000);
            }
        } catch (error) {
            console.warn(error);
        }
    };
</script>

<div class="modal fade" id="gotoshoppingModal" tabindex="-1" role="dialog" aria-labelledby="gotoshoppingModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close-button topright" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body modal-text1">
                Added to the Cart
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn1 btn-primary" data-bs-dismiss="modal">Continue Shopping</button>
                <button type="button" class="btn btn1 btn-primary" onclick="location.href = 'cart' ">Go to Cart</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="setQuantity" tabindex="-1" role="dialog" aria-labelledby="setQuantity" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h3 class="text-light w-100">How Many People?</h3>
                </button>
            </div>
            <p class="text-center text-danger m-0 p-0" id="errorMessage"></p>
            <div class="modal-body text-light">
                <div class="row text-center w-100">
                    <div class="col-3">
                    </div>
                    <div class="col-3">
                        <h2>Adults</h2>
                    </div>
                    <div class="col-6">
                        <input class="popupnumber" autocomplete="off" type="number" onchange="adultKeeper(this.value)" id="iAdult" min="0" value="0" name="iAdult"><br>
                    </div>
                </div>
                <div class="row text-center w-100">
                    <div class="col-3">
                    </div>
                    <div class="col-3">
                        <h2>Children</h2>
                    </div>
                    <div class="col-6">
                        <input class="popupnumber" autocomplete="off" type="number" onchange="childKeeper(this.value)" id="iChildren" min="0" value="0" name="iChildren"><br>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="addToCart()" class="btn btn1 btn-primary">Add to Cart</button>
            </div>
        </div>
    </div>
</div>