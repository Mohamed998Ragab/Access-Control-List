<?php

namespace App\Domains\Permission\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PermissionResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'groups' => $this->groups,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}