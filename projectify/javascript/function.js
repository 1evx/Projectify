// Button To redirect page
function redirectTo(location){
    window.location.href = location;
}

function removeElementsByClassName(className) {
    const elements = document.getElementsByClassName(className);
    while(elements.length > 0) {
        elements[0].parentNode.removeChild(elements[0]);
    }
}

function clearForm() {
    const form = document.querySelector('form');
    if (form) {
        form.reset();
    }
}

function logout() {
    const userConfirmed = window.confirm('Are you sure you want to log out?');

    if (!userConfirmed) {
        return;
    }

    const xhttp = new XMLHttpRequest();

    xhttp.onload = function() {
        if (this.status === 200) {
            window.alert('Log Out Success!');
            window.location.href = 'mainpage.html';
        } else {
            console.error("Error in XMLHttpRequest. Status: " + this.status);
        }
    }

    xhttp.open("POST", "php/logout.php");
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send();
}

function displayMessage1() {
    window.alert("Lecturers are unable to update assignemnt");
}

function stopDefAction(evt) {
    evt.preventDefault();
}

document.querySelector('.custom-file-button').addEventListener('click', function() {
  document.getElementById('input').click();
});

document.getElementById('input').addEventListener('change', function() {
  var fileName = this.files[0] ? this.files[0].name : 'No file chosen';
  document.getElementById('file-name').textContent = fileName;
});

