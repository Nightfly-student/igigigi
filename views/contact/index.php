<!--div class="row text-center"> 
    <div class="col-xl-12 text-dark ">

        <h2>Contact Page</h2>
        <p>Do you have a question or need any help? Feel free to contact us through the form below. Check our FAQ for answers on commonly asked questions</p>

        <div class="test">
            <form class="contactForm1" action="contactform.php" method="post">
                <input class="contactForm" type="text" name="name" placeholder="Full Name">
                <input class="contactForm" type="text" name="mail" placeholder="Your E-mail">
                <input class="contactForm" type="text" name="subject" placeholder="Subject">
                <textarea class="contactForm" name="message" placeholder="Message"></textarea>
                <button type="submit" name="submit">SEND FORM</button>
            </form>
        </div>
    </div>
</div>
-->
<div class="m-4 text-start">
    <h1 class="text-light text-center">Contact Page</h1>
    <p class="contact-text text-light text-start fs-5">Do you have a question or need any help?<br> Feel free to contact us trough the form below. <br>Check our <a href="" class="contact-color1">FAQ</a> for answers on commonly asked questions.</p>
    
    <div class="contact-section rounded">
        <form class="contact-form" action="contactform.php" method="post">
            <div class="form-group row">
                <label for="fname" class="col-sm-2 col-form-label contact-label">Name</label>
                <div class="col-sm-10">
                    <input class="contact-form-text" type="text" id="fname">
                </div>
            </div>
            <div class="form-group row">
                <label for="mail" class="col-sm-2 col-form-label contact-label">Email</label>
                <div class="col-sm-10">
                    <input class="contact-form-text" type="text" id="mail">
                </div>
            </div>
            <div class="form-group row">
                <label for="subject" class="col-sm-2 col-form-label contact-label">Subject</label>
                <div class="col-sm-10">
                    <input class="contact-form-text" type="text" id="subject">
                </div>
            </div>
            <div class="form-group row">
                <label for="message" class="col-sm-2 col-form-label contact-label">Message</label>
                <div class="col-sm-10">
                    <textarea class="contact-form-textarea" id="message"></textarea>
                </div>
            </div>
            <button class="contact-form-btn mb-3" type="submit" name="submit">SEND FORM</button>
        </form>
    </div>
</div>


