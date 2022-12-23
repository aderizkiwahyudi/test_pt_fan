<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LoginResource extends JsonResource
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
            'token' => $this->token,
            'token_type' => 'Bearer',
            'data' => [
                "name" => $this->name,
                "email" => $this->email,
                "npp" => $this->npp,
                "npp_supervisor" => $this->npp_supervisor
            ],
            'message' => 'Login success',
        ];
    }
}
