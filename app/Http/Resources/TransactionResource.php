<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use App\Http\Resources\WalletResource;
use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
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
            'tranx_ref' => $this->tranx_ref,
            'user' => new UserResource($this->whenLoaded('user')),
            'fromWallet' => new WalletResource($this->whenLoaded('fromWallet')),
            'toWallet' => new WalletResource($this->whenLoaded('toWallet')),
            'amount' => $this->amount,
            'tranxFee' => $this->tranx_fee,
            'type' => $this->type,
            'status' => $this->status,
            'tranxDate' => $this->created_at,
        ];
    }
}
