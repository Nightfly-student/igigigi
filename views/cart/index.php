<div class="container-xxl">
    <div class="row">
        <div class="col-xl-3 col-lg-4 col-md-0">

        </div>
        <div class="col-6-xl col-lg-4 col-md-12">
            <h1 class="text-center text-light p-4">Cart</h1>
        </div>
        <div class="col-xl-3 col-lg-4 col-md-12">

            <div class="container d-flex justify-content-center align-items-center p-4"">
                <div class=" progresses">
                <div class="steps active"> <span><i class="fa fa-cart-shopping"></i></span> </div> <span class="line"></span>
                <div class="steps"> <span><i class="fa fa-euro-sign"></i></span> </div> <span class="line"></span>
                <div class="steps"><span><i class="fa fa-check"></i></span></div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xl-8 col-lg-12">
        <?
        if ($model !== 'empty') {
            foreach ($model as $item) {
                
        ?>
                <div class="card bg-dark text-light m-3" id="<? echo $item->getId() ?>">
                    <div class="row no-gutters">
                        <div class="col-auto d-none d-md-block ">
                            <img src="<? echo $item->getImg() ?>" class="img-tickets" alt="">
                        </div>
                        <div class="col">
                            <div class="card-body px-3 flex-column d-flex h-100">
                                <div class="row ">
                                    <div class="col-11">
                                        <h4 class="pt-2 font-ss"><? echo $item->getTitle() ?></h4>
                                    </div>
                                    <div class="col-1">
                                        <i onclick="deletePopUp(<? echo $item->getId() ?>, '<? echo $item->getTitle() ?>')" class="fa fa-x fs-5 pt-2 text-danger ms-n2 cursor"></i>
                                    </div>
                                </div>
                                <p id="quantity<? echo $item->getId() ?>" class="p-0 m-0 fs-5">Quantity:
                                    <? echo $_SESSION['cart'][array_search($item->getId(), array_column($_SESSION['cart'], 'event'))]['adults'] ?> Adults
                                    <? if ($_SESSION['cart'][array_search($item->getId(), array_column($_SESSION['cart'], 'event'))]['children'] != 0) { ?> |
                                        <? echo $_SESSION['cart'][array_search($item->getId(), array_column($_SESSION['cart'], 'event'))]['children'] ?> Children <? } ?></p>
                                <p class="p-0 m-0 fs-5">Date: <? echo date_format(date_create($item->getDate()), ' l jS F') ?></p>
                                <p class="p-0 m-0 fs-5">Session: <? echo date_format(date_create($item->getDate()), 'H:i') ?></p>
                                <p class="p-0 m-0 fs-5">Duration: <? echo sprintf("%s:%s", date("H", strtotime($item->getDuration())), date("i", strtotime($item->getDuration()))) ?></p>
                                <p class="p-0 m-0 fs-5">Info: <? echo $item->getExtra() ?></p>

                                <div class="row align-items-center mt-auto">
                                    <div class="col-xl-4 col-md-4 col-sm-0">
                                    </div>
                                    <div class="col-xl-4 col-md-4 col-sm-6">
                                        <h5 id="total<? echo $item->getId() ?>" class="text-center align-middle pt-1">Total: <? echo number_format((($_SESSION['cart'][array_search($item->getId(), array_column($_SESSION['cart'], 'event'))]['adults']) + $_SESSION['cart'][array_search($item->getId(), array_column($_SESSION['cart'], 'event'))]['children']) * $item->getPrice(), 2, ',') ?>€</h5>
                                    </div>
                                    <div class="col-xl-4 col-md-4 col-sm-6 ">
                                        <button onclick="editPopUp(<? echo $item->getId() ?>, '<? echo $item->getTitle() ?>')" class="btn btn-primary ps-5 pe-5">Edit</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?
            }
        } else {
            ?>
            <div class="text-center">
                <h2>Looks Kinda Empty</h2>
                <a class="text-decoration-none text-dark" href="/tickets">Shop Now</a>
            </div>

        <?
        } ?>
        <div class="text-center">
            <a href="/checkout" id="checkout" role="button" class="m-3 btn btn-primary w-50">Checkout</a>
        </div>
    </div>
    <div class="col-xl-4 col-lg-12">
        <div class="card bg-dark m-3 text-light">
            <h2 class="pt-2 text-center">Suggestions</h2>
            <div class="row  m-3 ">
                <div class="mt-2 mb-2 col-xl-12 col-lg-4 col-md-6 col-sm-12">
                    <div class="card bg-dark-secondary">
                        <img src="https://picsum.photos/200" class="img-cart" />
                        <div class="row p-2">
                            <div class="col-8">
                                <p class="fs-5">
                                    Grand Cafe Brinkman
                                </p>
                            </div>
                            <div class="col-4">
                                <p class="text-end font-s fs-5">
                                    Haarlem
                                </p>
                            </div>
                        </div>
                        <div class="row p-2 justify-content-center align-items-center">
                            <div class="col-6">
                                <p class="m-0 p-0 fs-5 font-s">
                                    10,00€
                                </p>
                                <p class="m-0 p-0 fs-6 font-s">
                                    per reservation
                                </p>
                            </div>
                            <div class="col-6 text-end">
                                <button class="btn btn-primary">Add To Cart</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-2 mb-2 col-xl-12 col-lg-4 col-md-6 col-sm-12">
                    <div class="card bg-dark-secondary">
                        <img src="https://picsum.photos/200" class="img-cart" />
                        <div class="row p-2">
                            <div class="col-8">
                                <p class="fs-5">
                                    Grand Cafe Brinkman
                                </p>
                            </div>
                            <div class="col-4">
                                <p class="text-end font-s fs-5">
                                    Haarlem
                                </p>
                            </div>
                        </div>
                        <div class="row p-2 justify-content-center align-items-center">
                            <div class="col-6">
                                <p class="m-0 p-0 fs-5 font-s">
                                    10,00€
                                </p>
                                <p class="m-0 p-0 fs-6 font-s">
                                    per reservation
                                </p>
                            </div>
                            <div class="col-6 text-end">
                                <button class="btn btn-primary">Add To Cart</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-2 mb-2 col-xl-12 col-lg-4 col-md-6 col-sm-12">
                    <div class="card bg-dark-secondary">
                        <img src="https://picsum.photos/200" class="img-cart" />
                        <div class="row p-2">
                            <div class="col-8">
                                <p class="fs-5">
                                    Grand Cafe Brinkman
                                </p>
                            </div>
                            <div class="col-4">
                                <p class="text-end font-s fs-5">
                                    Haarlem
                                </p>
                            </div>
                        </div>
                        <div class="row p-2 justify-content-center align-items-center">
                            <div class="col-6">
                                <p class="m-0 p-0 fs-5 font-s">
                                    10,00€
                                </p>
                                <p class="m-0 p-0 fs-6 font-s">
                                    per reservation
                                </p>
                            </div>
                            <div class="col-6 text-end">
                                <button class="btn btn-primary">Add To Cart</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<script>
    var id = 0;
    var total = 0;
    var cart = [];

    var quantityAdult = 0;
    var quantityChildren = 0;

    var events = <?php echo json_encode($model) ?>;
    if (events !== 'empty') {
        cart = <?php echo json_encode($_SESSION['cart']) ?>;
        events.forEach(event => {
            if (cart.find((item) => parseInt(item.event) === event.event_session_id)) {
                var item = cart.find((item) => parseInt(item.event) === event.event_session_id);
                total += (item.adults + item.children) * event.price;
                console.log(total);
            }
        });
        document.getElementById("checkout").innerHTML = `Checkout (${total.toFixed(2).toString().replace('.', ',')}€)`
    } else {
        document.getElementById("checkout").style.visibility = 'hidden';
    }

    function deletePopUp(eventId, eventTitle) {
        id = eventId;
        $("#deleteModal").modal('show');
        document.getElementById("title").innerHTML = 'About to Delete: ' + eventTitle;
    }

    function editPopUp(eventId, evenTitle) {
        id = eventId;

        var event = events.find((event) => event.event_session_id === id);
        var cartItem = cart.find((item) => item.event === event.event_session_id);

        quantityAdult = cartItem.adults;
        quantityChildren = cartItem.children;

        document.getElementById("iAdult").value = quantityAdult;
        document.getElementById("iChildren").value = quantityChildren;
        $("#editQuantity").modal('show');
    }

    async function updateEvent() {
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
        var result = await fetch(`/api/tickets/updateEvent`, {
            method: 'PUT',
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify({
                id: id,
                adults: parseInt(quantityAdult),
                children: parseInt(quantityChildren),
            }),
        });
        var response = await result.json();

        if (result.status === 200) {
            $("#editQuantity").modal('hide');
            if (quantityChildren !== 0) {
                document.getElementById("quantity" + id).innerHTML = `Quantity: ${quantityAdult} Adults | ${quantityChildren} Children`;
            } else {
                document.getElementById("quantity" + id).innerHTML = `Quantity: ${quantityAdult} Adults`;
            }
            var event = events.find((event) => event.event_session_id === id);
            var totalEventPrice = ((parseInt(quantityAdult) + parseInt(quantityChildren)) * event.price);
            document.getElementById("total" + id).innerHTML = `Total: ${totalEventPrice.toFixed(2).toString().replace('.', ',')}€`;
            total = totalEventPrice;
            events.forEach(e => {
                if (e.event_session_id != id) {
                    var item = cart.find((item) => item.event === e.event_session_id);
                    console.log(item);
                    total += (item.adults + item.children) * e.price;
                }
            });
            document.getElementById("checkout").innerHTML = `Checkout (${total.toFixed(2).toString().replace('.', ',')}€)`
        }

        if (result.status === 409) {
            document.getElementById("errorMessage").innerHTML = "Not enough tickets available"
            setTimeout(() => {
                document.getElementById("errorMessage").innerHTML = ""
            }, 2000);
        }
    }

    async function deleteEvent() {
        $("#deleteModal").modal('hide');
        try {
            var result = await fetch(`/api/tickets/deleteEvent`, {
                method: 'DELETE',
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({
                    id: id,
                }),
            });
            var response = await result.json();
            document.getElementById(id).setAttribute('class', 'd-none');

            var event = events.find((event) => event.event_session_id === id);
            var cartItem = cart.find((item) => item.event === event.event_session_id);
            total -= (cartItem.adults + cartItem.children) * event.price
            if (total !== 0) {
                document.getElementById("checkout").innerHTML = `Checkout (${total.toFixed(2).toString().replace('.', ',')}€)`
            } else {
                document.getElementById("checkout").style.visibility = 'hidden';
            }

        } catch (err) {
            console.warn(err);
        }
    }

    function adultKeeper(value) {
        quantityAdult = value;
    }

    function childKeeper(value) {
        quantityChildren = value;
    }
</script>

<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h3 class="text-light w-100">Are you sure?</h3>
                </button>
            </div>
            <p class="ps-4 text-light" id="title"></p>
            <div class="modal-footer">
                <button type="button" class="btn btn1 btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" onclick="deleteEvent()" class="btn btn1 btn-primary">Delete</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editQuantity" tabindex="-1" role="dialog" aria-labelledby="setQuantity" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h3 class="text-light w-100">Update People?</h3>
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
                <button type="button" onclick="updateEvent()" class="btn btn1 btn-primary">Update Quantity</button>
            </div>
        </div>
    </div>
</div>