<?php

namespace App\Exceptions;

use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Throwable;

trait ApiHandler
{
    public function tratarErros(Throwable $exception)
    {
        //se ocorrer uma exceção do tipo específico
        if ($exception instanceof ModelNotFoundException) {
            return $this->repostaPadrao(
                'registro não encontrado',
                'o sistema não encontrou o registro que você está buscando',
                404
            );
        }
        //personalizando erros de validação
        if ($exception instanceof ValidationException) {
            return $this->repostaPadrao(
                'erro de validação',
                'os dados enviados são inválidos',
                404,
                $exception->errors()
            );
        }
    }

    public function repostaPadrao(string $code, string $message, int $status, array $errors = null)
    {
        $dadosResposta = [
            'code' => $code,
            'message' => $message,
            'status' => $status
        ];

        if ($errors) {
            array_push($dadosResposta, ['errors' => $errors]);
        }

        return response($dadosResposta, $status);
    }
}
