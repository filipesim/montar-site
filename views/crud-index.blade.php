@extends('layouts.crud-master')

@section('title', 'Crud Home')

@section('description', 'Crud desenvolvido para Montar Site')

@section('content')

    <!--extends permite que se "extenda" o modelo da crud-master.blade.php montando o conteúdo da página com base nas seções inseridas
    section são as seções que definimos em cada página-->

    <div class="container-fluid" id="content">
        <div class="d-flex flex-column flex-md-row">
            <div class="col-12 col-md-4" id="photo">
                <div class="d-flex flex-column justify-content-center align-items-center" id="gradient">
                    <h1>Crud</h1>
                    <p id="author">Developed by Filipe Simon</p>
                </div>
            </div>
            <div class="col-12 col-md-8" id="list">
                <h2>Usuários</h2>
                <div id="data">
                    <table class="table">
                        <tbody id="return_data">
                            <!--A ser preenchido pela função js responsavel por buscar os usuários no banco de dados-->
                        </tbody>
                    </table>

                    <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#modal" id="add_button">+ Adicionar</button>
                </div>
            </div>
        </div>
    </div>

    <!--Modal para criar e editar usuários-->
    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modal_title" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal_title">Adicionar Usuário</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="modal_close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-default">Nome</span>
                        </div>
                        <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" id="name_user">
                    </div>

                    <div class="alert alert-danger" role="alert" id="alert">
                        <!--A ser preenchido pela função js responsavel por validar os dados inseridos-->                
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-dark" data-dismiss="modal">Fechar</button>
                    <button type="button" class="btn btn-outline-success" id="submit">Adicionar</button>
                </div>
            </div>
        </div>
    </div>

    <!--Modal de confirmação para deletar usuários-->
    <div class="modal fade" id="delete_modal" tabindex="-1" role="dialog" aria-labelledby="delete_modal_title" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="delete_modal_title">Deletar Usuário</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Tem certeza que deseja deletar esse usuário?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-dark" data-dismiss="modal">Voltar</button>
                    <button type="button" class="btn btn-outline-danger" onclick="deleteUser()">Deletar</button>
                </div>
            </div>
        </div>
    </div>

@endsection