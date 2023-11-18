<?php

namespace App\Http\Controllers;

use App\Models\Pessoa;
use Exception;
use Illuminate\Http\Request;

class PessoaController extends Controller
{
    public function index()
    {
        try {
            $pessoas = Pessoa::all();
            $message = $pessoas->count() . " " . ($pessoas->count() === 1 ? "pessoa encontrada" : "pessoas encontradas") . " com sucesso.";
            return $this->response($message, $pessoas);
        } catch (Exception $exception) {
            return $this->response($exception->getMessage(), null, false, 500);
        }
    }
    public function store(Request $request)
    {
        try {
            $data = $request->all();

            $request->validate([
                'name' => 'string|min:2|max:150',
                'cpf' => 'string|min:11|max:14',
                'contact' => 'string|max:20'
            ]);

            $pessoa = Pessoa::create($data);
            $msg = $pessoa->name . " cadastrada com sucesso";
            return $this->response($msg,$pessoa);

        } catch (Exception $exception) {
            return $this->response($exception->getMessage(), null, false, 500);
        }
    }
    public function show($id)
    {
        try {
            $pessoa = Pessoa::find($id);

            if (empty($pessoa)) {
                return $this->response('Pessoa não encontrada', null, false, 404);
            }
            $msg = "Pessoa " . $pessoa->name . " encontrada com sucesso.";
            return $this->response($msg, $pessoa);
        } catch (Exception $exception) {
            return $this->response($exception->getMessage(), null, false, 500);
        }
    }
    public function update(Request $request, string $id)
    {
        try {
            $request->validate([
                    'name' => 'string|min:2|max:150',
                    'cpf' => 'string|min:11|max:14',
                    'contact' => 'string|max:20'
            ]);

            $pessoa = Pessoa::find($id);

            if (empty($pessoa)) {
                return $this->response('Pessoa não encontrada.', null, false, 404);
            }

            $pessoa->update($request->all());
            $msg = $pessoa->name . " atualizado com sucesso.";
            return $this->response($msg, $pessoa);
        } catch (Exception $exception) {
            return $this->response($exception->getMessage(), null, false, 500);
        }
    }
    public function destroy(string $id)
    {
        try {
            $pessoa = Pessoa::find($id);

            if (empty($pessoa)) {
                return $this->response('Pessoa não encontrada', null, false, 404);
            }
            $success = Pessoa::destroy($id);
            return $this->response("Pessoa $pessoa->name excluida com sucesso", null);
        } catch (Exception $exception) {
            return $this->response($exception->getMessage(), null, false, 500);
        }
    }
}
