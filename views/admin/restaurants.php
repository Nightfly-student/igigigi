<div class="modal fade" id="createRestaurantModal" tabindex="1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="row d-flex justify-content-center">

                <div class="col-xl-5 col-sm-10 formBackground text-center">
                    <div class="col-xl-12" id="createRestaurantError">
                        <p id="createRestaurantErrorMessage"></p>
                    </div>
                    <h2 class="mt-2" id="">Create Restaurant</h2>
                    <form id="createRestaurantForm" method="POST">

                        <div class="form-group row d-flex justify-content-start text-left mb-2">
                            <div class="col-xl-3">

                                <label for="restaurantName" class="col-form-label">Name</label>
                            </div>
                            <div class="col-xl-8">
                                <input type="text" name="restaurantName" class="input-block-level text-light" placeholder="Restaurant Name">
                            </div>
                        </div>
                        <div class="form-group row d-flex justify-content-start text-left mb-2">
                            <div class="col-xl-3">
                                <label for="restaurantLocation" class="col-form-label">Location</label>
                            </div>
                            <div class="col-xl-8">
                                <input type="text" name="restaurantLocation" class="input-block-level text-light" placeholder="Restaurant Location">
                            </div>
                        </div>
                        <div class="form-group row d-flex justify-content-start text-left mb-5">
                            <div class="col-xl-3">
                                <label for="restaurantBody" class="col-form-label">Body</label>
                            </div>
                            <div class="col-xl-8">
                                <textarea id="restaurantBody" name="restaurantBody" rows="4" style="width: 100%"></textarea>
                            </div>
                        </div>

                        <div class="form-group row d-flex justify-content-start text-left mt-5 mb-2">
                            <div class="col-xl-3">
                                <label for="restaurantOpeningtime" class="col-form-label">Openingtime</label>
                            </div>
                            <div class="col-xl-4">
                                <input type="time" name="restaurantOpeningtime" class="input-block-level text-light btn-dark">
                            </div>
                            <div class="col-xl-4">
                                <input type="checkbox" name="wheelchair">
                                <label for="wheelchair" class="mx-2">Wheelchair Friendly</label>
                            </div>


                        </div>

                        <div class="form-group row d-flex justify-content-start text-left mb-2">
                            <div class="col-xl-3">
                                <label for="restaurantOpeningtime" class="col-form-label">Cuisine</label>
                            </div>
                            <div class="col-xl-8">
                                <input type="checkbox" value="<img src='https://flagcdn.com/h40/fr.png' width='34'/>" id="french" name="frenchCuisine" checked>
                                <label for="french" class="mx-2 mb-1"><img src="https://flagcdn.com/20x15/fr.png" alt="France" class="border"></label>

                                <input type="checkbox" value="<img src='https://flagcdn.com/h40/nl.png' width='34'/>" id="dutch" name="dutchCuisine" checked>
                                <label for="dutch" class="mx-2 mb-1"><img src="https://flagcdn.com/20x15/nl.png" alt="The Netherlands" class="border"></label>

                                <input type="checkbox" value="<img src='https://flagcdn.com/h40/cn.png' width='34'/>" id="chinese" name="chineseCuisine" checked>
                                <label for="chinese" class="mx-2 mb-1"><img src="https://flagcdn.com/20x15/cn.png" alt="China" class="border"> </label>

                                <input type="checkbox" value="<img src='https://flagcdn.com/h40/gr.png' width='34'/>" id="greek" name="greekCuisine" checked>
                                <label for="greek" class="mx-2 mb-1"><img src="https://flagcdn.com/20x15/gr.png" alt="Greece" class="border"></label>

                                <input type="checkbox" value="<img src='https://flagcdn.com/h40/it.png' width='34'/>" id="scales" name="italianCuisine" checked>
                                <label for="scales" class="mx-2 mb-1"><img src="https://flagcdn.com/20x15/it.png" alt="Italy" class="border"></label>
                                </br>
                                <input type="checkbox" value="<img src='https://flagcdn.com/h40/jp.png' width='34'/>" id="japanese" name="japaneseCuisine" checked>
                                <label for="japanese" class="mx-2 mb-1"><img src="https://flagcdn.com/20x15/jp.png" alt="Japan" class="border"></label>

                                <input type="checkbox" value="<img src='https://flagcdn.com/h40/tr.png' width='34'/>" id="turkish" name="turkishCuisine" checked>
                                <label for="turkish" class="mx-2 mb-1"><img src="https://flagcdn.com/20x15/tr.png" alt="Turkey" class="border"></label>

                                <input type="checkbox" value="<img src='https://flagcdn.com/h40/in.png' width='34'/>" id="indian" name="indianCuisine" checked>
                                <label for="indian" class="mx-2 mb-1"><img src="https://flagcdn.com/20x15/in.png" alt="India" class="border"></label>

                                <input type="checkbox" value="<img src='https://flagcdn.com/h40/id.png' width='34'/>" id="indonesian" name="indonesianCuisine" checked>
                                <label for="indonesian" class="mx-2 mb-1"><img src="https://flagcdn.com/20x15/id.png" alt="Indonesia" class="border"></label>

                                <input type="checkbox" value="<img src='https://flagcdn.com/h40/vn.png' width='34'/>" id="vietnamese" name="vietnameseCuisine" checked>
                                <label for="vietnamese" class="mx-2 mb-1"><img src="https://flagcdn.com/20x15/vn.png" alt="Vietnam" class="border"></label>
                            </div>
                        </div>

                        <div class="form-group row d-flex justify-content-start text-left mb-2">
                            <div class="col-xl-3">
                                <label for="restaurantImage" class="col-form-label">Image Link</label>
                            </div>
                            <div class="col-xl-8">
                                <input type="file" name="restaurantImage">
                            </div>
                        </div>

                        <div class="row d-flex justify-content-center mb-2">
                            <div class="col-xl-8">
                                <button type="submit" class="btn purpleNoRadius text-light text-uppercase">Create Restaurant</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="updateRestaurantModal" tabindex="1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="row d-flex justify-content-center">

                <div class="col-xl-5 col-sm-10 formBackground text-center">
                    <div class="col-xl-12" id="updateRestaurantError">
                        <p id="updateRestaurantErrorMessage"></p>
                    </div>
                    <h2 class="mt-2" id="">Update Restaurant</h2>
                    <form id="updateRestaurantForm" method="POST">
                        <input type="text" id="inputRestaurantId" name="restaurantId" class="input-block-level text-light" style="display:none">
                        <div class="form-group row d-flex justify-content-start text-left mb-2">
                            <div class="col-xl-3">

                                <label for="restaurantName" class="col-form-label">Name</label>
                            </div>
                            <div class="col-xl-8">
                                <input type="text" id="inputRestaurantName" name="restaurantName" class="input-block-level text-light" placeholder="Restaurant Name">
                            </div>
                        </div>
                        <div class="form-group row d-flex justify-content-start text-left mb-2">
                            <div class="col-xl-3">
                                <label for="restaurantLocation" class="col-form-label">Location</label>
                            </div>
                            <div class="col-xl-8">
                                <input type="text" id="inputRestaurantLocation" name="restaurantLocation" class="input-block-level text-light" placeholder="Restaurant Location">
                            </div>
                        </div>
                        <div class="form-group row d-flex justify-content-start text-left mb-5">
                            <div class="col-xl-3">
                                <label for="restaurantBody" class="col-form-label">Body</label>
                            </div>
                            <div class="col-xl-8">
                                <textarea id="inputRestaurantBody" name="restaurantBody" rows="4" style="width: 100%"></textarea>
                            </div>
                        </div>

                        <div class="form-group row d-flex justify-content-start text-left mt-5 mb-2">
                            <div class="col-xl-3">
                                <label for="restaurantOpeningtime" class="col-form-label">Openingtime</label>
                            </div>
                            <div class="col-xl-4">
                                <input type="time" id="inputRestaurantOpeningtime" name="restaurantOpeningtime" class="input-block-level text-light btn-dark">
                            </div>
                            <div class="col-xl-4">
                                <input type="checkbox" id="wheelchair" name="wheelchair">
                                <label for="wheelchair" class="mx-2">Wheelchair Friendly</label>
                            </div>
                        </div>

                        <div class="form-group row d-flex justify-content-start text-left mb-2">
                            <div class="col-xl-3">
                                <label for="restaurantOpeningtime" class="col-form-label">Cuisine</label>
                            </div>
                            <div class="col-xl-8">
                                <input type="checkbox" value="<img src='https://flagcdn.com/h40/fr.png' width='34'/>" id="updatefrench" name="frenchCuisine">
                                <label for="updatefrench" class="mx-2 mb-1"><img src="https://flagcdn.com/20x15/fr.png" alt="France" class="border"></label>

                                <input type="checkbox" value="<img src='https://flagcdn.com/h40/nl.png' width='34'/>" id="updatedutch" name="dutchCuisine">
                                <label for="updatedutch" class="mx-2 mb-1"><img src="https://flagcdn.com/20x15/nl.png" alt="The Netherlands" class="border"></label>

                                <input type="checkbox" value="<img src='https://flagcdn.com/h40/cn.png' width='34'/>" id="updatechinese" name="chineseCuisine">
                                <label for="updatechinese" class="mx-2 mb-1"><img src="https://flagcdn.com/20x15/cn.png" alt="China" class="border"> </label>

                                <input type="checkbox" value="<img src='https://flagcdn.com/h40/gr.png' width='34'/>" id="updategreek" name="greekCuisine">
                                <label for="updategreek" class="mx-2 mb-1"><img src="https://flagcdn.com/20x15/gr.png" alt="Greece" class="border"></label>

                                <input type="checkbox" value="<img src='https://flagcdn.com/h40/it.png' width='34'/>" id="updateitalian" name="italianCuisine">
                                <label for="updatescales" class="mx-2 mb-1"><img src="https://flagcdn.com/20x15/it.png" alt="Italy" class="border"></label>
                                </br>
                                <input type="checkbox" value="<img src='https://flagcdn.com/h40/jp.png' width='34'/>" id="updatejapanese" name="japaneseCuisine">
                                <label for="updatejapanese" class="mx-2 mb-1"><img src="https://flagcdn.com/20x15/jp.png" alt="Japan" class="border"></label>

                                <input type="checkbox" value="<img src='https://flagcdn.com/h40/tr.png' width='34'/>" id="updateturkish" name="turkishCuisine">
                                <label for="updateturkish" class="mx-2 mb-1"><img src="https://flagcdn.com/20x15/tr.png" alt="Turkey" class="border"></label>

                                <input type="checkbox" value="<img src='https://flagcdn.com/h40/in.png' width='34'/>" id="updateindian" name="indianCuisine">
                                <label for="updateindian" class="mx-2 mb-1"><img src="https://flagcdn.com/20x15/in.png" alt="India" class="border"></label>

                                <input type="checkbox" value="<img src='https://flagcdn.com/h40/id.png' width='34'/>" id="updateindonesian" name="indonesianCuisine">
                                <label for="updateindonesian" class="mx-2 mb-1"><img src="https://flagcdn.com/20x15/id.png" alt="Indonesia" class="border"></label>

                                <input type="checkbox" value="<img src='https://flagcdn.com/h40/vn.png' width='34'/>" id="updatevietnamese" name="vietnameseCuisine">
                                <label for="updatevietnamese" class="mx-2 mb-1"><img src="https://flagcdn.com/20x15/vn.png" alt="Vietnam" class="border"></label>
                            </div>
                        </div>

                        <div class="form-group row d-flex justify-content-start text-left mb-2">
                            <div class="col-xl-3">
                                <label for="restaurantImage" class="col-form-label">Image Link</label>
                            </div>
                            <div class="col-xl-8">
                                <input type="file" id="restaurantImageLink" name="restaurantImage">
                            </div>
                        </div>

                        <div class="row d-flex justify-content-center mb-2">
                            <div class="col-xl-8">
                                <button type="submit" class="btn purpleNoRadius text-light text-uppercase">Update Restaurant</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<h1>Restaurants</h1>
