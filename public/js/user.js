const createUserForm = document.getElementById('createUserForm');
const createUserError = document.getElementById('createUserError');
const createUserErrorMessage = document.getElementById('createUserErrorMessage');

if (typeof (createUserForm) != 'undefined' && createUserForm != null) {
    createUserErrorMessage.style.display = 'none';

    createUserForm.addEventListener('submit', function (e) {
        e.preventDefault();

        const formData = new FormData(this);
        //calls createuser
        fetch('/admin/createuser', {
            method: 'POST',
            body: formData
        }).then(function (response) {
            return response.json();
        }).then(function (json) {
            //empties the error elements from all their previously given classes.
            if (createUserError.classList.contains('alert-danger')) {
                createUserError.classList.remove('alert-danger');
            }
            if (createUserError.classList.contains('alert-success')) {
                createUserError.classList.remove('alert-success');
            }
            //succes message
            if (json.passed == true) {
                createUserErrorMessage.style.display = 'block';
                createUserError.classList.add('alert-success');
                createUserErrorMessage.innerHTML = json.message + ' You will be redirected within a couple of seconds.';
                const redirection = setTimeout(redirectToUsers, 2500);
                //error message
            } else {
                createUserErrorMessage.style.display = 'block';
                createUserError.classList.add('alert-danger');
                createUserErrorMessage.innerHTML = json.message;
            }
        })
    })
}

const updateUserForm = document.getElementById('updateUserForm');
const updateUserError = document.getElementById('updateUserError');
const updateUserErrorMessage = document.getElementById('updateUserErrorMessage');

if (typeof (updateUserForm) != 'undefined' && updateUserForm != null) {
    updateUserErrorMessage.style.display = 'none';

    updateUserForm.addEventListener('submit', function (e) {
        e.preventDefault();
        const formData = new FormData(this);
        fetch('/admin/updateuser', {
            method: 'POST',
            body: formData
        }).then(function (response) {
            return response.json();
        }).then(function (json) {
            if (updateUserError.classList.contains('alert-danger')) {
                updateUserError.classList.remove('alert-danger');
            }
            if (updateUserError.classList.contains('alert-success')) {
                updateUserError.classList.remove('alert-success');
            }
            if (json.passed == true) {
                updateUserErrorMessage.style.display = 'block';
                updateUserError.classList.add('alert-success');
                updateUserErrorMessage.innerHTML = json.message + ' You will be redirected within a couple of seconds.';
                const redirection = setTimeout(redirectToUsers, 2000);
            } else {
                updateUserErrorMessage.style.display = 'block';
                updateUserError.classList.add('alert-danger');
                updateUserErrorMessage.innerHTML = json.message;
            }
        })
    })
}

//asks for confirmation and than deletes user
function deleteUser(id, name) {
    if (confirm("Are you sure you want to delete the user" + name + "?")) {
        fetch('/admin/deleteuser?id=' + id, {
            method: 'DELETE'
        }).then(function (response) {
            return response.json();
        }).then(function (json) {
            $("#modalSimpleMessage").modal("show");
            document.getElementById('simpleMessage').innerText = json.message;
            const redirection = setTimeout(redirectToUsers, 2000);
        })
    }
}

//update the user form 
function fillUserForm(user, billing) {
    document.getElementById('updateUserUsername').value = user.username;
    document.getElementById('updateUserEmail').value = user.email;
    document.getElementById('updateUserRoles').value = user.role_id;
    document.getElementById('updateUserId').value = user.users_id;
    hideElement('updateUserPassword', 'updatePasswordLabel');
    hideElement('updateUserPasswordConfirm', 'updatePasswordConfirmLabel');

    if (billing != null) {
        document.getElementById('updateBillingBoolCheckbox').checked = true;
        hideOrShowUpdateBillingInfo();
        document.getElementById('updateUserName').value = billing.billing_name;
        document.getElementById('updateUserLastname').value = billing.billing_lastname;
        document.getElementById('updateUserPhone').value = billing.billing_phone;
        document.getElementById('updateUserAddress').value = billing.billing_address;
        document.getElementById('updateUserCountry').value = billing.billing_country;
    } else {
        hideElement('updateLabelName', 'updateUserName');
        hideElement('updateLabelLastname', 'updateUserLastname');
        hideElement('updateLabelPhone', 'updateUserPhone');
        hideElement('updateLabelAddress', 'updateUserAddress');
        hideElement('updateLabelCountry', 'updateUserCountry');
        document.getElementById('updateBillingBoolCheckbox').checked = false;
    }
}

