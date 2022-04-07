<div class="modal fade" id="createSessionModal" tabindex="1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="row d-flex justify-content-center">

                <div class="col-xl-5 col-sm-10 formBackground text-center">
                    <div class="col-xl-12" id="createSessionError">
                        <p id="createSessionErrorMessage"></p>
                    </div>
                    <h2 class="mt-2" id="">Create Session</h2>
                    <form id="createSessionForm" method="POST">
                        <div class="form-group row d-flex justify-content-start text-left mb-2">
                            <div class="col-xl-3">

                                <label for="restaurantName" class="col-form-label">Restaurant</label>
                            </div>
                            <div class="col-xl-8">
                                <select id="restaurant" name="restaurant" class="input-block-level text-dark">
                                    <?php
                                        foreach ($model['sessions'] as $sessions) {
                                    ?>
                                    <option value="<?php echo $sessions->getId()?>"><?php echo $sessions->getTitle()?></option>

                                    <?php
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row d-flex justify-content-start text-left mb-2">
                            <div class="col-xl-3">

                                <label for="programmeTitle" class="col-form-label">Title</label>
                            </div>
                            <div class="col-xl-8">
                                <input type="text" name="title" class="input-block-level text-light" placeholder="Title">
                            </div>
                        </div>
                        <div class="form-group row d-flex justify-content-start text-left mb-2">
                            <div class="col-xl-3">

                                <label for="programmeDateTime" class="col-form-label">Date/Time</label>
                            </div>
                            <div class="col-xl-8">
                                <input type="text" name="datetime" class="input-block-level text-light" placeholder="yyyy-mm-dd HH:MM:SS">
                            </div>
                        </div>
                        <div class="form-group row d-flex justify-content-start text-left mb-2">
                            <div class="col-xl-3">

                                <label for="programmePrice" class="col-form-label">Price</label>
                            </div>
                            <div class="col-xl-8">
                                <input type="text" name="price" class="input-block-level text-light" placeholder="Price">
                            </div>
                        </div>
                        <div class="form-group row d-flex justify-content-start text-left mb-2">
                            <div class="col-xl-3">

                                <label for="programmeAvailable" class="col-form-label">Tickets available</label>
                            </div>
                            <div class="col-xl-8">
                                <input type="text" name="ticketsavailable" class="input-block-level text-light" placeholder="Tickets available">
                            </div>
                        </div>
                        <div class="form-group row d-flex justify-content-start text-left mb-2">
                            <div class="col-xl-3">

                                <label for="programmeDuration" class="col-form-label">Duration</label>
                            </div>
                            <div class="col-xl-8">
                                <input type="text" name="duration" class="input-block-level text-light" placeholder="00:00:00">
                            </div>
                        </div>
                        
                        <div class="form-group row d-flex justify-content-start text-left mb-2">
                            <div class="col-xl-3">

                                <label for="ProgrammeItemImage" class="col-form-label">Image</label>
                            </div>
                            <div class="col-xl-8">
                                <input type="file" name="ProgrammeItemImage" class="input-block-level text-light" placeholder="Image">
                            </div>
                        </div>
                        <div class="row d-flex justify-content-center mb-2">
                            <div class="col-xl-8">
                                <button type="submit" class="btn purpleNoRadius text-light text-uppercase">Create Session</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="updateSessionModal" tabindex="1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="row d-flex justify-content-center">

                <div class="col-xl-5 col-sm-10 formBackground text-center">
                    <div class="col-xl-12" id="updateRestaurantError">
                        <p id="updateRestaurantErrorMessage"></p>
                    </div>
                    <h2 class="mt-2" id="">Update Session</h2>
                    <form id="updateRestaurantForm" method="POST">
                    <div class="form-group row d-flex justify-content-start text-left mb-2">
                            <div class="col-xl-3">

                                <label for="restaurantName" class="col-form-label">Restaurant</label>
                            </div>
                            <div class="col-xl-8">
                                <select id="restaurant" name="restaurant" class="input-block-level text-dark">
                                    <?php
                                        foreach ($model['sessions'] as $restaurant) {
                                    ?>
                                    <option value="<?php echo $restaurant->getId()?>"><?php echo $restaurant->getTitle()?></option>

                                    <?php
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row d-flex justify-content-start text-left mb-2">
                            <div class="col-xl-3">

                                <label for="programmeTitle" class="col-form-label">Title</label>
                            </div>
                            <div class="col-xl-8">
                                <input type="text" name="title" class="input-block-level text-light" placeholder="Title">
                            </div>
                        </div>
                        <div class="form-group row d-flex justify-content-start text-left mb-2">
                            <div class="col-xl-3">

                                <label for="programmeDateTime" class="col-form-label">Date/Time</label>
                            </div>
                            <div class="col-xl-8">
                                <input type="text" name="datetime" class="input-block-level text-light" placeholder="yyyy-mm-dd HH:MM:SS">
                            </div>
                        </div>
                        <div class="form-group row d-flex justify-content-start text-left mb-2">
                            <div class="col-xl-3">

                                <label for="programmePrice" class="col-form-label">Price</label>
                            </div>
                            <div class="col-xl-8">
                                <input type="text" name="price" class="input-block-level text-light" placeholder="Price">
                            </div>
                        </div>
                        <div class="form-group row d-flex justify-content-start text-left mb-2">
                            <div class="col-xl-3">

                                <label for="programmeAvailable" class="col-form-label">Tickets available</label>
                            </div>
                            <div class="col-xl-8">
                                <input type="text" name="ticketsavailable" class="input-block-level text-light" placeholder="Tickets available">
                            </div>
                        </div>
                        <div class="form-group row d-flex justify-content-start text-left mb-2">
                            <div class="col-xl-3">

                                <label for="programmeDuration" class="col-form-label">Duration</label>
                            </div>
                            <div class="col-xl-8">
                                <input type="text" name="duration" class="input-block-level text-light" placeholder="00:00:00">
                            </div>
                        </div>
                        
                        <div class="form-group row d-flex justify-content-start text-left mb-2">
                            <div class="col-xl-3">

                                <label for="ProgrammeItemImage" class="col-form-label">Image</label>
                            </div>
                            <div class="col-xl-8">
                                <input type="file" name="ProgrammeItemImage" class="input-block-level text-light" placeholder="Image">
                            </div>
                        </div>
                        <div class="row d-flex justify-content-center mb-2">
                            <div class="col-xl-8">
                                <button type="submit" class="btn purpleNoRadius text-light text-uppercase">Create Session</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<h1>Sessions</h1>
<div class="row">
    <div class="col-xl-5">
        <button type="button" class="btn purpleNoRadius text-light text-uppercase mb-2" data-toggle="modal" data-target="#createSessionModal">+ Add Session</button>
    </div>
    <div class="col-xl-12">
        <table class="table text-light table-borderless mt-2">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Restaurant</th>                    
                    <th>Date / Time</th>
                    <th>Duration</th>
                    <th>Amount Available</th>
                    <th>Price</th>                    
                    <th>Edit</th>
                    <th>Delete</th>

                </tr>
            </thead>
            <tbody>
                <?php
                $int = 0;
                foreach ($model['sessions'] as $sessions) {
                    $int = $int + 1;
                    $class = ($int % 2 == 0) ? 'normal-row' : 'dark-row';
                ?>
                    <tr class="<?= $class ?>">
                        <td scope="col"><?= $sessions->getId(); ?></td>
                        <td scope="col"><?= $sessions->getTitle() ?></td>
                        <td scope="col"><?= date('Y m d H:i', strtotime($sessions->getDatetime())) ?></td>
                        <td scope="col"><?= date('H:i:s', strtotime($sessions->getDuration())) ?></td>
                        <td scope="col"><?= $sessions->getAmountAvailable() ?></td>
                        <td scope="col"><?= $sessions->getPrice() ?></td>
                        <td scope="col">
                            <button type="button" class="btn btn-dark" onclick="//createSession(<?//= htmlspecialchars(json_encode($sessions->jsonSerialize()),) ?>)" data-toggle="modal" data-target="#updateSessionModal"><i class="fas fa-edit fa-lg"></i></button>
                        </td>
                        <td>
                            <button type="button" class="btn btn-dark" onclick="deleteSession(<?= $sessions->getEventSessionId() ?>)"><i class="fas fa-trash fa-lg"></i></button>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>




