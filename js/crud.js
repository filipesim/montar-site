//Ao carregar a página remove o loading traz os usuários do banco de dados
window.onload = function(){
    setTimeout('$("#loading").fadeOut();', 500);

	readUser();
}

//Função para ler os usuários existentes
function readUser(){

    //Animação para suavizar a transição
    $('#data').animate({
		opacity: 0
    }, 200);

    //Limpando a lista HTML
    return_data.innerHTML = "";

    $.get("read-user",
    {
    },
    function(data){

        //Transformando o objeto JSON em objeto JavaScript
        var arrayUsers = JSON.parse(data);

        console.log(arrayUsers);

        //Laço de repetição para percorrer o array
        for(i = 0; i < arrayUsers.length; i++){

            //Separando a data da hora
            last_update = arrayUsers[i]['dt_last_update'].split(' ');

            //Acrescentando aos resultados da tabela cada usuário retornado no array
            $('#return_data').append(
                '<tr>'+
                    '<th scope="row">'+arrayUsers[i]['cd_user']+'</th>'+
                    '<td>'+
                        '<p>'+arrayUsers[i]['nm_user']+'</p>'+
                        '<p class="last-update">Atualizado em '+last_update[1]+' às '+last_update[0]+'</p>'+
                    '</td>'+
                    '<td class="d-flex flex-column flex-md-row">'+
                        //Botão para editar o usuário, chama a função no clique, enviando por parametro o ID do usuário
                        '<button type="button" class="btn btn-outline-primary" onclick="updateModal('+arrayUsers[i]['cd_user']+', \''+arrayUsers[i]['nm_user']+'\')">Editar</button>'+
                        //Botão para deletar o usuário, chama a função no clique, enviando por parametro o ID do usuário
                        '<button type="button" class="btn btn-outline-danger" onclick="confirmDelete('+arrayUsers[i]['cd_user']+')">Excluir</button>'+
                    '</td>'+
                '</tr>'
            );

        }
        
        //Finalizando a animação
        $('#data').animate({
			opacity: 1
		}, 200);

    }
    , "html");

}

//Clique no botão submit do modal
$('#submit').click(function(){

    //Bloqueando o botão para não mandar a mesma requisição mais de uma vez
    $('#submit').attr("disabled", "disabled");

    nm_user = name_user.value;

    //Verificando se o valor no input esta vazio desconsiderando espaços 
    if(nm_user.trim() == ""){

        alertError('O campo para o nome não pode estar vazio.');

    }
    else{

        //Separando o valor do input para verificar se tem pelo menos duas palavras
        word_count = nm_user.trim().split(" ");

        if(word_count.length <= 1){

            alertError('Informe seu nome completo.');

        }
        else{

            //Se o texto do botão for adicionar, manda para função de adicionar, se não, manda para função de atualizar
            if(submit.innerText == "Adicionar"){
                createUser();
            }
            else{
                updateUser();
            }

        }

    }

});

//Função para exibir o alerta de erro
function alertError(message){

    //Exibe o alerta e depois de 3 segundos remove o alerta
    $('#alert').css('display','block');
    $('#alert').animate({opacity: 1}, 500);

    $('#alert').text(message);
    
    setTimeout("$('#alert').animate({opacity: 0}, 500);", 3000);
    setTimeout("$('#alert').css('display','none');", 3500);

}

//Clique no botão Adicionar ajusta o modal para adição de usuários
$('#add_button').click(function(){

    //Alterando o texto do titulo do modal
    modal_title.innerText = "Adicionar Usuário"

    //Alterando o texto do botão submit
    submit.innerText = "Adicionar";

    //Limpando o input do modal
    name_user.value = "";

    //Limpando o usuário selecionado
    selected_user = "";

});

//Função para criar um usuário
function createUser(){

    $.post("create-user",
    {
        nm_user: name_user.value
    },
    function(data){

        //Atualizando a lista com o novo usuário
        readUser();

        //Removendo o atributo Disabled do botão
        $('#submit').removeAttr("disabled");

        //Fechando o modal
        $('#modal').modal('hide');

    }
    , "html");

}

//Variavel para armazenar o usuário selecionado
selected_user = "";

//Função para ajustar o modal para alteração de usuário
function updateModal(cd_user, nm_user){

    //Alterando o texto do titulo do modal
    modal_title.innerText = "Atualizar Usuário"

    //Alterando o texto do botão submit
    submit.innerText = "Atualizar";

    //Passando o nome do usuario para o input do modal
    name_user.value = nm_user;

    //Atualizando o usuário selecionado
    selected_user = cd_user;

    //Abrindo o modal
    $('#modal').modal('show');

}

//Função para editar um usuário
function updateUser(){

    $.post("update-user",
    {
        cd_user: selected_user,
        nm_user: name_user.value
    },
    function(data){

        //Atualizando a lista
        readUser();

        //Removendo o atributo Disabled do botão
        $('#submit').removeAttr("disabled");

        //Fechando o modal
        $('#modal').modal('hide');

    }
    , "html");

}

//Bloqueando entrada de numeros no campo de nome
$('#name_user').keypress(function(event){
    
    if(event.keyCode >= 48 && event.keyCode <= 57){
		return false;
    }
    
});

function confirmDelete(cd_user){

    //Atualizando o usuário selecionado
    selected_user = cd_user;

    //Abrindo o modal
    $('#delete_modal').modal('show');

}

//Função para deletar um usuário
function deleteUser(){

    $.post("delete-user",
    {
        cd_user: selected_user
    },
    function(data){

        //Fechando o modal
        $('#delete_modal').modal('hide');

        //Atualizando a lista
        readUser();

    }
    , "html");

}
