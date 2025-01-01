function newBoard(nomeQuadro){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
   
    $.ajax({

        url: '/home/new',
        dataType : 'json',
        type: 'POST',
        contentType: 'application/json',
        data: JSON.stringify({board_name:nomeQuadro}),
        success:function(response) {
            console.log(response);
        }
    });
}

function deleteBoard(){

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({

        url: window.location.href,
        dataType : 'json',
        type: 'DELETE',
        contentType: 'application/json',
        data: {},
        success:function(response) {
            console.log(response);
        }
    });
}


document.getElementById("add_quadro").addEventListener("click", function () {

    let myNodeList = document.getElementsByTagName('span');

    let quadros = []
    for (i = 0; i < myNodeList.length; i++) {
        quadros.push(myNodeList[i].innerHTML)
    }



    let nomeQuadro = prompt("Insira o nome do quadro abaixo:");

    if (nomeQuadro == null || nomeQuadro == "") {
        
    }else if(quadros.includes(nomeQuadro)){
        alert('Quadro já existe!')
    } else {

        //POST para criação de boards
        newBoard(nomeQuadro);

        //Criação de boards no front
        let span = document.createElement("span");
        span.className = "align-text-bottom"
        span.innerHTML = nomeQuadro;
        
        let a = document.createElement("a");
        a.className = "list-group-item list-group-item-action"
        a.href = "/home/"+nomeQuadro
        a.append(span)

        let li = document.createElement("li");
        li.className = "list-group-item"
        li.append(a)

        let ul_quadros = document.getElementById('ul_quadros');
        ul_quadros.append(li)
    }


})