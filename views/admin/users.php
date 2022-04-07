<!-- Create user modal -->
<div class="modal fade" id="createUserModal" tabindex="1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="row d-flex justify-content-center">

                <div class="col-xl-5 col-sm-10 formBackground text-center">
                    <div class="col-xl-12" id="createUserError">
                        <p id="createUserErrorMessage"></p>
                    </div>
                    <h2 class="mt-2" id="createUserTitle">Create User</h2>
                    <form id="createUserForm" method="POST">
                        <div class="form-group row d-flex justify-content-start text-left mb-2">
                            <div class="col-xl-3">

                                <label for="inputUserUsername" class="col-form-label">Username</label>
                            </div>
                            <div class="col-xl-8">
                                <input type="text" name="username" class="input-block-level text-light" id="inputUserUsername" placeholder="Username">
                            </div>
                        </div>
                        <div class="form-group row d-flex justify-content-start text-left mb-2">
                            <div class="col-xl-3">

                                <label for="inputUserEmail" class="col-form-label">Email</label>
                            </div>
                            <div class="col-xl-8">
                                <input type="text" name="email" class="input-block-level text-light" id="inputUserEmail" placeholder="Email">
                            </div>
                        </div>
                        <div class="form-group row d-flex justify-content-start text-left mb-2">
                            <div class="col-xl-3">

                                <label for="inputUserPassword" class="col-form-label">Password</label>
                            </div>
                            <div class="col-xl-8">
                                <input type="password" name="password" class="input-block-level text-light" id="inputUserPassword" placeholder="Password">
                            </div>
                        </div>
                        <div class="form-group row d-flex justify-content-start text-left mb-2">
                            <div class="col-xl-3">

                                <label for="inputUserPasswordConfirm" class="col-form-label">Verify Password</label>
                            </div>
                            <div class="col-xl-8">
                                <input type="password" name="passwordConfirm" class="input-block-level text-light" id="inputUserPasswordConfirm" placeholder="Repeat password">
                            </div>
                        </div>
                        <div class="form-group row text-left mb-2">
                            <div class="col-xl-3">
                                <label for="userrole">Select role for the user</label>
                            </div>
                            <div class="col-xl-4">
                                <select id="userRoles" class="grey text-light" name="userRoles">
                                    <?php foreach ($model['roles'] as $key) { ?>
                                        <option id="roleName<?= ucfirst($key->role_name) ?>" value="<?= $key->role_id ?>"><?= ucfirst($key->role_name) ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-xl-4">
                                <input type="checkbox" id="billingBoolCheckbox" onclick="hideOrShowBillingInfo()" name="billingInformationBool" />
                                <label id="billingLabel" for="billingBoolCheckbox">Add Billing Information</label>
                            </div>
                        </div>

                        <!-- Hidden form labels -->
                        <div class="form-group row d-flex justify-content-start text-left mb-2">
                            <div class="col-xl-3">
                                <label id="labelName" for="inputUserName" class="col-form-label">Name</label>
                            </div>
                            <div class="col-xl-8">
                                <input type="text" name="firstname" class="input-block-level text-light" id="inputUserName" placeholder="Billing Name">
                            </div>
                        </div>
                        <div class="form-group row d-flex justify-content-start text-left mb-2">
                            <div class="col-xl-3">
                                <label id="labelLastname" for="inputUserLastname" class="col-form-label">Lastname</label>
                            </div>
                            <div class="col-xl-8">
                                <input type="text" name="lastname" class="input-block-level text-light" id="inputUserLastname" placeholder="Billing Lastname">
                            </div>
                        </div>
                        <div class="form-group row d-flex justify-content-start text-left mb-2">
                            <div class="col-xl-3">
                                <label id="labelPhone" for="inputUserPhone" class="col-form-label">Phone</label>
                            </div>
                            <div class="col-xl-8">
                                <input type="text" name="phonenumber" class="input-block-level text-light" id="inputUserPhone" placeholder="Billing Phone">
                            </div>
                        </div>
                        <div class="form-group row d-flex justify-content-start text-left mb-2">
                            <div class="col-xl-3">
                                <label id="labelAddress" for="inputUserAddress" class="col-form-label">Address</label>
                            </div>
                            <div class="col-xl-8">
                                <input type="text" name="address" class="input-block-level text-light" id="inputUserAddress" placeholder="Billing Address">
                            </div>
                        </div>
                        <div class="form-group row d-flex justify-content-start text-left mb-2">
                            <div class="col-xl-3">
                                <label id="labelCountry" for="inputUserCountry" class="col-form-label">Country</label>
                            </div>
                            <div class="col-xl-8">
                                <input type="text" name="country" class="input-block-level text-light" id="inputUserCountry" placeholder="Billing Country">
                            </div>
                        </div>

                        <!-- hidden billing information -->
                        <div class="row d-flex justify-content-center mb-2">
                            <div class="col-xl-8">
                                <button type="submit" class="btn purpleNoRadius text-light text-uppercase">Create User</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Update Modal -->

<div class="modal fade" id="updateUserModal" tabindex="1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="row d-flex justify-content-center">
                <div class="col-xl-5 col-sm-10 formBackground text-center">
                    <div class="col-xl-12" id="updateUserError">
                        <p id="updateUserErrorMessage"></p>
                    </div>
                    <h2 class="mt-2" id="updateArtistTitle">Update User </h2>
                    <form id="updateUserForm" method="POST">
                        <input type="number" name="userId" class="input-block-level text-light" id="updateUserId" style="display:none">
                        <div class="form-group row d-flex justify-content-start text-left mb-2">
                            <div class="col-xl-3">
                                <label for="updateUserUsername" class="col-form-label">Username</label>
                            </div>
                            <div class="col-xl-8">
                                <input type="text" name="username" class="input-block-level text-light" id="updateUserUsername" placeholder="Username">
                            </div>
                        </div>
                        <div class="form-group row d-flex justify-content-start text-left mb-2">
                            <div class="col-xl-3">
                                <label for="updateUserEmail" class="col-form-label">Email</label>
                            </div>
                            <div class="col-xl-8">
                                <input type="text" name="email" class="input-block-level text-light" id="updateUserEmail" placeholder="Email">
                            </div>
                        </div>
                        <input type="checkbox" id="updatePasswordBoolCheckbox" onclick="changePasswordFields()" name="passwordBool" />
                        <label for="updatePasswordBoolCheckbox">Change password for this user</label>

                        <div class="form-group row d-flex justify-content-start text-left mb-2">
                            <div class="col-xl-3">

                                <label id="updatePasswordLabel" for="inputUserPassword" class="col-form-label">Password</label>
                            </div>
                            <div class="col-xl-8">
                                <input type="password" name="password" class="input-block-level text-light" id="updateUserPassword" placeholder="Password">
                            </div>
                        </div>
                        <div class="form-group row d-flex justify-content-start text-left mb-2">
                            <div class="col-xl-3">

                                <label id="updatePasswordConfirmLabel" for="updateUserPasswordConfirm" class="col-form-label">Verify Password</label>
                            </div>
                            <div class="col-xl-8">
                                <input type="password" name="passwordConfirm" class="input-block-level text-light" id="updateUserPasswordConfirm" placeholder="Repeat password">
                            </div>
                        </div>
                        <div class="form-group row text-left mb-2">
                            <div class="col-xl-3">
                                <label for="userrole">Select role for the user</label>
                            </div>
                            <div class="col-xl-4">
                                <select id="updateUserRoles" class="grey text-light" name="userRoles">
                                    <?php foreach ($model['roles'] as $key) { ?>
                                        <option id="roleName<?= ucfirst($key->role_name) ?>" value="<?= $key->role_id ?>"><?= ucfirst($key->role_name) ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-xl-4">
                                <input type="checkbox" id="updateBillingBoolCheckbox" onclick="hideOrShowUpdateBillingInfo()" name="billingInformationBool" />
                                <label id="billingLabel" for="updateBillingBoolCheckbox">Add/Remove Billing Info</label>
                            </div>
                        </div>
                        <!-- Hidden form labels -->
                        <div class="form-group row d-flex justify-content-start text-left mb-2">
                            <div class="col-xl-3">
                                <label id="updateLabelName" for="updateUserName" class="col-form-label">Name</label>
                            </div>
                            <div class="col-xl-8">
                                <input type="text" name="firstname" class="input-block-level text-light" id="updateUserName" placeholder="Billing Name">
                            </div>
                        </div>
                        <div class="form-group row d-flex justify-content-start text-left mb-2">
                            <div class="col-xl-3">
                                <label id="updateLabelLastname" for="updateUserLastname" class="col-form-label">Lastname</label>
                            </div>
                            <div class="col-xl-8">
                                <input type="text" name="lastname" class="input-block-level text-light" id="updateUserLastname" placeholder="Billing Lastname">
                            </div>
                        </div>
                        <div class="form-group row d-flex justify-content-start text-left mb-2">
                            <div class="col-xl-3">
                                <label id="updateLabelPhone" for="updateUserPhone" class="col-form-label">Phone</label>
                            </div>
                            <div class="col-xl-8">
                                <input type="text" name="phonenumber" class="input-block-level text-light" id="updateUserPhone" placeholder="Billing Phone">
                            </div>
                        </div>
                        <div class="form-group row d-flex justify-content-start text-left mb-2">
                            <div class="col-xl-3">
                                <label id="updateLabelAddress" for="updateUserAddress" class="col-form-label">Address</label>
                            </div>
                            <div class="col-xl-8">
                                <input type="text" name="address" class="input-block-level text-light" id="updateUserAddress" placeholder="Billing Address">
                            </div>
                        </div>
                        <div class="form-group row d-flex justify-content-start text-left mb-2">
                            <div class="col-xl-3">
                                <label id="updateLabelCountry" for="inputUserCountry" class="col-form-label">Country</label>
                            </div>
                            <div class="col-xl-8">
                                <input type="text" name="country" class="input-block-level text-light" id="updateUserCountry" placeholder="Billing Country">
                            </div>
                        </div>

                        <!-- hidden billing information -->
                        <div class="row d-flex justify-content-center mb-2">
                            <div class="col-xl-8">
                                <button type="submit" class="btn purpleNoRadius text-light text-uppercase">Update User</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<h1>Users</h1>

<div class="row">
    <div class="col-xl-5">
        <button type="button" class="btn purpleNoRadius text-light text-uppercase mb-2" data-toggle="modal" data-target="#createUserModal">+ Add New User</button>
    </div>
    <div class="col-xl-12">
        <table class="table text-light table-borderless mt-2">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th class="d-none d-lg-table-cell">Role</th>
                    <th class="d-none d-lg-table-cell">Billing Info</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $int = 0;
                foreach ($model['users'] as $user) {
                    $int = $int + 1;
                    $class = ($int % 2 == 0) ? 'normal-row' : 'dark-row';
                    $billing = ($user->getBillingInfo() != null) ? 'Available' : 'Not Available';
                ?>
                    <tr class="<?= $class ?>">
                        <td><?= $user->getUserId(); ?></td>
                        <td scope="col"><?= $user->getUsername() ?></td>
                        <td class="d-none d-lg-table-cell"><?= $user->getEmail() ?></td>
                        <td class="d-none d-lg-table-cell"><?= $user->getUserRole() ?></td>
                        <td><?= $billing ?></td>
                        <td>
                            <?php $billingInfoObject = ($user->getBillingInfo() != null) ? htmlspecialchars(json_encode($user->getBillingInfo()->jsonSerialize())) : 'null'; ?>
                            <button type="button" onclick="fillUserForm(<?= htmlspecialchars(json_encode($user->jsonSerialize())) ?>,<?= $billingInfoObject ?>)" class="btn btn-dark" data-toggle="modal" data-target="#updateUserModal">
                                <i class="fas fa-edit fa-lg"></i>
                            </button>
                        </td>
                        <td>
                            <button type="button" class="btn btn-dark" onclick="deleteUser(<?= $user->getUserId() ?>, '<?= $user->getUsername() ?>')">
                                <i class="fas fa-trash fa-lg"></i>
                            </button>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>