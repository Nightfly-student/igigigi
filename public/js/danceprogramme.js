function deleteProgrammeItem(programmeid, sessionid) {
    let confirmAction = confirm("Are you sure you want to delete this programmeitem?");
    if (confirmAction) {
        fetch('/admin/danceprogram?programmeid=' + programmeid + '&sessionid=' + sessionid, {
            method: 'DELETE'
        }).then(function (response) {
            return response.text();
        }).then(function (text) {
            console.log(text);
        })
    }

}



function updateProgrammeItemFormss(danceeventid, venueid, title, session, datetime, price, tickets, duration, dancesessionid, description) {

    document.getElementById('inputDanceEventId').value = danceeventid;
    document.getElementById('inputVenueId').value = venueid;
    document.getElementById('inputDanceSessionId').value = dancesessionid;
    document.getElementById('inputTitle').value = title;
    document.getElementById('inputSession').value = session;
    document.getElementById('inputDateTime').value = datetime.replace(/\s/g, 'T');
    document.getElementById('inputPrice').value = price;
    document.getElementById('inputTickets').value = tickets;
    document.getElementById('inputDuration').value = duration;
    document.getElementById('inputDescription').value = description;

}