<div class="row">
    <div class="col-xl-5">
        <button type="button" class="btn purpleNoRadius text-light text-uppercase mb-2" data-toggle="modal" data-target="#createRestaurantModal">+ Add Restaurant</button>

    </div>
    <div class="col-xl-12">
        <table class="table text-light table-borderless mt-2">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Location</th>
                    <th class="d-none d-lg-table-cell">Cuisine</th>
                    <th>Openingtime</th>
                    <th>Edit</th>
                    <th>Delete</th>

                </tr>
            </thead>
            <tbody>
                <?php
                $int = 0;
                foreach ($model['restaurants'] as $restaurant) {
                    $int = $int + 1;
                    $class = ($int % 2 == 0) ? 'normal-row' : 'dark-row';

                ?>
                    <tr class="<?= $class ?>">
                        <td><?= $restaurant->getId(); ?></td>
                        <td scope="col"><?= $restaurant->getTitle() ?></td>
                        <td><?= $restaurant->getLocation() ?></td>
                        <td class="d-none d-lg-table-cell"><?= htmlspecialchars_decode($restaurant->getCuisine()) ?></td>

                        <td><?= date('H:i', strtotime($restaurant->getOpeningtime())) ?> </td>
                        <td>
                            <button type="button" class="btn btn-dark" onclick="fillRestaurantForm(<?= htmlspecialchars(json_encode($restaurant->jsonSerialize()),) ?>)" data-toggle="modal" data-target="#updateRestaurantModal"><i class="fas fa-edit fa-lg"></i></button>
                        </td>
                        <td>
                            <button type="button" class="btn btn-dark" onclick="deleteRestaurant(<?= $restaurant->getId() ?>)"><i class="fas fa-trash fa-lg"></i></button>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>