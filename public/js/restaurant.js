const createRestaurantForm = document.getElementById('createRestaurantForm');
const createRestaurantError = document.getElementById('createRestaurantError');
const createRestaurantErrorMessage = document.getElementById('createRestaurantErrorMessage');

if (typeof (createRestaurantForm) != 'undefined' && createRestaurantForm != null) {
    createRestaurantErrorMessage.style.display = 'none';

    createRestaurantForm.addEventListener('submit', function (e) {
        e.preventDefault();

        const formData = new FormData(this);

        fetch('/admin/createrestaurant', {
            method: 'POST',
            body: formData
        }).then(function (response) {
            return response.json();
        }).then(function (json) {
            if (createRestaurantError.classList.contains('alert-danger')) {
                createRestaurantError.classList.remove('alert-danger');
            }
            if (createRestaurantError.classList.contains('alert-success')) {
                createRestaurantError.classList.remove('alert-success');
            }
            if (json.passed == true) {
                createRestaurantErrorMessage.style.display = 'block';
                createRestaurantError.classList.add('alert-success');
                createRestaurantErrorMessage.innerHTML = json.message + ' You will be redirected within a couple of seconds.';
                const redirection = setTimeout(redirectToRestaurants, 2000);
            } else {
                createRestaurantErrorMessage.style.display = 'block';
                createRestaurantError.classList.add('alert-danger');
                createRestaurantErrorMessage.innerHTML = json.message;
            }
        })
    });
};

function redirectToRestaurants() {
    window.location.replace("/admin/restaurants");
}

function fillRestaurantForm(restaurant) {
    document.getElementById('inputRestaurantId').value = restaurant.restaurant_id
    document.getElementById('inputRestaurantName').value = restaurant.title;
    document.getElementById('inputRestaurantLocation').value = restaurant.location;
    document.getElementById('inputRestaurantBody').value = restaurant.body;
    document.getElementById('inputRestaurantOpeningtime').value = restaurant.openingtime;
    document.getElementById('wheelchair').checked = (restaurant.accessibility.includes("wheelchair")) ? true : false;;
    document.getElementById('updatefrench').checked = (restaurant.cuisine.includes("fr.png")) ? true : false;
    document.getElementById('updatedutch').checked = (restaurant.cuisine.includes("nl.png")) ? true : false;
    document.getElementById('updatechinese').checked = (restaurant.cuisine.includes("cn.png")) ? true : false;
    document.getElementById('updategreek').checked = (restaurant.cuisine.includes("gr.png")) ? true : false;
    document.getElementById('updateitalian').checked = (restaurant.cuisine.includes("it.png")) ? true : false;
    document.getElementById('updatejapanese').checked = (restaurant.cuisine.includes("jp.png")) ? true : false;
    document.getElementById('updateturkish').checked = (restaurant.cuisine.includes("tr.png")) ? true : false;
    document.getElementById('updateindian').checked = (restaurant.cuisine.includes("in.png")) ? true : false;
    document.getElementById('updateindonesian').checked = (restaurant.cuisine.includes("id.png")) ? true : false;
    document.getElementById('updatevietnamese').checked = (restaurant.cuisine.includes("vn.png")) ? true : false;
}

const updateRestaurantForm = document.getElementById('updateRestaurantForm');
const updateRestaurantError = document.getElementById('updateRestaurantError');
const updateRestaurantErrorMessage = document.getElementById('updateRestaurantErrorMessage');

if (typeof (updateRestaurantForm) != 'undefined' && updateRestaurantForm != null) {
    updateRestaurantErrorMessage.style.display = 'none';

    updateRestaurantForm.addEventListener('submit', function (e) {
        e.preventDefault();
        const formData = new FormData(this);

        fetch('/admin/updaterestaurant', {
            method: 'POST',
            body: formData
        })
            .then(function (response) {
                return response.json();
            }).then(function (json) {
                console.log(json);
                if (updateRestaurantError.classList.contains('alert-danger')) {
                    updateRestaurantError.classList.remove('alert-danger');
                }
                if (updateRestaurantError.classList.contains('alert-success')) {
                    updateRestaurantError.classList.remove('alert-success');
                }
                if (json.passed == true) {
                    updateRestaurantErrorMessage.style.display = 'block';
                    updateRestaurantError.classList.add('alert-success');
                    updateRestaurantErrorMessage.innerHTML = json.message + ' You will be redirected within a couple of seconds.';
                    const redirection = setTimeout(redirectToRestaurants, 2000);
    
                } else {
                    updateRestaurantErrorMessage.style.display = 'block';
                    updateRestaurantError.classList.add('alert-danger');
                    updateRestaurantErrorMessage.innerHTML = json.message;
                }
            })
    })
}

function deleteRestaurant(id) {
    if (confirm("Are you sure you want to delete this restaurant?")) {
        fetch('/admin/deleterestaurant?id=' + id, {
            method: 'DELETE'
        }).then(function (response) {
            return response.text();
        }).then(function (text) {
            $("#modalSimpleMessage").modal("show");
            document.getElementById('simpleMessage').innerText = text;
        })
        const refresh = setTimeout(redirectToRestaurants, 2000);
    }
}