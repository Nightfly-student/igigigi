<div class="modal fade" id="createProgrammeItemModal" tabindex="1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="row d-flex justify-content-center">

                <div class="col-xl-5 col-sm-10 formBackground text-center">
                    <h2 class="mt-2" id="">Create Programme Item</h2>
                    <form id="createProgrammeItemForm" method="POST" action="createprogrammeitem">

                        <div class="form-group row d-flex justify-content-start text-left mb-2">
                            <div class="col-xl-3">

                                <label for="venueName" class="col-form-label">Venue</label>
                            </div>
                            <div class="col-xl-8">
                                <select id="venue" name="venue" class="input-block-level text-dark">
                                    <?php
                                        foreach ($model['venues'] as $venue) {
                                    ?>
                                    <option value="<?php echo $venue->getId()?>"><?php echo $venue->getName()?></option>

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

                                <label for="programmeSession" class="col-form-label">Session</label>
                            </div>
                            <div class="col-xl-8">
                                <input type="text" name="session" class="input-block-level text-light" placeholder="Session">
                            </div>
                        </div>
                        <div class="form-group row d-flex justify-content-start text-left mb-2">
                            <div class="col-xl-3">

                                <label for="programmeDateTime" class="col-form-label">Date/Time</label>
                            </div>
                            <div class="col-xl-8">
                                <input type="datetime-local" name="datetime" class="input-block-level text-light bg-dark" placeholder="yyyy-mm-dd HH:MM:SS">
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
                                <input type="time" name="duration" value="01:00:00" class="input-block-level text-light bg-dark" placeholder="00:00:00">
                            </div>
                        </div>
                        <div class="form-group row d-flex justify-content-start text-left mb-2">
                            <div class="col-xl-3">

                                <label for="programmeDescription" class="col-form-label">Description</label>
                            </div>
                            <div class="col-xl-8">
                                <input type="text" name="description" class="input-block-level text-light" placeholder="Description">
                            </div>
                        </div>
                        <div class="form-group row d-flex justify-content-start text-left mb-2">
                            <div class="col-xl-3">

                                <label for="ProgrammeItemImage" class="col-form-label">Programme Item Image</label>
                            </div>
                            <div class="col-xl-8">
                                <input type="file" name="ProgrammeItemImage" class="input-block-level text-light" placeholder="Image">
                            </div>
                        </div>
                        <div class="row d-flex justify-content-center mb-2">
                            <div class="col-xl-8">
                                <button type="submit" class="btn purpleNoRadius text-light text-uppercase">Create Programme Item</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editProgrammeItemModal" tabindex="1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="row d-flex justify-content-center">

                <div class="col-xl-5 col-sm-10 formBackground text-center">
                    <h2 class="mt-2" id="">Edit Programme Item</h2>
                    <form id="editProgrammeItemForm" method="POST" action="editprogrammeitem">

                    <div class="form-group row d-flex justify-content-start text-left mb-2">
                            <div class="col-xl-3">
                                <label for="inputDanceEventId" class="col-form-label">Dance Event ID</label>
                            </div>
                            <div class="col-xl-8">
                                <input type="text" name="danceeventid" id="inputDanceEventId" class="input-block-level text-light" id="inputArtistId" readonly>
                            </div>
                        </div>
                        <div class="form-group row d-flex justify-content-start text-left mb-2">
                            <div class="col-xl-3">
                                <label for="inputDanceSessionId" class="col-form-label">Dance Session ID</label>
                            </div>
                            <div class="col-xl-8">
                                <input type="text" name="dancesessionid" id="inputDanceSessionId" class="input-block-level text-light" id="inputArtistId" readonly>
                            </div>
                        </div>
                    <div class="form-group row d-flex justify-content-start text-left mb-2">
                            <div class="col-xl-3">

                                <label for="venueName" class="col-form-label">Venue</label>
                            </div>
                            <div class="col-xl-8">
                                <select id="inputVenueId" name="venue" class="input-block-level text-dark">
                                    <?php
                                        foreach ($model['venues'] as $venue) {
                                    ?>
                                    <option value="<?php echo $venue->getId()?>"><?php echo $venue->getName()?></option>

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
                                <input type="text" name="title" id="inputTitle" class="input-block-level text-light" placeholder="Title">
                            </div>
                        </div>
                        <div class="form-group row d-flex justify-content-start text-left mb-2">
                            <div class="col-xl-3">

                                <label for="programmeSession" class="col-form-label">Session</label>
                            </div>
                            <div class="col-xl-8">
                                <input type="text" name="session" id="inputSession" class="input-block-level text-light" placeholder="Session">
                            </div>
                        </div>
                        <div class="form-group row d-flex justify-content-start text-left mb-2">
                            <div class="col-xl-3">

                                <label for="programmeDateTime" class="col-form-label">Date/Time</label>
                            </div>
                            <div class="col-xl-8">
                                <input type="datetime-local" name="datetime" id="inputDateTime" class="input-block-level text-light bg-dark" placeholder="yyyy-mm-dd HH:MM:SS">
                            </div>
                        </div>
                        <div class="form-group row d-flex justify-content-start text-left mb-2">
                            <div class="col-xl-3">

                                <label for="programmePrice" class="col-form-label">Price</label>
                            </div>
                            <div class="col-xl-8">
                                <input type="text" name="price" id="inputPrice" class="input-block-level text-light" placeholder="Price">
                            </div>
                        </div>
                        <div class="form-group row d-flex justify-content-start text-left mb-2">
                            <div class="col-xl-3">

                                <label for="programmeAvailable" class="col-form-label">Tickets available</label>
                            </div>
                            <div class="col-xl-8">
                                <input type="text" name="ticketsavailable" id="inputTickets" class="input-block-level text-light" placeholder="Tickets available">
                            </div>
                        </div>
                        <div class="form-group row d-flex justify-content-start text-left mb-2">
                            <div class="col-xl-3">

                                <label for="programmeDuration" class="col-form-label">Duration</label>
                            </div>
                            <div class="col-xl-8">
                                <input type="time" name="duration" id="inputDuration" class="input-block-level text-light bg-dark" placeholder="00:00:00">
                            </div>
                        </div>
                        <div class="form-group row d-flex justify-content-start text-left mb-2">
                            <div class="col-xl-3">

                                <label for="programmeDescription" class="col-form-label">Description</label>
                            </div>
                            <div class="col-xl-8">
                                <input type="text" name="description" id="inputDescription"  class="input-block-level text-light" placeholder="Description">
                            </div>
                        </div>
                        <div class="form-group row d-flex justify-content-start text-left mb-2">
                            <div class="col-xl-3">

                                <label for="ProgrammeItemImage" class="col-form-label">Programme Item Image</label>
                            </div>
                            <div class="col-xl-8">
                                <input type="file" name="ProgrammeItemImage" class="input-block-level text-light" placeholder="Image">
                            </div>
                        </div>
                        <div class="row d-flex justify-content-center mb-2">
                            <div class="col-xl-8">
                                <button type="submit" class="btn purpleNoRadius text-light text-uppercase">Update Programme Item</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<h1>Dance Programme</h1>
<div class="col-xl-5">
        <button type="button" class="btn purpleNoRadius text-light text-uppercase mb-2" data-toggle="modal" data-target="#createProgrammeItemModal">+ Add New Dance Session</button>
    </div>
<div class="row">
    <div class="col-xl-12">
        <table class="table text-light table-borderless mt-2">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Venue</th>
                    <th>Artist(s)</th>
                    <th>Session</th>
                    <th>Date/Time</th>
                    <th>Price</th>
                    <th>Tickets</th>
                    <th>Duration</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $int = 0;
                foreach ($model['programme'] as $programme) {
                    $int = $int + 1;
                    $class = ($int % 2 == 0) ? 'normal-row' : 'dark-row';
                ?>
                    <tr class="<?= $class ?>">
                        <td scope="col"><?= $programme->getDanceEventId() ?></td>
                        <td scope="col"><?= $programme->getVenueName() ?></td>
                        <td scope="col"><?= $programme->getTitle() ?></td>
                        <td scope="col"><?= $programme->getSession() ?></td>
                        <td scope="col"><?= $programme->getDateTime() ?></td>
                        <td scope="col"><?= $programme->getPrice() ?></td>
                        <td scope="col"><?= $programme->getTickets() ?></td>
                        <td scope="col"><?= $programme->getDuration() ?></td>
                        <td>
                        <a href="" data-toggle="modal" onclick="updateProgrammeItemFormss('<?=$programme->getDanceEventId() ?>', '<?= $programme->getVenueId() ?>', '<?= $programme->getTitle() ?>', '<?=  $programme->getSession() ?>', '<?= $programme->getDateTime() ?>', '<?=  $programme->getPrice() ?>', '<?=  $programme->getTickets() ?>', '<?=  $programme->getDuration() ?>', '<?=  $programme->getEventSessionId() ?>', '<?=  $programme->getBody() ?>')" data-target="#editProgrammeItemModal"><i class="fas fa-edit fa-lg"></i></a>
                        </td>
                        <td>
                        <a href="deletedanceprogram?programmeid=<?= $programme->getDanceEventId() ?>&sessionid=<?= $programme->getEventSessionId() ?>" onclick=""><i class="fas fa-trash fa-lg"></i></a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>