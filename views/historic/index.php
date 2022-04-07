<?php
$index = 1;
$page = $model[$index - 1];

if (isset($_REQUEST['index'])) {
    $index = $_REQUEST['index'];
    $page = $model[$index - 1];
}

?>

<div class="container-xxl">
    <header class="row text-center">
        <div class="col-xl-12 text-light">
            <h1 class="p-4">Historic Event</h1>
            <img class="img-fluid" alt="Haarlem In the summer" src="/images/header.jpg" />
            <div class="row p-3">
                <div class="col-sm-9">
                    <div class="row">
                        <div class="col-sm-8 p-2">
                            <p class="text-start color-secondary">Historic Event/<?php echo $page->getTitle() ?></p>
                        </div>
                        <div class="col-sm-4 p-2">
                            <button onclick="window.location.href='/tickets?event=historic'" class="btn btn-primary btn-lg">Book Tour</button>
                        </div>
                        <div class="col-sm-12 p-2 text-start">
                            <div id="content">
                                <h2><?php echo $page->getTitle() ?></h2>
                                <?php echo $page->getContent() ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3 p-3">
                    <?
                    foreach ($model as $location) {
                    ?>
                        <div class="inline-row text-start p-2">
                            <p class="text-start"><?php echo $location->getTitle() ?></p>
                            <button onclick="onClickFunction(<? echo $location->getId() ?>)" type="button" class="<? if ($location->getId() === $page->getId()) { ?>active-secondary<? } ?> float-end btn btn-light btn-circle">
                            </button>
                        </div>
                    <?
                    }
                    ?>
                    <p class="p-2">Click on circle to learn more</p>
                </div>
            </div>
        </div>
    </header>
</div>
<div class="col-sm-12">
    <div id="googleMap" style="width:100vw;height:350px;"></div>
</div>

<script>
    var gpsmap = '<?php echo $page->getGps(); ?>';
    var data = gpsmap.split(',');

    function myMap() {
        var mapProp = {
            mapId: "9ff78ee7c45ea783",
            center: {
                lat: parseFloat(data[0]),
                lng: parseFloat(data[1])
            },
            zoom: parseFloat(data[2]),
        };
        var map = new google.maps.Map(document.getElementById("googleMap"), mapProp);

        new google.maps.Marker({
            position: {
                lat: parseFloat(data[0]),
                lng: parseFloat(data[1])
            },
            map,
        });
    }

    function onClickFunction(id) {
        location.href = 'historic?index=' + id;
    };
</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAbWTgsTsywIU98EcB23pJ_y1qZ7U3eSLw&callback=myMap" async></script>