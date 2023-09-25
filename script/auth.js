const signUpDisplay = document.querySelector('#signUpDisplay');
const signInDisplay = document.querySelector('#signInDisplay');
const formDisplayDiv = document.querySelector('#formDisplayDiv');


function toggleDisplay() {
    if (formDisplayDiv.style.display === "block") {
        formDisplayDiv.style.display = "none";
    }
    else {
        formDisplayDiv.style.display = "block";
    }
}


signUpDisplay.addEventListener('click', (ev) => {
    ev.preventDefault();
    toggleDisplay();

    fetch('./inscription.html', {
        method: 'GET',

    }).then((response) => {
        return response.text();

    }
    ).then((formDisplay) => {
       
        formDisplayDiv.innerHTML = "";
        formDisplayDiv.innerHTML = formDisplay;
        const signUpBtn = document.querySelector('#signUpBtn');
        signUpBtn.addEventListener('click', (ev) => {
            ev.preventDefault();
            const signUpForm = document.querySelector('#signUpForm');
            const formData = new FormData(signUpForm);
            formData.append('register', "ok");
            fetch('./index.php', {
                method: 'POST',
                body: formData
            }).then((response) => {
                return response.text();
            }).then((data) => {
                const signUpMsg = document.querySelector('#signUpMsg');
                signUpMsg.innerHTML = "";
                signUpMsg.innerHTML = data;
                
            });
        });
    })
});

signInDisplay.addEventListener('click', (ev) => {
    ev.preventDefault();
    toggleDisplay();

    fetch('./connexion.html', {
        method: 'GET',

    }).then((response) => {
        return response.text();

    }
    ).then((formDisplay) => {
        const formDisplayDiv = document.querySelector('#formDisplayDiv');
        formDisplayDiv.innerHTML = "";
        formDisplayDiv.innerHTML = formDisplay;
        const signInBtn = document.querySelector('#signInBtn');
        signInBtn.addEventListener('click', (ev) => {
            ev.preventDefault();
            const signInForm = document.querySelector('#signInForm');
            const formData = new FormData(signInForm);
            formData.append('login', "ok");
            fetch('./index.php', {
                method: 'POST',
                body: formData
            }).then((response) => {
                return response.text();
            }).then((data) => {
                const signInMsg = document.querySelector('#signInMsg');
                signInMsg.innerHTML = "";
                signInMsg.innerHTML = data;
                
            });
        });
    })
});

