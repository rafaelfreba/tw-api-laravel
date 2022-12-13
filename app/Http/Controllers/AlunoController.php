<?php

namespace App\Http\Controllers;

use App\Models\Aluno;
use Illuminate\Http\Response;
use App\Http\Requests\AlunoRequest;
use App\Http\Resources\AlunoCollection;
use App\Http\Resources\AlunoResource;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class AlunoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AlunoCollection
     */
    public function index(Request $request): Alunocollection
    {
        // $a = 0/0; -> causa uma exceção
        //Aluno::get()->makeHidden('turma_id') ->esconde o atributo
        //Aluno::get()->makeVisible('created_at') ->exibe o atributo
        if($request->query('relacao') == 'turma')
        {
            $alunos = Aluno::with('turma')->paginate(2);

        }else {

            $alunos = Aluno::paginate(2);
        }
        
        return new AlunoCollection($alunos);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\AlunoRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(AlunoRequest $request): Response
    {
        return response(Aluno::create($request->all()), 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  Aluno $aluno
     * @return AlunoResource
     */
    public function show(Aluno $aluno): AlunoResource
    {
        //utilizando uma camada de transformação (api resource) para apenas um item
        return new AlunoResource($aluno);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\AlunoRequest  $request
     * @param  Aluno $aluno
     * @return Aluno
     */
    public function update(AlunoRequest $request, Aluno $aluno): Aluno
    {
        $aluno->update($request->safe()->all());

        return $aluno;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Aluno $aluno
     * @return array
     */
    public function destroy(Aluno $aluno): array
    {
        $aluno->delete();
        return [];
    }
}
