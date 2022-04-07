const createArtistForm = document.getElementById('createArtistForm');
const createArtistError = document.getElementById('createArtistError');
const createArtistErrorMessage = document.getElementById('createArtistErrorMessage');


if (typeof (createArtistForm) != 'undefined' && createArtistForm != null) {
    createArtistErrorMessage.style.display = 'none';

    createArtistForm.addEventListener('submit', function (e) {
        e.preventDefault();

        const formData = new FormData(this);
        fetch('/admin/createartist', {
            method: 'POST',
            body: formData
        }).then(function (response) {
            return response.text();
        }).then(function (text) {
            createArtistErrorMessage.style.display = 'block';
            createArtistError.classList.add('alert-danger');
            createArtistErrorMessage.innerHTML = text;
        })
    });
};


const updateArtistForm = document.getElementById('updateArtistForm');
const updateArtistError = document.getElementById('updateArtistError');
const updateArtistErrorMessage = document.getElementById('updateArtistErrorMessage');

if (typeof (updateArtistForm) != 'undefined' && updateArtistForm != null) {
    updateArtistErrorMessage.style.display = 'none';

    updateArtistForm.addEventListener('submit', function (e) {
        e.preventDefault();

        const formData = new FormData(this);
        fetch('/admin/updateartist', {
            method: 'POST',
            body: formData
        }).then(function (response) {
            return response.text();
        }).then(function (text) {
            console.log(text);
        })
    });
};

function updateArtistFormss(id, name, information, genre, image) {
    document.getElementById('inputArtistId').value = id;
    document.getElementById('inputArtistName').value = name;
    document.getElementById('inputArtistInformation').value = information;
    document.getElementById('inputArtistGenre').value = genre;
    document.getElementById('currentArtistImage').innerText = 'Current image: ' + image;

    const imgg = document.createElement("img");
    imgg.src = image;
    imgg.width = '100';

    document.getElementById("currentArtistImage").appendChild(imgg);
}

function deleteArtist(id) {
    let confirmAction = confirm("Are you sure you want to delete this artist?");
    if (confirmAction) {
        fetch('/admin/artists?id=' + id, {
            method: 'DELETE'
        }).then(function (response) {
            return response.text();
        }).then(function (text) {
            console.log(text);
        })
    }

}
