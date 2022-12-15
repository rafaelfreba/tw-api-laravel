<?php

namespace App\Http\Resources;

use App\Services\LinksGenerator;
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
        $links = new LinksGenerator;
        $links->get(route('alunos.show', $this->id),'aluno.detalhe');
        $links->put(route('alunos.update', $this->id),'aluno.atualizar');
        //poderia fazer um if para verificar se pode exibir o link
        $links->delete(route('alunos.destroy', $this->id),'aluno.remover');

        //utilizando uma classe para gerar o HATEOAS
        return [
            'id' => $this->id,
            'nome' => strtoupper($this->nome),
            'nascimento' => date('d/m/Y', strtotime($this->nascimento)),
            'genero' => $this->genero == 'M' ? 'Masculino' : ($this->genero == 'F' ? 'Feminino' : 'Outro'),
            'turma' => new TurmaResource($this->whenLoaded('turma')),
            'links' => $links->toArray()
        ];
        
        //fazendo manualmente o HATEOAS
        // return [
        //     'nome' => strtoupper($this->nome),
        //     'nascimento' => date('d/m/Y', strtotime($this->nascimento)),
        //     'genero' => $this->genero == 'M' ? 'Masculino' : ($this->genero == 'F' ? 'Feminino' : 'Outro'),
        //     'turma' => new TurmaResource($this->whenLoaded('turma')),
        //     'links' =>[
        //         [
        //            'type' => 'GET',
        //            'url' => route('alunos.show', $this->id),
        //            'rel' => 'aluno_detalhes' 
        //         ],
        //         [
        //             'type' => 'PUT',
        //             'url' => route('alunos.update', $this->id),
        //             'rel' => 'aluno_atualizar' 
        //         ],
        //         [
        //             'type' => 'DELETE',
        //             'url' => route('alunos.destroy', $this->id),
        //             'rel' => 'aluno_remover' 
        //         ]
        //     ]
        // ];
    }
}
