document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector('input[type="submit"]');
    
    // const dataTable = document.getElementById("dataTable");

    // const tabel = dataTable.insertRow();
    // const head1 = tabel.insertCell(0)
    // const head2 = tabel.insertCell(1)
    // const head3 = tabel.insertCell(2)
    // const head4 = tabel.insertCell(3)
    // head1.innerHTML = "Nama";
    // head2.innerHTML = "Email";
    // head3.innerHTML = "Status Keaktifan";
    // head4.innerHTML = "Jenis Kelamin";

    let statusInput = document.getElementById("status");
    const name = document.getElementById("name");
    const email = document.getElementById("email");
    let gender

    const genderRadioButtons = document.querySelectorAll('input[name="gender"]');
    genderRadioButtons.forEach(function (radio) {
        radio.addEventListener("change", function () {
            gender = radio.value
            handleRadioButtonChange();
        });
    });

    form.addEventListener("click", function (event) {
        event.preventDefault(); 

        handleFormSubmission();

        name.value = "";
        email.value = "";
        statusInput.value = "";
        genderRadioButtons.forEach(function (radio) {
            radio.checked = false;
        });
    });

    function handleFormSubmission() {
        const name = document.getElementById("name").value;
        const email = document.getElementById("email").value;


        if (name === "" || email === "") {
            alert("Nama dan Email diperlukan!");
            return;
        }

        console.log("Name: ", name);
        console.log("Email: ", email);
        console.log("gender: ", gender);

        fetch('post.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `name=${encodeURIComponent(name)}&email=${encodeURIComponent(email)}&status=${encodeURIComponent(statusInput.value)}&gender=${encodeURIComponent(gender)}`,
        })
            .then(response => response.json())
            .then(data => {
                alert('Data berhasil ditambahkan')
                console.log('Server Response:', data);
            })
            .catch(error => console.error('Error sending data to PHP:', error));

        // const newRow = dataTable.insertRow();
        // const cell1 = newRow.insertCell(0);
        // const cell2 = newRow.insertCell(1);
        // const cell3 = newRow.insertCell(2);
        // const cell4 = newRow.insertCell(3);
        // cell1.innerHTML = name;
        // cell2.innerHTML = email;
        // cell3.innerHTML = statusInput.value;
        // cell4.innerHTML = gender;

        // const tableSection = document.querySelector("#view");
        // tableSection.style.display = "flex";
    }

    function handleRadioButtonChange() {
        alert("Radio button changed");
    }

    
});