function changePasswordFields() {
    if (document.getElementById('updatePasswordBoolCheckbox').checked == true) {
        showElement('updateUserPassword', 'updatePasswordLabel');
        showElement('updateUserPasswordConfirm', 'updatePasswordConfirmLabel');
    } else {
        hideElement('updateUserPassword', 'updatePasswordLabel');
        hideElement('updateUserPasswordConfirm', 'updatePasswordConfirmLabel');
        document.getElementById('updateUserPassword').value = '';
        document.getElementById('updateUserPasswordConfirm').value = '';
    }
}

//hides elements
function hideElement(id, name) {
    document.getElementById(id).style.display = 'none';
    document.getElementById(id).value = '';
    document.getElementById(name).style.display = 'none';
    document.getElementById(name).value = '';
}

//displays elements
function showElement(id, name) {
    document.getElementById(id).style.display = 'block';
    document.getElementById(name).style.display = 'block';
}

//redirects to cms users homepage
function redirectToUsers() {
    window.location.replace("/admin/users");
}
if (window.location.href.includes('/admin/users')) {
    //Hide all billing information input fields and labels by default.
    hideElement('labelName', 'inputUserName');
    hideElement('labelLastname', 'inputUserLastname');
    hideElement('labelPhone', 'inputUserPhone');
    hideElement('labelAddress', 'inputUserAddress');
    hideElement('labelCountry', 'inputUserCountry');

    hideElement('updateLabelName', 'updateUserName');
    hideElement('updateLabelLastname', 'updateUserLastname');
    hideElement('updateLabelPhone', 'updateUserPhone');
    hideElement('updateLabelAddress', 'updateUserAddress');
    hideElement('updateLabelCountry', 'updateUserCountry');
}

//Extract and subtract form when clicking billing info button
function hideOrShowUpdateBillingInfo() {
    if (document.getElementById('updateBillingBoolCheckbox').checked == false) {
        hideElement('updateLabelName', 'updateUserName');
        hideElement('updateLabelLastname', 'updateUserLastname');
        hideElement('updateLabelPhone', 'updateUserPhone');
        hideElement('updateLabelAddress', 'updateUserAddress');
        hideElement('updateLabelCountry', 'updateUserCountry');
    }
    if (document.getElementById('updateBillingBoolCheckbox').checked == true) {
        showElement('updateLabelName', 'updateUserName');
        showElement('updateLabelLastname', 'updateUserLastname');
        showElement('updateLabelPhone', 'updateUserPhone');
        showElement('updateLabelAddress', 'updateUserAddress');
        showElement('updateLabelCountry', 'updateUserCountry');
    }
}
function hideOrShowBillingInfo() {
    if (document.getElementById('billingBoolCheckbox').checked == true) {
        showElement('labelName', 'inputUserName');
        showElement('labelLastname', 'inputUserLastname');
        showElement('labelPhone', 'inputUserPhone');
        showElement('labelAddress', 'inputUserAddress');
        showElement('labelCountry', 'inputUserCountry');
    } else {
        hideElement('labelName', 'inputUserName');
        hideElement('labelLastname', 'inputUserLastname');
        hideElement('labelPhone', 'inputUserPhone');
        hideElement('labelAddress', 'inputUserAddress');
        hideElement('labelCountry', 'inputUserCountry');
    }
}