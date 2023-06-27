<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\UserResource;
use App\Http\Resources\WalletTypeResource;

class WalletResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'walletId' => $this->wallet_tranx_id,
            'type' => new WalletTypeResource($this->whenLoaded('type')),
            'balance' => $this->balance,
            'owner' => new UserResource($this->whenLoaded('user')),
            'createdAt' => $this->created_at,
        ];
    }
}
