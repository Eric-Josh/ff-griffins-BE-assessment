<?php

namespace App\Http\Controllers;

use App\Models\Wallet;
use App\Http\Resources\WalletResource;
use Illuminate\Http\Request;

class WalletController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $wallets = Wallet::with(['type','user'])->paginate(15);

        return WalletResource::collection($wallets);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = $request->user();

        $data = $request->validate([
            'walletTypeId' => ['required','numeric'],
        ]);

        Wallet::create([
            'wallet_tranx_id' => bin2hex(random_bytes(12)),
            'wallet_type_id' => $data['walletTypeId'],
            'balance' => 0.00,
            'user_id' => $user->id
        ]);

        return response([
            'message' => 'Wallet added.'
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $wallet = Wallet::where('id', $id)->with(['type','user'])->first();

        if(!$wallet) {
            return response([
                'message' => 'Wallet not found'
            ],404);
        }

        return new WalletResource($wallet);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $wallet = Wallet::findOrFail($id);

        $data = $request->validate([
            'amount' => ['required','numeric'],
        ]);

        $wallet->update([
            'balance' => $data['amount'],
        ]);

        return response([
            'message' => 'Wallet updated.'
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $wallet = Wallet::findOrFail($id);

        $wallet->delete();

        return response([
            'message' => 'Wallet deleted.'
        ]);
    }
}
