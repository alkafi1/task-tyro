<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $data =  [
            'user_id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'role' => $this->role,
            // 'token' => $this->createToken('auth_token')->plainTextToken,
        ];
        // Include token if 'X-Include-Token' header is set to 'true'
        if ($request->header('X-Include-Token') === 'true') {
            $data['token'] = $this->createToken('auth_token')->plainTextToken;
        }

        return $data;
    }
}
