const addTodoBtn = document.querySelector('#addTodoBtn');

addTodoBtn.addEventListener('click', (ev) => {
    ev.preventDefault();
    const addTodoForm = document.querySelector('#addTodoForm');
    const formData = new FormData(addTodoForm);
    formData.append('addTodo', "ok");
    fetch('./todo.php', {
        method: 'POST',
        body: formData
    }).then((response) => {
        return response.text();
    }).then((data) => {
        const todoMsg = document.querySelector('#todoMsg');
        todoMsg.innerHTML = "";
        todoMsg.innerHTML = data;
        
       
    });
});

function getTodos (){
    fetch('./todo.php?getTodos', {
        
    }).then((response) => {
        return response.json();
    }).then((data) => {
        console.log(data);

        const todoList = document.querySelector('#todoList');
        todoList.innerHTML = '';

        const ul = document.createElement('ul');
        ul.className = "mt-4 max-w-md";

        data.forEach((list) => {
            const li = document.createElement('li');
            li.className = "p-1";
            const liDiv = document.createElement('div');
            liDiv.className = "m-4 ml-5 flex items-center space-x-2";
            const titleDiv = document.createElement('div');
            titleDiv.className = "flex-1 min-w-0";
            const title = document.createElement('p');
            title.className = "text-sm text-gray-500 truncate dark:text-gray-400";
            const checkbox = document.createElement('input');
            checkbox.type = "checkbox";
            checkbox.className = "w-4 h-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500";

            title.textContent = list.todo;

            titleDiv.appendChild(title);
            liDiv.appendChild(titleDiv);
            liDiv.appendChild(checkbox);
            li.appendChild(liDiv);
            ul.appendChild(li);
        });

        todoList.appendChild(ul);
    });
}

getTodos();