<?php

namespace App\Exceptions;

use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Response;
use Throwable;

trait ApiHandler
{
    /**
     * Trata os erros personalizados
     *
     * @param Throwable $exception
     * @return Response
     */
    public function tratarErros(Throwable $exception): Response
    {
        //se ocorrer uma exceção do tipo específico
        if ($exception instanceof ModelNotFoundException) {

            return $this->modelNotFoundException();
        }

        //personalizando erros de validação
        if ($exception instanceof ValidationException) {

            return $this->validationException($exception);
        }
    }

    /**
     * Retorna o erro quando não encontrado o registro
     *
     * @return Response
     */
    public function modelNotFoundException(): Response
    {
        return $this->repostaPadrao(
            'registro não encontrado',
            'o sistema não encontrou o registro que você está buscando',
            404
        );
    }

    /**
     * Retorna o erro quando os dados são inválidos
     *
     * @param ValidationException $e
     * @return Response
     */
    public function validationException(ValidationException $e): Response
    {
        return $this->repostaPadrao(
            'erro de validação',
            'os dados enviados são inválidos',
            404,
            $e->errors()
        );
    }

    /**
     * Retorna uma resposta padrão para os erros da API
     *
     * @param string $code
     * @param string $message
     * @param integer $status
     * @param array|null $errors
     * @return Response
     */
    public function repostaPadrao(
            string $code, 
            string $message, 
            int $status, 
            array $errors = null
        ): Response
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
