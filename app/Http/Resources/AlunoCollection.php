<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class AlunoCollection extends ResourceCollection
{
    
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        /**
         * Qdo utilizada a convenção Laravel
         */
        // return parent::toArray($request);

        /**
         * Qdo NÃO utilizada a convenção Laravel e/ou necessidade de customização
         */
        return $this->collection;
    }
}
