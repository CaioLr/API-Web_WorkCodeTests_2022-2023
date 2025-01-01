

function deleteTask(id_delete){

    let id_task = id_delete.slice(-1);
    // Determinando qual elemento foi selecionado
    let children = [] 
    let childNodes =  document.getElementById('div_tarefas').childNodes;
   childNodes.forEach(element => {
        if(element.className == 'input-group mb-2') children.push(element);
   });


    let id_order;
    let button_id = [];
     // Determinando sua ordem para enviar na requisição
   children.forEach(child => {
        child.childNodes.forEach(element => {
            if(element.className == "btn btn-outline-danger"){
                
                button_id.push(element.id);
            }
        });
   });


    for (let i = 0; i < children.length; i++) {

        if(button_id[i] == id_delete) id_order = i;
    }

    //Removendo no front
    let node = document.getElementById('div_'+id_task);

    if (node.parentNode) {
        node.parentNode.removeChild(node);
    }

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({

        url: window.location.href + '/' + id_order,
        dataType : 'json',
        type: 'DELETE',
        contentType: 'application/json',
        data: {},
        success:function(response) {
            console.log(response);
        }
    });
}

function newTask(){

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({

        url: '/home/task/new',
        dataType : 'json',
        type: 'POST',
        contentType: 'application/json',
        data: {},
        success:function(response) {
            console.log(response);
        }
    });
}

function saveTask(){
    // Determinando qual elemento foi selecionado
    let myNodeList = document.getElementsByTagName('input');
    myNodeList = document.getElementsByClassName('form-control');

    let tasks = []; 
    
    for (i = 0; i < myNodeList.length; i++) {
        tasks.push(myNodeList[i].value)
    }


    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({

        url: '/home/task/update',
        dataType : 'json',
        type: 'PUT',
        contentType: 'application/json',
        data: JSON.stringify({tasks:tasks}),
        success:function(response) {
            console.log(response);
        }
    });
}

function saveTaskChecked(){
    // Determinando qual elemento foi selecionado
    let myNodeList = document.getElementsByTagName('input');
    myNodeList = document.getElementsByClassName('form-check-input');

    let tasksChecked = []; 
    
    for (i = 0; i < myNodeList.length; i++) {
        tasksChecked.push(myNodeList[i].checked)
    }


    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({

        url: '/home/task/updateChecked',
        dataType : 'json',
        type: 'PUT',
        contentType: 'application/json',
        data: JSON.stringify({tasksChecked:tasksChecked}),
        success:function(response) {
            console.log(response);
        }
    });
}


function changeText(id){ //Função para realizar a marcação no front
    
    let num = id.slice(-1);
    let style = 'text-decoration:none'

    if(document.getElementById('checkbox_'+num).checked){
        style = 'text-decoration:line-through'
    }

    text = document.getElementById('text_'+num);
    text.style = style;
}



//Add tarefa
document.getElementById("add_tarefa").addEventListener("click", function () {

    newTask(); //Adicionando tarefa no BD

    // CHECKBOX

    let id_checkbox = "checkbox_0";
    if(document.getElementsByName('checkbox')){
        id_checkbox = "checkbox_" + document.getElementsByName('checkbox').length;
    }

    let checkbox = document.createElement("input");
    checkbox.className = "form-check-input";
    checkbox.name = "checkbox"
    checkbox.type = "checkbox";
    checkbox.id = id_checkbox;
    checkbox.addEventListener("change", saveTaskChecked); 
    checkbox.setAttribute("onclick","changeText(this.id);");
    checkbox.style = "margin: 10px";

    // TEXT

    let id_text = "text_0";
    if(document.getElementsByName('text')){
        id_text = "text_" + document.getElementsByName('text').length;
    }

    let text = document.createElement("input");
    text.className = "form-control";
    text.addEventListener("change", saveTask); 
    text.type = "text";
    text.id = id_text;
    text.name = "text";

    // EXCLUIR

    let id_excluir = "excluir_0";
    if(document.getElementsByName('rm_tarefa')){
        id_excluir = "excluir_" + document.getElementsByName('rm_tarefa').length;
    }

    let excluir = document.createElement("button");
    excluir.className = "btn btn-outline-danger";
    excluir.id = id_excluir;
    excluir.name = "rm_tarefa";
    excluir.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16"><path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/></svg>';
    excluir.setAttribute("onclick","deleteTask(this.id);");

    // DIV

    let id_div = "div_0";
    if(document.getElementsByClassName('input-group mb-2')){
        id_div = "div_" + document.getElementsByClassName('input-group mb-2').length;
    }

    let div = document.createElement("div");
    div.className = "input-group mb-2";
    div.id = id_div;
    div.append(checkbox);
    div.append(text);
    div.append(excluir);

    let div_tarefas = document.getElementById('div_tarefas');
    div_tarefas.append(div);

});

