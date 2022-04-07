const createVenueForm = document.getElementById('createVenueForm');
const createVenueError = document.getElementById('createVenueError');
const createVenueErrorMessage = document.getElementById('createVenueErrorMessage');

if (typeof (createVenueForm) != 'undefined' && createVenueForm != null) {
    createVenueErrorMessage.style.display = 'none';

    createVenueForm.addEventListener('submit', function (e) {
        e.preventDefault();

        const formData = new FormData(this);
        fetch('/admin/putvenue', {
            method: 'POST',
            body: formData
        }).then(function (response) {
            return response.json();
        }).then(function (json) {
            if (createVenueError.classList.contains('alert-danger')) {
                createVenueError.classList.remove('alert-danger');
            }
            if (createVenueError.classList.contains('alert-success')) {
                createVenueError.classList.remove('alert-success');
            }
            if (json.passed == true) {
                createVenueErrorMessage.style.display = 'block';
                createVenueError.classList.add('alert-success');
                createVenueErrorMessage.innerHTML = json.message;
                const refresh = setTimeout(redirectToVenuesHome, 2000);
                resetForm('createVenueForm');
            } else {
                createVenueErrorMessage.style.display = 'block';
                createVenueError.classList.add('alert-danger');
                createVenueErrorMessage.innerHTML = json.message;
            }
        })
    })
}

const updateVenueForm = document.getElementById('updateVenueForm');
const updateVenuesModal = document.getElementById('updateVenuesModal');

if (typeof (updateVenueForm) != 'undefined' && updateVenueForm != null) {
    updateVenueForm.addEventListener('submit', function (e) {
        e.preventDefault();

        if (confirm('Are you sure you want to update this venue?')) {
            const formData = new FormData(this);
            fetch('/admin/putvenue', {
                method: 'POST',
                body: formData
            }).then(function (response) {
                return response.json();
            }).then(function (json) {

                if (updateVenueError.classList.contains('alert-danger')) {
                    updateVenueError.classList.remove('alert-danger');
                }
                if (updateVenueError.classList.contains('alert-success')) {
                    updateVenueError.classList.remove('alert-success');
                }
                if (json.passed == true) {
                    updateVenueErrorMessage.style.display = 'block';
                    updateVenueError.classList.add('alert-success');
                    updateVenueErrorMessage.innerHTML = json.message;
                    const refresh = setTimeout(redirectToVenuesHome, 2000);
                } else {
                    updateVenueErrorMessage.style.display = 'block';
                    updateVenueError.classList.add('alert-danger');
                    updateVenueErrorMessage.innerHTML = json.message;
                }
            })
        }
    })
}

function resetForm(formId) {
    document.getElementById(formId).reset();
}

function deleteVenue(id) {
    if (confirm('Are you sure you want to delete this venue?')) {
        fetch('/admin/venues?id=' + id, {
            method: 'DELETE'
        }).then(function (response) {
            return response.text();
        }).then(function (text) {
            $("#modalSimpleMessage").modal("show");
            document.getElementById('simpleMessage').innerText = text;
        })
        const refresh = setTimeout(redirectToVenuesHome, 2000);
    }
}

function redirectToVenuesHome() {
    window.location.replace("/admin/venues");
}

function updateVenue(venue) {
    document.getElementById('updateVenueTitle').innerText = 'Updating venue: ' + venue.venue_name;
    document.getElementById('inputVenueId').value = venue.venue_id;
    document.getElementById('inputVenueName').value = venue.venue_name;
    document.getElementById('inputVenueAddress').value = venue.venue_address;
    document.getElementById('inputVenueDescription').value = venue.venue_description;
}