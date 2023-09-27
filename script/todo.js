const addTodoBtn = document.querySelector('#addTodoBtn');
const todoList = document.querySelector('#todoList');
const doneList = document.querySelector('#doneList');
const todoMsg = document.querySelector('#todoMsg');

const colors = ["#E7CFCD", "#B5C9C3", "#CAB1BD", "#E5E6E4", "#FBFBF2", "#C9DCB3", "#C7EFCF", "#EEF5DB", "#63CCCA", "#D183C9", "#E3879E", "#FAB3A9", "#9AE5E6", "#A8F9FF", "#8FB8DE", "#FAA275"]


addTodoBtn.addEventListener('click', (ev) => {
    ev.preventDefault();
    const addTodoForm = document.querySelector('#addTodoForm');
    const formData = new FormData(addTodoForm);
    formData.append('addTodo', "ok");

    fetch('./todo.php', {
        method: 'POST',
        body: formData
    })
    .then((response) => response.text())
    .then((data) => {
        todoMsg.innerHTML = data;
        getTodos(); 
        getTodosDone(); 
    });
});

async function getTodos() {
    const response = await fetch('./todo.php?getTodos');
    const data = await response.json();

    todoList.innerHTML = '';
    const ul = document.createElement('ul');
    ul.className = "mt-4";

    data.forEach((list) => {
        const randomIndex = Math.floor(Math.random() * colors.length);
        const randomColor = colors[randomIndex];
        const li = document.createElement('li');
        li.className = "p-1 m-2 border border-white rounded-md bg-[#f8e3ba]";
        const liDiv = document.createElement('div');
        liDiv.className = "m-4 ml-6 flex items-center space-x-2";
        const titleDiv = document.createElement('div');
        titleDiv.className = "flex-1 min-w-0";
        const title = document.createElement('p');
        title.className = "text-lg text-gray-500 truncate dark:text-gray-400";
        const checkbox = document.createElement('input');
        checkbox.type = "checkbox";
        checkbox.className = "mr-5 w-6 h-6 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500";

        title.textContent = list.todo;
        li.style.backgroundColor = randomColor;
        titleDiv.appendChild(title);
        liDiv.appendChild(titleDiv);
        liDiv.appendChild(checkbox);
        li.appendChild(liDiv);
        ul.appendChild(li);

        checkbox.addEventListener('change', (event) => {
            
            if (event.target.checked) {
                const id_task = new FormData();
                id_task.append('id_task', list.id);
                id_task.append('done', "ok");
                fetch('./todo.php', {
                    method: 'POST',
                    body: id_task
                })
                .then((response) => response.text())
                .then((data) => {
                    todoMsg.innerHTML = data;
                    getTodos(); 
                    getTodosDone(); 
                });
            }
        });
    });

    todoList.appendChild(ul);
}

async function getTodosDone() {
    const response = await fetch("./todo.php?getTodosDone");
    const data = await response.json();

    doneList.innerHTML = '';
    const ul = document.createElement('ul');
    ul.className = "mt-4";

    data.forEach((list) => {
        const randomIndex = Math.floor(Math.random() * colors.length);
        const randomColor = colors[randomIndex];

        const li = document.createElement('li');
        li.className = "p-1 m-2 border border-[#f8e3ba] rounded-md bg-[#f8e3ba]";
        const liDiv = document.createElement('div');
        liDiv.className = "m-4 ml-6 flex items-center space-x-2";
        const titleDiv = document.createElement('div');
        titleDiv.className = "flex-1 min-w-0";
        const title = document.createElement('p');
        title.className = "text-lg text-gray-500 truncate dark:text-gray-400";
        const button = document.createElement('button');
        const img = document.createElement('img');
        img.className = "w-5 h-5";
        img.src = "public/bin.png";
        button.appendChild(img);
        title.textContent = list.todo;
        
        li.style.backgroundColor = randomColor;

        titleDiv.appendChild(title);
        liDiv.appendChild(titleDiv);
        liDiv.appendChild(button);
        li.appendChild(liDiv);
        ul.appendChild(li);

        button.addEventListener('click', (event) => {
            
            const id_task = new FormData();
            id_task.append('id_task', list.id);
            id_task.append('delete', "ok");
            fetch('./todo.php', {
                method: 'POST',
                body: id_task
            })
            .then((response) => response.text())
            .then((data) => {
                todoMsg.innerHTML = data;
                getTodos(); 
                getTodosDone();
            });
        });
    });

    doneList.appendChild(ul);
}

getTodos();
getTodosDone();
