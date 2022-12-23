<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EpresenceUserResource extends JsonResource
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
            'id' => $this->id,
            'user_id' => $this->user->id,
            'nama_user' => $this->user->name,
            'waktu_masuk' => '',
            'waktu_pulang' => '',
            'status_masuk' => '',
            'status_pulang' => '',
        ];
    }
}
