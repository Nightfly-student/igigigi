<div class="container-xxl">
    <header class="row text-center">
        <div class="col-xl-12 text-light">
            <h1 class="p-4"><?php echo $model[3][0]->getDancePageTitle()?></h1>
            <img class="img-fluid" alt="Haarlem Dance Event Header" src="<?php echo $model[3][0]->getDancePageImage()   ?>" />
        </div>
    </header>
    <div class="row">
        <div class="col-xl-10 col-sm-12 p-2">
            <p class="text-start color-secondary">Dance Event/event info</p>
        </div>
        <div class="col-xl-2 col-sm-12 p-4">
            <button onclick="location.href='/tickets?event=dance'" class="btn btn-primary btn-lg mx-auto">Buy Tickets</button>
        </div>
    </div>
    <div class="text-light">
            <h2><?php echo $model[0][0]->getItemTitle() ?></h2>
             <?php echo $model[0][0]->getItemContent() ?>

             <h2><?php echo $model[0][1]->getItemTitle() ?></h2>
             <?php echo $model[0][1]->getItemContent() ?>

            <ul>
            <?php
            foreach($model[2] as $club){
                ?>
                <li><?php echo $club->getName() ?></li>
                <?php
            }
            ?>
            </ul>

        <h2>Artists</h2>
        <div class="row">
        <?php
        foreach ($model[1] as $artist) {
                    ?>
            <div class="col-xl-6 col-sm-12">
                <div class="card p-2">
                    <img class="img-dance card-img-top" src="<?php echo $artist->getImage() ?>" alt="<?php echo $artist->GetInformation() ?>" />
                    <div class="card-body bg-dark-secondary">
                    <h3 class="m-auto width-event text-center"><?php echo $artist->getName() ?></h3>
                    </div>
                </div>
            </div>
                    <?
                    }
                    ?>
        </div>

            <h2><?php echo $model[0][2]->getItemTitle() ?></h2>
            <?php echo $model[0][2]->getItemContent() ?>
        </div>
</div>