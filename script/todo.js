const addTodoBtn = document.querySelector('#addTodoBtn');

addTodoBtn.addEventListener('click', (ev) => {
    ev.preventDefault();
    const addTodoForm = document.querySelector('#addTodoForm');
    const formData = new FormData(addTodoForm);
    formData.append('addTodo', "ok");
    fetch('./index.php', {
        method: 'POST',
        body: formData
    }).then((response) => {
        return response.text();
    }).then((data) => {
        console.log(data);
       
    });
});