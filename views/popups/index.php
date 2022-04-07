<div>
<header class="row text-center">
    <h1 class="p-4 text-light">Popups Page</h1>
</header>

<!-- Modal go to shoppingcart -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#gotoshoppingModal">
   Go to shoppingcart Modal   
</button>

<div class="modal fade" id="gotoshoppingModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close-button topright" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body modal-text1">
        Added to the Cart
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn1 btn-primary" data-dismiss="modal">Continue Shopping</button>
        <button type="button" class="btn btn1 btn-primary">Go to Card</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Cookies -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#cookiesModal">
   Cookies Modal   
</button>

<div class="modal fade" id="cookiesModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h1 class="text-light w-100">Cookies</h1>
        </button>
      </div>
      <div class="modal-body text-light">
      HaarlemFestival  asks you to accept cookies for performance, social media and advertising purposes. Social media and advertising cookies of third parties are used to offer you social media functionalities and personalized ads. To get more information or amend your preferences, press the ‘more information’ button or visit "Cookie Settings" at the bottom of the website. To get more information about these cookies and the processing of your personal data, check our Privacy & Cookie Policy. Do you accept these cookies and the processing of personal data involved?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn1 btn-secondary" data-dismiss="modal">More Information</button>
        <button type="button" class="btn btn1 btn-primary">Accept Cookies</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Set Amount of people -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#amountPeopleModal">
   Set Amount of People  
</button>

<div class="modal fade" id="amountPeopleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h3 class="text-light w-100">Set Amount of People</h3>
        </button>
      </div>
      <div class="modal-body text-light">
        <div class="row text-center w-100">
        <div class="col-3">
          </div>
          <div class="col-3">
            <h2>Adults</h2>
          </div>
          <div class="col-6">
            <input class="popupnumber" type="number" id="fname" min="0" value="0" name="fname"><br>
          </div>
        </div>
        <div class="row text-center w-100">
          <div class="col-3">
          </div>
          <div class="col-3">
          <h2>Children</h2>
          </div>
          <div class="col-6">
          <input class="popupnumber" type="number" id="fname" min="0" value="0" name="fname"><br>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn1 btn-primary">Update Settings</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Choose Language -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#chooseLanguageModal">
   Choose Language   
</button>

<div class="modal fade" id="chooseLanguageModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h4 class="text-light w-100">Choose tour language</h4>
        </button>
      </div>
      <div class="modal-body text-light">
      <div class="row">
      <div class="col-xl-4">
</div>  
      <div class="col-xl-6">
        <input type="radio" id="dutch" name="language" value="Dutch">
        <img src="https://flagcdn.com/h40/nl.png" height="20" alt="Dutch">
        <label for="dutch">Dutch</label><br>
        <input type="radio" id="english" name="language" value="English">
        <img src="https://flagcdn.com/h40/gb.png" height="20" width="30" alt="English">
        <label for="english">English</label><br>
        <input type="radio" id="chinese" name="language" value="Chinese">
        <img src="https://flagcdn.com/h40/cn.png" height="20" alt="Chinese">
        <label for="chinese">Chinese</label>
        </div>
        <div class="col-xl-2">
</div>
</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn1 btn-primary">Apply Changes</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Overlap -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#overlapModal">
   Overlap   
</button>

<div class="modal fade" id="overlapModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h3 class="text-light w-100">This will overlap two events</h3>
        </button>
      </div>
      <div class="modal-body text-light text-center">
      <p class="w-100">The Caprera Openluchttheater 30/07 at 14:00 will overlap the historic event 30/07 at 13:00<p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn1 btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn1 btn-primary">Add Anyways</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Choose tour -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#chooseTourModal">
   Choose Tour   
</button>

<div class="modal fade" id="chooseTourModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h1 class="text-light w-100">Choose Tour</h1>
        </button>
      </div>
      <div class="modal-body text-light">
        <div class="row bg-dark p-1 rounded"> 
          <h4 class="col-xl-8">Date</h4>
          <div class="col-xl-4">
          <fieldset id="dateday">
            <div class="d-inline">
              <label for="thursday">Thursday</label>
              <input class="float-end" type="radio" id="thursday" name="dateday" value="Thursday"><br>
            </div>
            <div class="d-inline">
              <label for="friday">Friday</label>
              <input class="float-end" type="radio" id="friday" name="dateday" value="Friday"><br>
            </div>
            <div class="d-inline">
              <label for="saturday">Saturday</label>
              <input class="float-end" type="radio" id="saturday" name="dateday" value="Saturday"><br>
            </div>
            <div class="d-inline">
              <label for="sunday">Sunday</label>
              <input class="float-end" type="radio" id="sunday" name="dateday" value="Sunday"><br>
            </div>
            </fieldset>
          </div>
        </div>
          <div class="row p-2">
          </div>
        <div class="row bg-dark p-1 rounded">
        <h4 class="col-xl-8">Session / Time</h4>
          <div class="col-xl-4">
            <fieldset id="date">
            <div class="d-inline">
              <label for="10am">10:00</label>
              <input class="float-end" type="radio" id="10am" name="date" value="10am"><br>
            </div>
            <div class="d-inline">
              <label for="14pm">14:00</label>
              <input class="float-end" type="radio" id="14pm" name="date" value="14pm"><br>
            </div>
            <div class="d-inline">
              <label for="16pm">16:00</label>
              <input class="float-end" type="radio" id="16pm" name="date" value="16pm"><br>
            </div>
          </fieldset>
          </div>
        </div>
          <div class="row p-2">
          </div>
        <div class="row bg-dark p-1 rounded">
          <h4 class="col-xl-8">Language</h4>
          <div class="col-xl-4">
            <fieldset id="language">
            <div class="d-inline">
              <img src="https://flagcdn.com/h40/nl.png" height="20" width="30" alt="Dutch">
              <label for="dutch">Dutch</label>
              <input class="float-end" type="radio" id="dutch" name="language" value="Dutch"><br>
            </div>
            <div class="d-inline">
              <img src="https://flagcdn.com/h40/gb.png" height="20" width="30" alt="English">
              <label for="english">English</label>
              <input class="float-end" type="radio" id="english" name="language" value="English"><br>
            </div>
            <div class="d-inline">
              <img src="https://flagcdn.com/h40/cn.png" height="20" width="30" alt="Chinese">
              <label for="chinese">chinese</label>
              <input class="float-end" type="radio" id="chinese" name="language" value="Chinese"><br>
            </div>
            </fieldset>
          </div>
        </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn1 btn-primary">Apply Changes</button>
      </div>
    </div>
  </div>
</div>





</div>
