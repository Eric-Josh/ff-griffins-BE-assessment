<?php

namespace App\Http\Controllers;

use App\Models\WalletType;
use App\Http\Resources\WalletTypeResource;
use Illuminate\Http\Request;

class WalletTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return WalletTypeResource::collection(WalletType::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required','string'],
            'minimum_balance' => ['required','numeric'],
            'monthly_interest_rate' => ['required','numeric'],
        ]);

        WalletType::create($data);

        return response([
            'message' => 'Wallet type added.'
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $type = WalletType::findOrFail($id);

        return new WalletTypeResource($type);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $type = WalletType::findOrFail($id);

        $data = $request->validate([
            'name' => ['required','string'],
            'minimum_balance' => ['required','numeric'],
            'monthly_interest_rate' => ['required','numeric'],
        ]);

        $type->update($data);

        return response([
            'message' => 'Wallet type updated.'
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $type = WalletType::findOrFail($id);

        $type->delete();

        return response([
            'message' => 'Wallet type deleted.'
        ]);
    }
}
