<div class="modal fade" id="createArtistModal" tabindex="1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="row d-flex justify-content-center">

                <div class="col-xl-5 col-sm-10 formBackground text-center">
                    <div class="col-xl-12" id="createArtistError">
                        <p id="createArtistErrorMessage"></p>
                    </div>
                    <h2 class="mt-2" id="">Create Artist</h2>
                    <form id="createArtistForm" method="POST" action="#">

                        <div class="form-group row d-flex justify-content-start text-left mb-2">
                            <div class="col-xl-3">

                                <label for="aristName" class="col-form-label">Artist Name</label>
                            </div>
                            <div class="col-xl-8">
                                <input type="text" name="artistName" class="input-block-level text-light"  placeholder="Artist Name">
                            </div>
                        </div>
                        <div class="form-group row d-flex justify-content-start text-left mb-2">
                            <div class="col-xl-3">
                                <label for="artistInformation" class="col-form-label">Arrist Information</label>
                            </div>
                            <div class="col-xl-8">
                                <input type="text" name="artistInformation" class="input-block-level text-light" placeholder="Information">
                            </div>
                        </div>
                        <div class="form-group row d-flex justify-content-start text-left mb-2">
                            <div class="col-xl-3">

                                <label for="artistGenre" class="col-form-label">Artist Genre</label>
                            </div>
                            <div class="col-xl-8">
                                <input type="text" name="artistGenre" class="input-block-level text-light" placeholder="Genre">
                            </div>
                        </div>
                        <div class="form-group row d-flex justify-content-start text-left mb-2">
                            <div class="col-xl-3">

                                <label for="artistImage" class="col-form-label">Artist Image</label>
                            </div>
                            <div class="col-xl-8">
                                <input type="file" name="artistImage" class="input-block-level text-light" placeholder="Description">
                            </div>
                        </div>
                        <div class="row d-flex justify-content-center mb-2">
                            <div class="col-xl-8">
                                <button type="submit" class="btn purpleNoRadius text-light text-uppercase">Create Artist</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="updateArtistModal" tabindex="1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
            <h2 class="mt-2">Update Artist</h2>
            </div>
            <div class="row d-flex justify-content-center">

                <div class="col-xl-5 col-sm-10 formBackground text-center">
                <div class="col-xl-12" id="updateArtistError">
                    <p id="updateArtistErrorMessage"></p>
                </div>
                    <h2 class="mt-2" id="updateArtistTitle"></h2>
                    <form id="updateArtistForm" method="POST" action="#">
                        <div class="form-group row d-flex justify-content-start text-left mb-2">
                            <div class="col-xl-3">
                                <label for="inputPassword" class="col-form-label">Id</label>
                            </div>
                            <div class="col-xl-8">
                                <input type="text" name="artistId" class="input-block-level text-light" id="inputArtistId" readonly>
                            </div>
                        </div>
                        <div class="form-group row d-flex justify-content-start text-left mb-2">
                            <div class="col-xl-3">

                                <label for="inputPassword" class="col-form-label">Artist Name</label>
                            </div>
                            <div class="col-xl-8">
                                <input type="text" name="artistName" class="input-block-level text-light" id="inputArtistName" placeholder="Artist Name">
                            </div>
                        </div>
                        <div class="form-group row d-flex justify-content-start text-left mb-2">
                            <div class="col-xl-3">
                                <label for="artistInformation" class="col-form-label">Artist Information</label>
                            </div>
                            <div class="col-xl-8">
                                <input type="text" name="artistInformation" class="input-block-level text-light" id="inputArtistInformation" placeholder="Information">
                            </div>
                        </div>
                        <div class="form-group row d-flex justify-content-start text-left mb-2">
                            <div class="col-xl-3">

                                <label for="artistDescription" class="col-form-label">Artist Genre</label>
                            </div>
                            <div class="col-xl-8">
                                <input type="text" name="artistGenre" id="inputArtistGenre" class="input-block-level text-light" placeholder="Genre">
                            </div>
                        </div>
                        <div class="form-group row d-flex justify-content-start text-left mb-2">
                            <div class="col-xl-3">

                                <label for="inputPassword" class="col-form-label">Artist Image</label>
                            </div>
                            <div class="col-xl-8">
                                <p id="currentArtistImage"></p>
                            
                                <input type="file" name="artistImage" id="inputArtistImage" class="input-block-level text-light">
                            </div>
                        </div>
                        <div class="row d-flex justify-content-center mb-2">
                            <div class="col-xl-8">
                                <button type="submit" onclick="confirmAction()" class="btn purpleNoRadius text-light text-uppercase">Update Artist</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<h1>Artists</h1>
<div class="row">
    <div class="col-xl-5">
        <button type="button" class="btn purpleNoRadius text-light text-uppercase mb-2" data-toggle="modal" data-target="#createArtistModal">+ Add New Artist</button>
    </div>
    <div class="col-xl-12">
        <table class="table text-light table-borderless mt-2">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Genre</th>
                    <th class="d-none d-lg-table-cell">Image</th>
                    <th>Edit</th>
                    <th>Delete</th>

                </tr>
            </thead>
            <tbody>
                <?php
                $int = 0;
                foreach ($model['artists'] as $artist) {
                    $int = $int + 1;
                    $class = ($int % 2 == 0) ? 'normal-row' : 'dark-row';
                ?>
                    <tr class="<?= $class ?>">
                        <td><?= $artist->getId(); ?></td>
                        <td scope="col"><?= $artist->getName() ?></td>
                        <td class="d-none d-lg-table-cell"><?= $artist->getGenre() ?></td>
                        <td><?= $artist->getImage() ?> </td>
                        <td>
                            <a href="" data-toggle="modal" onclick="updateArtistFormss('<?=$artist->getId() ?>', '<?= $artist->getName() ?>', '<?= $artist->getInformation() ?>', '<?= $artist->getGenre() ?>', '<?= $artist->getImage() ?>')" data-target="#updateArtistModal"><i class="fas fa-edit fa-lg"></i></a>
                        </td>
                        <td>
                            <a href="" onclick="deleteArtist(<?= $artist->getId() ?>)"><i class="fas fa-trash fa-lg"></i></a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>