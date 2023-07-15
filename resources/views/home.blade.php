@extends('layouts.main')

@section('title', 'Teste Laravel')

@section('content')

<div class="container text-center p-5 mt-5 ">
  <h1 class="text-muted display-5">Lista de clientes</h1>
</div>
<div class="container able-responsive">

    <!-- RESPOSTAS -->
    @if(session('success'))
        <div class="container w-50 alert alert-success text-center" role="alert">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
    <div class="container w-50 alert alert-danger text-center" role="alert">
        {{ session('error') }}
    </div>
    @endif

    @if(count($clientes) != 0)
    <table class="table">
        <thead class="table-light text-center">
          <tr>
            <th scope="col">Nome</th>
            <th>Email</th>
            <th>Telefone</th>
            <th>Menssagem</th>
            <th></th>
            <th></th>
          </tr>
        </thead>
        
        <tbody class="text-light">
            @foreach ($clientes as $cliente)
            <tr>
                <td class="text-center">{{$cliente->nome}}</td>
                <td class="text-center">{{$cliente->email}}</td>
                <td class="text-center">{{$cliente->telefone}}</td>

                <!-- VER MENSSAGEM -->
                <td class="text-center">
                    <a href="#" class="btn btn-success btn-sm btn_acao" data-bs-toggle="modal" data-bs-target="#verMSG{{$cliente->id}}">
                        <i class="bi bi-chat-left-text"></i>
                    </a>
                    <!-- MODAL VER MENSSAGEM -->
                    <div class="modal fade text-left" id="verMSG{{$cliente->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header border-0 text-muted">
                                    <h3>Menssagem:</h3>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body text-dark pb-5">
                                    {{$cliente->mensagem}}
                                </div>
                            </div>
                        </div>
                    </div>
                </td>

                <!-- EDITAR -->
                <td> 
                    <a href="#" class="btn btn-primary btn-sm btn_acao" data-bs-toggle="modal" data-bs-target="#editCliente{{$cliente->id}}">
                        <i class="bi bi-pencil-square"></i>
                    </a> 
                    <!-- MODAL EDITAR CLIENTE -->
                    <div class="modal fade text-left" id="editCliente{{$cliente->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header border-0 text-muted">
                                    <h3>Editar Cliente:</h3>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body text-dark pb-5">

                                    <!-- EDITAR NOME -->
                                    <form method="POST" action="/cliente/UPDTCLIENTE2312312" class="pb-5">
                                        @csrf
                                        <input type="hidden" name="id" value="{{$cliente->id}}">

                                        <div class="row g-3 ">
                                            <div class="col-sm-12 mb-3">
                                                <label for="nome">Nome <span class="text-danger">*</span></label>
                                                <input id="nome" type="text" class="form-control" name="nome" value="{{$cliente->nome}}" placeholder="digite seu nome e sobrenome" autofocus required>
                                            </div>

                                            <div class="col-sm-12 mb-3">
                                                <label for="email">Email <span class="text-danger">*</span></label>
                                                <input id="email" type="text" class="form-control" name="email" value="{{$cliente->email}}" placeholder="exemple@exemple" autofocus required>
                                            </div>

                                            <div class="col-sm-12 mb-3">
                                                <label for="tel">telefone <span class="text-danger">*</span></label>
                                                <input id="tel" type="text" class="form-control" name="tel" value="{{$cliente->telefone}}" placeholder="ex: 92993930042" pattern="^\d{11}$" required>
                                            </div>

                                            <div class="col-sm-12 mb-3">
                                                <label for="msg">Mensagem <span class="text-danger">*</span></label>
                                                <textarea id="msg" class="form-control" name="msg" autofocus required>{{$cliente->mensagem}}</textarea>
                                            </div>

                                        </div>
                                        <button type="submit" class="btn btn-primary w-100">ALterar Cliente</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>

                <!-- EXCLUIR -->
                <td> 
                    <a href="#" class="btn btn-danger btn-sm btn_acao" data-bs-toggle="modal" data-bs-target="#deletarCliente{{$cliente->id}}">
                        <i class="bi bi-trash"></i>
                    </a> 
                    <!-- MODAL DELETAR CLIENTE -->
                    <div class="modal fade" id="deletarCliente{{$cliente->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header border-0 text-muted">
                                    <h5>Confirme se deseja deletar.</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body text-dark">
                                    <p><b>Nome: {{$cliente->nome}}</b></p>
                                    <p><b>Email: {{$cliente->email}}</b></p>
                                    
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Fechar</button>
                                        <a class="btn btn-danger" href="/cliente/DELTASK2312312/{{$cliente->id}}">Deletar Cliente</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif

    <div class="p-5">

        <div class="text-center">
            <button class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#insertcliente">
                Inserir novo cliente
            </button>
        </div>
        
        <!-- MODAL INSERIR CLIENTE -->
        <div class="modal fade" id="insertcliente" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header border-0 text-muted">
                        <h5>Inserir novo cliente</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-dark">

                        <form method="POST" action="/cliente/INSERT2312312" class="pb-5">
                            @csrf
                            
                            <div class="col-sm-12 mb-3">
                                <label for="nome">Nome <span class="text-danger">*</span></label>
                                <input id="nome" type="text" class="form-control" name="nome" placeholder="digite seu nome e sobrenome" autofocus required>
                            </div>

                            <div class="col-sm-12 mb-3">
                                <label for="email">Email <span class="text-danger">*</span></label>
                                <input id="email" type="text" class="form-control" placeholder="exemple@exemple" name="email"autofocus required>
                            </div>

                            <div class="col-sm-12 mb-3">
                                <label for="tel">telefone <span class="text-danger">*</span></label>
                                <input id="tel" type="text" class="form-control" placeholder="ex: 92993930042" name="tel" pattern="^\d{11}$" required>
                            </div>

                            <div class="row g-3">
                                <div class="col-sm-12 mb-3">
                                    <label for="msg">Mensagem <span class="text-danger">*</span></label>
                                    <textarea id="msg" class="form-control" name="msg" autofocus required></textarea>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary w-100">Alterar Mensagem</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection