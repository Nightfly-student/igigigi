<div class="modal fade" id="updateVenuesModal" tabindex="1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="row d-flex justify-content-center">
                <div class="col-xl-5 col-sm-10 formBackground text-center">
                    <div class="col-xl-12" id="updateVenueError">
                        <p id="updateVenueErrorMessage"></p>
                    </div>
                    <h2 class="mt-2" id="updateVenueTitle"></h2>
                    <form id="updateVenueForm" method="POST" action="#">
                        <div class="form-group row d-flex justify-content-start text-left mb-2">
                            <div class="col-xl-3">
                                <label for="inputPassword" class="col-form-label">Id</label>
                            </div>
                            <div class="col-xl-8">
                                <input type="text" name="venueId" class="input-block-level text-light" id="inputVenueId" readonly>
                            </div>
                        </div>
                        <div class="form-group row d-flex justify-content-start text-left mb-2">
                            <div class="col-xl-3">

                                <label for="inputPassword" class="col-form-label">Venue Name</label>
                            </div>
                            <div class="col-xl-8">
                                <input type="text" name="venueName" class="input-block-level text-light" id="inputVenueName" placeholder="Venue Name">
                            </div>
                        </div>
                        <div class="form-group row d-flex justify-content-start text-left mb-2">
                            <div class="col-xl-3">
                                <label for="inputPassword" class="col-form-label">Address</label>
                            </div>
                            <div class="col-xl-8">
                                <input type="text" name="venueAddress" class="input-block-level text-light" id="inputVenueAddress" placeholder="Address">
                            </div>
                        </div>
                        <div class="form-group row d-flex justify-content-start text-left mb-2">
                            <div class="col-xl-3">

                                <label for="inputPassword" class="col-form-label">Venue Description</label>
                            </div>
                            <div class="col-xl-8">
                                <input type="text" name="venueDescription" id="inputVenueDescription" class="input-block-level text-light" placeholder="Description">
                            </div>
                        </div>
                        <div class="row d-flex justify-content-center mb-2">
                            <div class="col-xl-8">
                                <button type="submit" class="btn purpleNoRadius text-light text-uppercase">Update Venue</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="createVenuesModal" tabindex="1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="row d-flex justify-content-center">

                <div class="col-xl-5 col-sm-10 formBackground text-center">
                    <div class="col-xl-12" id="createVenueError">
                        <p id="createVenueErrorMessage"></p>
                    </div>
                    <h2 class="mt-2">Create Venue</h2>
                    <form id="createVenueForm" method="POST" action="#">
                        <div class="form-group row d-flex justify-content-start text-left mb-2">
                            <div class="col-xl-3">

                                <label for="lblCreateVenueName" class="col-form-label">Venue Name</label>
                            </div>
                            <div class="col-xl-8">
                                <input type="text" name="venueName" class="input-block-level text-light" placeholder="Venue Name">
                            </div>
                        </div>
                        <div class="form-group row d-flex justify-content-start text-left mb-2">
                            <div class="col-xl-3">

                                <label for="inputPassword" class="col-form-label">Address</label>
                            </div>
                            <div class="col-xl-8">
                                <input type="text" name="venueAddress" class="input-block-level text-light" placeholder="Address">
                            </div>
                        </div>
                        <div class="form-group row d-flex justify-content-start text-left mb-2">
                            <div class="col-xl-3">

                                <label for="inputPassword" class="col-form-label">Venue Description</label>
                            </div>
                            <div class="col-xl-8">
                                <input type="text" name="venueDescription" class="input-block-level text-light" placeholder="Description">
                            </div>
                        </div>
                        <div class="row d-flex justify-content-center mb-2">
                            <div class="col-xl-9">
                                <button type="submit" class="btn purpleNoRadius text-light text-uppercase">Create Venue</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<h1>Venues</h1>

<div class="row">
    <div class="col-xl-5">
        <button type="button" class="btn purpleNoRadius text-light text-uppercase mb-2" data-toggle="modal" data-target="#createVenuesModal">+ Add New Venue</button>
    </div>
    <div class="col-xl-12">
        <table class="table text-light table-borderless mt-2">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Venue Name</th>
                    <th>Address</th>
                    <th>Description</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $int = 0;
                foreach ($model['venues'] as $venue) {
                    $int = $int + 1;
                    $class = ($int % 2 == 0) ? 'normal-row' : 'dark-row';
                ?>
                    <tr class="<?= $class ?>">
                        <td><?= $venue->getId(); ?></td>
                        <td scope="col"><?= $venue->getName() ?></td>
                        <td scope="col"><?= $venue->getDescription() ?></td>
                        <td class="d-none d-lg-table-cell"><?= $venue->getAddress() ?></td>
                        <td>
                            <button type="button" class="btn btn-dark" onclick="updateVenue(<?= htmlspecialchars(json_encode($venue->jsonSerialize())) ?>)" data-toggle="modal" data-target="#updateVenuesModal">
                                <i class="fas fa-edit fa-lg"></i>
                                </a>
                        </td>
                        <td>
                            <button type="button" class="btn btn-dark" onclick="deleteVenue(<?= $venue->getId() ?>)"> <i class="fas fa-trash fa-lg"></i></button>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>