<?php

namespace App\Http\Resources\Auth;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        $user = $this['user'];
        $token = $this['token'];
        $status = $this['status'];
        $message = $this['message'];

        $roleName = $user && method_exists($user, 'getRoleNames')
            ? $user->getRoleNames()->first() ?? 'user'
            : 'user';

        return [
            'status' => $status,
            'message' => $message,
            'data' => [
                'token' => $token,
                $roleName => [
                    'id' => $user->id ?? null,
                    'name' => $user->name ?? null,
                    'username' => $user->username ?? null,
                    'phone' => $user->phone ?? null,
                    'email' => $user->email ?? null,
                ],
            ],
        ];
}
}
