const signUpDisplay = document.querySelector('#signUpDisplay');
const signInDisplay = document.querySelector('#signInDisplay');

signUpDisplay.addEventListener('click', (ev) => {
    ev.preventDefault();

    fetch('./inscription.html', {
        method: 'GET',

    }).then((response) => {
        return response.text();

    }
    ).then((formDisplay) => {
        const formDisplayDiv = document.querySelector('#formDisplayDiv');
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
                const msg = document.createElement('p');
                msg.innerHTML = data;
                formDisplayDiv.appendChild(msg);
            });
        });
    })
});

signInDisplay.addEventListener('click', (ev) => {
    ev.preventDefault();

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
                const msg = document.createElement('p');
                
                msg.innerHTML = data;
                formDisplayDiv.appendChild(msg);
            });
        });
    })
});