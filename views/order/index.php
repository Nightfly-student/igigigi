<div>
    <div class="container-xxl">
        <div class="row">
            <div class="col-xl-3 col-lg-4 col-md-0">

            </div>
            <div class="col-6-xl col-lg-4 col-md-12">
                <h1 class="text-center text-light p-4">Your Order</h1>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-12">

                <div class="container d-flex justify-content-center align-items-center p-4"">
                <div class=" progresses">
                    <div class="steps active"> <span><i class="fa fa-cart-shopping"></i></span> </div> <span class="line active"></span>
                    <div class="steps active"> <span><i class="fa fa-euro-sign"></i></span> </div> <span class="line active"></span>
                    <div class="steps active"><span><i class="fa fa-check"></i></span></div>
                </div>
            </div>
        </div>

        <?
        if (is_string($model)) {
        ?>
            <h2>$model</h2>
        <?
        }
        if (count($model) > 0) {
        ?>
        <div>
        <h1 class="text-center fs-3 text-light p-4">Your payment has been processed with success!</h1>
            <form method="post" class="text-center">
                <button class="btn btn-primary fs-3 m-4 " name="createPDF" value="1">Download E-Tickets</button>
            </form>
            <form method="post" class="text-center">
                <button class="btn btn-primary fs-3 m-4 " name="createInvoice" value="1">Download Invoice</button>
            </form>
        </div>
        <?
        }
        ?>
    </div>
</div>

<script>
    var events = <?php echo json_encode($model) ?>;

    async function createPDF() {
        try {
            var result = await fetch('/api/order/pdf', {
                method: 'POST',
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({
                    events
                })
            })
            var response = await result.json();
            console.log(response);
        } catch (err) {
            console.warn(err);
        }

    }
</script>