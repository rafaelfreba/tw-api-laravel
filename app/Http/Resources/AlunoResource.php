<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AlunoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'nome' => strtoupper($this->nome),
            'nascimento' => date('d/m/Y', strtotime($this->nascimento)),
            'genero' => $this->genero == 'M' ? 'Masculino' : ($this->genero == 'F' ? 'Feminino' : 'Outro'),
            'turma' => new TurmaResource($this->whenLoaded('turma'))
        ];
    }
}
