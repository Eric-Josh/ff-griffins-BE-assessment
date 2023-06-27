<?php

namespace App\Http\Controllers;

use App\Models\Wallet;
use App\Models\Transaction;
use App\Http\Resources\TransactionResource;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transactions = Transaction::with(['user','fromWallet','toWallet'])->paginate(15);

        return TransactionResource::collection($transactions);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = $request->user();

        $data = $request->validate([
            'fromWalletId' => ['required','string'],
            'toWalletId' => ['required','string'],
            'amount' => ['required','numeric']
        ]);

        try {
            $transact = $this->transact($data);
        } catch (\Exception $th) {
            return response([ 
                'message' => $th->getMessage()
            ],422);
        }

        $transaction = Transaction::create([
            'tranx_ref' => bin2hex(random_bytes(14)),
            'user_id' => $user->id,
            'from_wallet_id' => $transact['fWalletId'],
            'to_wallet_id' => $transact['tWalletId'],
            'amount' => $data['amount'],
            'tranx_fee' => 0,
            'type' => 'wallet_to_wallet',
            'status' => $transact['status']
        ]);

        return response([
            'message' => 'You transfer of NGN '.$data['amount'].' has been successful. You new balance is NGN '.$transact['fbalance'],
            'data' => new TransactionResource($transaction)
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $transaction = Transaction::where('id', $id)->with(['user','fromWallet','toWallet'])->first();

        if(!$transaction) {
            return response([
                'message' => 'Transaction not found'
            ],404);
        }

        return new TransactionResource($transaction);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    private function transact($data)
    {
        /**
         * Check if tWalletId exist
         * Check if fromWalletId has sufficient amount
         */

        $toWalletId = Wallet::where('wallet_tranx_id', $data['toWalletId']);
        if(!$toWalletId->first()) {
            throw new \Exception("Destination wallet ID is invalid.", 1);
        }

        $fromWalletId = Wallet::where('wallet_tranx_id', $data['fromWalletId']);
        if($data['amount'] > $fromWalletId->first()->balance) {
            throw new \Exception("Insufficient balance.", 1);
        }

        $fbalance = $fromWalletId->first()->balance - $data['amount'];
        $tbalance = $fromWalletId->first()->balance + $data['amount'];

        $fromWalletId->update(['balance' => $fbalance]);
        $toWalletId->update(['balance' => $tbalance]);

        return [
            'fWalletId' => $fromWalletId->first()->id,
            'tWalletId' => $toWalletId->first()->id,
            'fbalance' => $fbalance,
            'status' => 'successful'
        ];
    }
}
