<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        /* return parent::toArray($request); */

        return [
           'id' => $this->id,
           'title' => $this->title,
           'body'  => $this->body
        ];
    }

    /*
    Test via postman
    public function with($request)
    {
        return [
            'version'    => '1.0.0',
            'author_url' => url('https://mydomainapi.com')
        ];
    }
    */
}