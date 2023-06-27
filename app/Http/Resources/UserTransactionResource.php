<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\WalletResource;
use App\Http\Resources\TransactionResource;

class UserTransactionResource extends JsonResource
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
            'name' => $this->name,
            'email' => $this->email,
            'emailVerified' => $this->email_verified_at ? true : false,
            'wallets' => WalletResource::collection($this->whenLoaded('wallets')),
            'transactions' => TransactionResource::collection($this->whenLoaded('transactions')),
            'createdAt' => $this->created_at,
        ];
    }
}
