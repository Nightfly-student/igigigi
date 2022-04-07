<script src="https://www.google.com/recaptcha/api.js"></script>
<div class="container-xxl">
    <header class="row text-center">
        <div class="col-xl-12 text-light">
            <h1 class="p-4">Register</h1>
        </div>
    </header>
    <?php
	if (isset($model))
	{
	?>

	<div id="errorbox" class="text-center text-danger">
	<?php echo $model ?>
	</div>
	
	<?php 
	}
	?>
    <div class=" modal-login">             
        <form action="register/Register" method="post">
            <div class="form-group pb-2">
                <i class="fas fa-id-badge text-dark"></i>
                <input type="text" class="form-control" name="username" placeholder="Username" required="required">
            </div>
            <div class="form-group pb-2">
                <i class="fas fa-user text-dark"></i>
                <input type="email" class="form-control" name="email" placeholder="Your Email" required="required">
            </div>
            <div class="form-group pb-2">
                <i class="fas fa-lock text-dark"></i>
                <input type="password" class="form-control" name="pwd" placeholder="Password" required="required">					
            </div>
            <div class="form-group pb-4">
                <i class="fas fa-lock text-dark"></i>
                <input type="password" class="form-control" name="pwdRepeat" placeholder="Re-enter Password" required="required">					
            </div>
            <div class="g-recaptcha brochure__form__captcha" data-sitekey="6Lf-cuIeAAAAAHeQm2bpZWmWv2gLGEVLDgJqZOjq"></div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary btn-block btn-lg" value="Register">
            </div>
        </form>		
        <div class="modal-footer">
            <a href="/login">Already have a account? Click here to login</a>
        </div>				
    </div>
</div>
