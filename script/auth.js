const signUpDisplay = document.querySelector('#signUpDisplay');
const signInDisplay = document.querySelector('#signInDisplay');

signUpDisplay.addEventListener('click', () => {

    fetch('./inscription.html', {
        method: 'GET',

    }).then((response) => {
        return response.text();

    }
    ).then((data) => {
        document.querySelector('#formDisplayDiv').innerHTML = data;

    }
    ).catch((error) => {
        console.log(error);
    }
)});

signInDisplay.addEventListener('click', () => {
    
        fetch('./connexion.html', {
            method: 'GET',
    
        }).then((response) => {
            return response.text();
    
        }
        ).then((data) => {
            document.querySelector('#formDisplayDiv').innerHTML = data;
    
        }
        ).catch((error) => {
            console.log(error);
        }
    )});