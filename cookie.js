function setCookie(name, value, days) {
    var expires = "";
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (minutes * 60 * 1000));
        expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + (value || "") + expires + "; path=/";
}


function saveToLocalStorage(data) {
    localStorage.setItem('userData', JSON.stringify(data));
}

function getFromLocalStorage() {
    var storedData = localStorage.getItem('userData');
    return storedData ? JSON.parse(storedData) : null;
}

function removeFromLocalStorage() {
    localStorage.removeItem('userData');
}

var userDataFromCookie = getCookie('userData');
var userDataFromLocalStorage = getFromLocalStorage();

var userData = userDataFromCookie ? JSON.parse(userDataFromCookie) : userDataFromLocalStorage;

if (userData) {
    document.getElementById('name').value = userData.name;
    document.getElementById('email').value = userData.email;
    document.getElementById('status').value = userData.status;

    var genderElement = document.getElementById(userData.gender);
    if (genderElement) {
        genderElement.checked = true;
    } else {
        console.error('Elemen dengan ID ' + userData.gender + ' tidak ditemukan.');
    }
}

document.querySelector('form').addEventListener('submit', function (event) {
    event.preventDefault();

    setCookie('userData', JSON.stringify({
        name: document.getElementById('name').value,
        email: document.getElementById('email').value,
        status: document.getElementById('status').value,
        gender: document.querySelector('input[name="gender"]:checked').value
    }), 5);  

    saveToLocalStorage({
        name: document.getElementById('name').value,
        email: document.getElementById('email').value,
        status: document.getElementById('status').value,
        gender: document.querySelector('input[name="gender"]:checked').value
    });

});

