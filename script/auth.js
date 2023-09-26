const signUpFormDisplay = document.querySelector('#signUpFormDisplay');
const signInFormDisplay = document.querySelector('#signInFormDisplay');
const signInBtn = document.querySelector('#signInBtn');
const signUpBtn = document.querySelector('#signUpBtn');
const signUpDisplayBtn = document.querySelector('#signUpDisplayBtn');
const signInDisplayBtn = document.querySelector('#signInDisplayBtn');

function hideSignUpForm() {
    signUpFormDisplay.style.display = "none";
}

signInDisplayBtn.addEventListener('click', (ev) => {
    ev.preventDefault();
    signInFormDisplay.style.display = "block";
    signUpFormDisplay.style.display = "none";
});

signUpDisplayBtn.addEventListener('click', (ev) => {
    ev.preventDefault();
    signUpFormDisplay.style.display = "block";
    signInFormDisplay.style.display = "none";
});

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
        if(data == "Succesfully Submitted") {
        setTimeout(function() {
            window.location.href = './index.php';
        }, 2000);
    }
    });
});




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

        if(data == "Welcome") {
            setTimeout(function() {
                window.location.href = './todo.php';
            }, 2000);
        }

    });
});


hideSignUpForm();
