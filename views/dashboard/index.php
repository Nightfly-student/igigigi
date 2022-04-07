<?php
if (checklogin()) {
?>
<div class="container-xxl">
    <header class="row text-center">
        <div class="col-xl-12 text-light">
            <h1 class="p-4">Dashboard</h1>
        </div>
    </header>
    <div class="card bg-dark mb-4">
        <div class="row p-3 text-light">
            <!-- MENU BUTTONS -->
            <div class="col-lg-3">
                <div class="row p-2">
                    <button type="button" class="btn m-auto text-light text-start bg-dark-secondary" id="profileButton" onclick="displayProfile()"> 
                        <i class="fas fa-user p-2 text-info"></i>
                        <a class="text-decoration-none text-light p-3">Profile</a>
                    </button>
                </div>
                <div class="row p-2">
                    <button type="button" class="btn m-auto text-light text-start" id="editemailButton" onclick="editEmail()"> 
                        <i class="fas fa-envelope p-2 text-success"></i>
                        <a class="text-decoration-none text-light p-3">Change Email</a>
                    </button>
                </div>
                <div class="row p-2">
                    <button type="button" class="btn m-auto text-light text-start" id="editpasswordButton" onclick="editPassword()"> 
                        <i class="fas fa-lock p-2 text-warning"></i>
                        <a class="text-decoration-none text-light p-3">Change Password</a>
                    </button>
                </div>
                <div class="row p-2">
                    <button type="button" class="btn m-auto text-light text-start" id="editaccountButton" onclick="editAccount()"> 
                        <i class="fas fa-edit p-2 text-secondary"></i>
                        <a class="text-decoration-none text-light p-3">Edit Info</a>
                    </button>
                </div>
                <div class="row p-2">
                    <button type="button" class="btn m-auto text-light text-start"> 
                        <i class="fas fa-sign-out p-2 text-danger"></i>
                        <a class="text-decoration-none text-light p-3" href="/login/logout">Logout</a>
                    </button>
                </div>
            </div>
            <!-- PROFILE -->
            <div class="col-lg-9" id="profile">
                <div class="row ">
                    <div class="btn m-auto text-light text-start "> 
                        <i class="fa fa-user p-2 text-info"></i>
                        <a class="text-decoration-none text-light p-3 fs-2">Profile</a>
                    </div>
                </div>
                <div class="col-4"></div>
                    <div class="row p-2">
                    <div class="col-4">
                        <h5>Username:</h5>
                    </div>
                    <div class="col-8">
                        <h5><?php echo $model->getUsername(); ?></h5>
                    </div>
                </div>
                <div class="row p-2">
                    <div class="col-4">
                        <h5>Email:</h5>
                    </div>
                    <div class="col-8">
                        <h5><?php echo $model->getEmail(); ?></h5>
                    </div>
                </div>
                <div class="row p-2">
                    <div class="col-4">
                        <h5>Firstname:</h5>
                    </div>
                    <div class="col-8">
                        <h5><?php echo $model->getFirstname(); ?></h5>
                    </div>
                </div>
                <div class="row p-2">
                    <div class="col-4">
                        <h5>Lastrname:</h5>
                    </div>
                    <div class="col-8">
                        <h5><?php echo $model->getLastname(); ?></h5>
                    </div>
                </div>
                <div class="row p-2">
                    <div class="col-4">
                        <h5>Address:</h5>
                    </div>
                    <div class="col-8">
                        <h5><?php echo $model->getAddress(); ?></h5>
                    </div>
                </div>
                <div class="row p-2">
                    <div class="col-4">
                        <h5>Country:</h5>
                    </div>
                    <div class="col-8">
                        <h5><?php echo $model->getCountry(); ?></h5>
                    </div>
                </div>
                <div class="row p-2">
                    <div class="col-4">
                        <h5>Phone number:</h5>
                    </div>
                    <div class="col-8">
                        <h5><?php echo $model->getPhonenumber(); ?></h5>
                    </div>
                </div>
            </div>
            <!-- CHANGE EMAIL -->
            <div class="col-lg-9" id="editemail" style="display:none;">
                <div class="row ">
                    <div class="btn m-auto text-light text-start "> 
                        <i class="fa fa-envelope p-2 text-success"></i>
                        <a class="text-decoration-none text-light p-3 fs-2">Change Email</a>
                    </div>
                    <form id="text-light" method="POST" action="dashboard/changeemail">
                        <div class="form-group row">
                        <label for="email" class="col-4 col-form-label fs-5">Current Email:</label>
                            <div class="col-8">
                                <label class="fs-5"><?php echo $model->getEmail() ?></label>
                            </div>
                        </div>
                        <div class="form-group row pt-2">
                        <label for="email" class="col-4 col-form-label fs-5">New Email:</label>
                            <div class="col-8">
                                <input type="email" class="form-control fs-5" name="email" required="required" id="email">
                            </div>
                        </div>
                        <div class="form-group row pt-2">
                            <div class="col-12 text-end">                                
                            <button name="submit" type="submit" class="btn btn-primary fs-5" href="#" onclick="statusMessage()">Change Email</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- EDIT PASSWORD -->
            <div class="col-lg-9" id="editpassword" style="display:none;">
                <div class="row ">
                    <div class="btn m-auto text-light text-start "> 
                        <i class="fa fa-lock p-2 text-warning"></i>
                        <a class="text-decoration-none text-light p-3 fs-2">Change Password</a>
                    </div>
                    <form id="text-light" method="POST" action="dashboard/changepassword">
                        <div class="form-group row">
                        <label for="password" class="col-4 col-form-label fs-5">Current Password:</label>
                            <div class="col-8">
                                <input type="text" value="" class="form-control" name="pwdCurrent" required="required" id="password">
                            </div>
                        </div>
                        <div class="form-group row pt-2">
                        <label for="password" class="col-4 col-form-label fs-5">New Password:</label>
                            <div class="col-8">
                                <input type="text" value="" class="form-control" name="pwdNew" required="required" id="passwordNew">
                            </div>
                        </div>
                        <div class="form-group row pt-2">
                        <label for="password" class="col-4 col-form-label fs-5">Repeat New Password:</label>
                            <div class="col-8">
                                <input type="text" value="" class="form-control" name="pwdNewR" required="required" id="passwordNewRepeat">
                            </div>
                        </div>
                        <div class="form-group row pt-2">
                            <div class="col-12 text-end">                                
                            <button name="submit" type="submit" class="btn btn-primary fs-5" href="#">Change Password</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- EDIT ACCOUNT INFO -->
            <div class="col-lg-9" id="editaccount" style="display:none;">
                <div class="row ">
                    <div class="btn m-auto text-light text-start "> 
                        <i class="fa fa-edit p-2 text-secondary"></i>
                        <a class="text-decoration-none text-light p-3 fs-2">Edit Account</a>
                    </div>
                    <form id="text-light" method="POST" action="dashboard/saveprofile">
                        <div class="form-group row">
                        <label for="firstname" class="col-4 col-form-label fs-5">First Name</label>
                            <div class="col-8">
                                <input type="text" value="<?php echo $model->getFirstname() ?>" class="form-control" name="firstname" required="required" id="firstname">
                            </div>
                        </div>
                        <div class="form-group row pt-2">
                            <label for="lastname" class="col-4 col-form-label fs-5">Last Name</label>
                            <div class="col-8">
                                <input type="text" value="<?php echo $model->getLastname() ?>" class="form-control" name="lastname" required="required" id="lastname">
                            </div>
                        </div>
                        <div class="form-group row pt-2">
                            <label for="address" class="col-4 col-form-label fs-5">Address</label>
                            <div class="col-8">
                                <input type="text" value="<?php echo $model->getAddress() ?>" class="form-control" name="address" required="required" id="address">
                            </div>
                        </div>
                        <div class="form-group row pt-2">
                            <label for="country" class="col-4 col-form-label fs-5">Country</label>
                            <div class="col-8">
                                <input type="text" value="<?php echo $model->getCountry() ?>" class="form-control" name="country" required="required" id="country">
                            </div>
                        </div>
                        <div class="form-group row pt-2">
                            <label for="phonenumber" class="col-4 col-form-label fs-5">Phone Number</label>
                            <div class="col-8">
                                <input type="text" value="<?php echo $model->getPhonenumber() ?>" class="form-control" name="phonenumber" required="required" id="phonenumber">
                            </div>
                        </div>
                        <div class="form-group row pt-2">
                            <div class="col-12 text-end">                                
                            <button name="submit" type="submit" class="btn btn-primary fs-5" href="#" onclick="statusMessage()">Edit Account</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function displayProfile() {
    $("#profile").show();
    $("#editemail").hide();
    $("#editpassword").hide();
    $("#editaccount").hide();
    $("#profileButton").addClass("bg-dark-secondary");
    $("#editemailButton").removeClass("bg-dark-secondary");
    $("#editpasswordButton").removeClass("bg-dark-secondary");
    $("#editaccountButton").removeClass("bg-dark-secondary");
    }

    function editEmail() {
    $("#profile").hide();
    $("#editemail").show();
    $("#editpassword").hide();
    $("#editaccount").hide();
    $("#profileButton").removeClass("bg-dark-secondary");
    $("#editemailButton").addClass("bg-dark-secondary");
    $("#editpasswordButton").removeClass("bg-dark-secondary");
    $("#editaccountButton").removeClass("bg-dark-secondary");
    }
    function editPassword() {
    $("#profile").hide();
    $("#editemail").hide();
    $("#editpassword").show();
    $("#editaccount").hide();
    $("#profileButton").removeClass("bg-dark-secondary");
    $("#editemailButton").removeClass("bg-dark-secondary");
    $("#editpasswordButton").addClass("bg-dark-secondary");
    $("#editaccountButton").removeClass("bg-dark-secondary");
    }

    function editAccount() {
    $("#profile").hide();
    $("#editemail").hide();
    $("#editpassword").hide();
    $("#editaccount").show();
    $("#profileButton").removeClass("bg-dark-secondary");
    $("#editemailButton").removeClass("bg-dark-secondary");
    $("#editpasswordButton").removeClass("bg-dark-secondary");
    $("#editaccountButton").addClass("bg-dark-secondary");
    }
</script>

<?php
} else { header('Location: /login'); }
?>

<!-- Alert box - Confirm changes -->
<?php //if () { ?>
    <!-- <script>function statusMessage() {alert('Changes Successfull!!');}</script> -->
<?php //} else { ?>
    <!-- <script>function statusMessage() {alert('Incorrect input!');}</script> -->
<?php //} ?>
