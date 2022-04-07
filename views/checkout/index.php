<div class="container-xxl">
    <div class="row">
        <div class="col-xl-3 col-lg-4 col-md-0">

        </div>
        <div class="col-6-xl col-lg-4 col-md-12">
            <h1 class="text-center text-light p-4">Checkout</h1>
        </div>
        <div class="col-xl-3 col-lg-4 col-md-12">

            <div class="container d-flex justify-content-center align-items-center p-4"">
                <div class=" progresses">
                <div class="steps active"> <span><i class="fa fa-cart-shopping"></i></span> </div> <span class="line active"></span>
                <div class="steps active"> <span><i class="fa fa-euro-sign"></i></span> </div> <span class="line"></span>
                <div class="steps"><span><i class="fa fa-check"></i></span></div>
            </div>
        </div>
    </div>
</div>
<div class="container-lg">
    <form method="POST" class="needs-validation form">
        <div class="row row-eq-height mb-5">
            <div class="col-xl-8 col-md-12">
                <div class="card text-light bg-dark p-4 m-1 h-100">
                    <div class="row">
                        <div class="col-5">
                            <p class="fs-4 font-s pt-1 m-0 ">Name *</p>
                            <input type="text" id="fname" name="fname" class="form-text form-checkout-input-text req" placeholder="First name" required />
                        </div>
                        <div class="col-5 mt-auto">
                            <input type="text" id="lname" name="lname" class="form-text form-checkout-input-text" placeholder="Last name" required />
                        </div>
                        <div class="col-2">
                        </div>
                    </div>
                    <p class="fs-4 font-s pt-1 m-0">Birthday *</p>
                    <input type="text" id="bday" name="bday" class="form-text form-checkout-input-text req" placeholder="Birthdate" required />

                    <div class="row">
                        <div class="col-5">
                            <p class="fs-4 font-s pt-1 m-0">Email address *</p>
                            <input type="email" id="mail" name="mail" pattern="[^ @]*@[^ @]*" class="form-text form-checkout-input-text req" placeholder="Email" required />
                        </div>
                        <div class="col-5">
                            <p class="fs-4 font-s pt-1 m-0">Phone number</p>
                            <input id="phone" name="phone" type="tel" class="form-text form-checkout-input-text" placeholder="+31 1234 56789" name="phone" />
                        </div>
                        <div class="col-2">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-5">
                            <p class="fs-4 font-s pt-1 m-0">Country *</p>
                            <select data-default="NL" id="country" name="country" class="req form-select form-select-checkout selectpicker countrypicker" required></select>
                        </div>
                        <div class="col-5">
                            <p class="fs-4 font-s pt-1 m-0">Province</p>
                            <input type="text" id="province" name="province" class="form-text form-checkout-input-text" placeholder="State/Province" />
                        </div>
                        <div class="col-2">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-5">
                            <p class="fs-4 font-s pt-1 m-0">Street Name *</p>
                            <input type="text" id="street" name="street" class="req form-text form-checkout-input-text" placeholder="Street Name" required />
                        </div>
                        <div class="col-5">
                            <p class="fs-4 font-s pt-1 m-0">House Number *</p>
                            <input type="text" id="house" name="house" class="req form-text form-checkout-input-text form-house" placeholder="00" required />
                        </div>
                        <div class="col-2">
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-xl-4 col-md-12">
                <div class="card text-light bg-dark p-4 h-100 m-1">
                    <h3 class="text-center">Payment Method *</h3>
                    <div class="row pt-4">
                        <div class="col-2">
                        </div>
                        <div class="col-10">
                            <div class="form-check py-1 d-flex align-items-center">
                                <input class="form-check-input me-4 fs-5" type="radio" value="ideal" name="payment" id="pay1" required>
                                <label class="form-check-label fs-5 ms-4 ps-4" for="flexRadioDefault1">
                                    <img height="50" src="/images/ideal.png"></img>
                                </label>
                            </div>
                            <div class="form-check py-1 d-flex align-items-center">
                                <input class="form-check-input me-4 fs-5" type="radio" value="paypal" name="payment" id="pay2" required>
                                <label class="form-check-label fs-5 ms-4 ps-4" for="flexRadioDefault2">
                                    <img height="50" src="/images/paypal.png"></img>
                                </label>
                            </div>
                            <div class="form-check py-1 d-flex align-items-center">
                                <input class="form-check-input me-4  fs-5" type="radio" value="creditcard" name="payment" id="pay3" required>
                                <label class="form-check-label fs-5 ms-4 ps-4" for="flexRadioDefault3">
                                    <img height="50" src="/images/credit.png"></img>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="mt-auto">
                        <div class="row">
                            <div class="col-2"></div>
                            <div class="col-5">
                                <p class="fs-5 font-s">
                                    Subtotal:
                                </p>
                            </div>
                            <div class="col-5">
                                <span id="subtotal" class="fs-5 font-ss text-end">NAN</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-2"></div>
                            <div class="col-5">
                                <p class="fs-5 font-s">
                                    Vat 9%:
                                </p>
                            </div>
                            <div class="col-5">
                                <span id="vat" class="fs-5 font-ss">NAN</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-2"></div>
                            <div class="col-5">
                                <p class="fs-5 font-s">
                                    Total:
                                </p>
                                <input type="hidden" id="totalPrice" name="totalPrice" required />
                                <input type="hidden" id="description" name="description" required />
                            </div>
                            <div class="col-5">
                                <span id="total" class="fs-5 font-ss">NAN</span>
                            </div>
                        </div>
                    </div>
                    <button type="submit" disabled="disabled" id="sub" class="btn btn-primary w-75 mt-0 mx-auto">Pay Now</button>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    var total = 0;

    var events = <?php echo json_encode($model) ?>;
    if (events !== 'empty') {
        cart = <?php echo json_encode($_SESSION['cart']) ?>;
        events.forEach(event => {
            if (cart.find((item) => parseInt(item.event) === event.event_session_id)) {
                var item = cart.find((item) => parseInt(item.event) === event.event_session_id);
                total += (item.adults + item.children) * event.price;

                if(event.category === 'food') {
                    document.getElementById("description").value += `1x Reservation for ${event.title} at ${event.date_time}`
                } else {
                    document.getElementById("description").value += `${(item.adults + item.children)}x for ${event.title} at ${event.date_time}`
                }
            }
            
        });
        document.getElementById("subtotal").innerHTML = `${(total - (total / 100 * 9)).toFixed(2).toString().replace('.', ',')}€`
        document.getElementById("vat").innerHTML = `${(total / 100 * 9).toFixed(2).toString().replace('.', ',')}€`
        document.getElementById("total").innerHTML = `${total.toFixed(2).toString().replace('.', ',')}€`
        document.getElementById("totalPrice").value = `${total.toFixed(2).toString()}`
    }


    var submit_button = document.getElementById("sub");

    submit_button.addEventListener("click", function(e) {
        var required = document.querySelectorAll("input[required]");

        required.forEach(function(element) {
            if (element.value.trim() == "") {
                element.style.border = "1px solid red";
            } else {
                element.style.border = "none";
            }
        });
    });

    (function() {
        $('input').keyup(function() {
            var empty = false;
            $('req[required]').each(function() {
                if ($(this).val() == '') {
                    empty = true;
                }
            });
            if (empty) {
                $('#sub').attr('disabled', 'disabled');
            } else {
                $('#sub').removeAttr('disabled');
            }
        });
    })()
</script>

<!-- Country Select Form -->
<script src="//unpkg.com/bootstrap-select-country@4.0.0/dist/js/bootstrap-select-country.min.js"></script>