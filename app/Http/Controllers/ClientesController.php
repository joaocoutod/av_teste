<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Clientes;

class ClientesController extends Controller
{   
    # LISTA DE CLIENTES
    public function home_view()
    {
        $clientes = Clientes::all();

        return view('home', ['clientes' => $clientes]);
    }

    # INSERT CLIENTE
    public function cliente_insert(Request $request)
    {
        # VALIDA NOME
        // Valida tamanho do nome
        $nome = trim($request->nome);
        if (strlen($nome) < 3 || strlen($nome) > 100) {
            return back()->with('error', 'Erro ao inserir novo cliente: O nome deve ter entre 3 e 100 caracteres.');
        }

        // Valida caracteres do nome
        if (!preg_match('/^[A-Za-z\s]+$/', $nome)) {
            return back()->with('error', 'Erro ao inserir novo cliente: O nome deve conter apenas letras.');
        }        

        # VALIDAR EMAIL
        // Verifica se o email já existe 
        $email = trim($request->email);
        if (Clientes::where('email', $email)->exists()) {
            return back()->with('error', 'Erro ao inserir novo cliente: O Email ('.$email.') já existe!');
        }

        // Valida formato do email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return back()->with('error', 'Erro ao inserir novo cliente: Endereço de e-mail inválido');
        }

        # VALIDAR TELEFONE
        // Verifica se já existe 
        $telefone = trim($request->tel);
        if (Clientes::where('telefone', $telefone)->exists()) {
            return back()->with('error', 'Erro ao inserir novo cliente: O Telefone ('.$telefone.') já existe!');
        }

        // Valida formato do telefone
        $telefoneNumerico = preg_replace('/\D/', '', $telefone);
        if (strlen($telefoneNumerico) !== 11) {
            return back()->with('error', 'Erro ao inserir novo cliente: número inserido parece estar incorreto.');
        }
        
        # VALIDAR MENSAGEM
        // Remove tags HTML da mensagem
        $mensagem = strip_tags($request->msg);

        // Cria novo cliente
        $cliente = new Clientes;
        $cliente->nome = $nome;
        $cliente->email = $email;
        $cliente->telefone = $telefone;
        $cliente->mensagem = $mensagem;
        $cliente->save();

        return redirect('/');
    }

    # UPDATE CLIENTE
    public function cliente_update(Request $request)
    {
        try {
            $cliente = Clientes::find($request->id);

            if (isset($request->email)) {
                // Validar email se foi alterado
                $email = trim($request->email);
                if ($cliente->email !== $email && Clientes::whereEmail($email)->exists()) {
                    return back()->with('error', 'Erro ao atualizar cliente: O email já está sendo usado por outro cliente.');
                }
            }

            // Validação dos campos
            $validator = Validator::make($request->all(), [
                'nome' => 'required|min:3|max:100',
                'email' => 'required|email',
                'tel' => 'required',
                'msg' => 'required',
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }

            // Atualizar os dados do cliente
            $cliente->nome = trim($request->nome);
            $cliente->email = trim($request->email);
            $cliente->telefone = trim($request->tel);
            $cliente->mensagem = strip_tags($request->msg);
            $cliente->save();

            return redirect('/')->with('success', 'Cliente atualizado com sucesso!');
        } catch (Exception $e) {
            return back()->with('error', 'Erro ao atualizar cliente: ' . $e->getMessage());
        }
    }



    // DELETAR CLIENTE
    public function cliente_delete($id)
    {
        // Deletar cliente
        $cliente = Clientes::where('id', $id)->value('nome');
        $delete_cliente = Clientes::where("id", $id)->delete();
        
        if (!$delete_cliente) {
            return back()->with('error', "Erro ao excluir o cliente: $cliente. Por favor, tente novamente.");
        }

        return back()->with('error', "O cliente de nome: $cliente foi excluído com sucesso.");
    }
}
