<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\EscrowAgreement;
use App\Http\Controllers\Controller;
use App\Services\BlockonomicsService;

class TransactionController extends Controller
{
    protected $blockonomicsService;
    public function initiateTransaction(Request $request)
    {
         $request->validate([
            'user_id' => 'required|exists:users,id',
            'amount' => 'required|numeric|min:0.01',
            'escrow_agreement_id' => 'required|exists:escrow_agreements,id',
        ]);

        $transaction = Transaction::create($request->all());

         return response()->json(['message' => 'Transaction created successfully', 'data' => $transaction], 201);
    }

    public function updateStatus(Request $request, $transactionId)
    {
       $request->validate([
            'status' => 'required|in:completed,pending',
        ]);

       $transaction = Transaction::findOrFail($transactionId);

        $transaction->update(['status' => $request->status]);

        return response()->json(['message' => 'Transaction status updated successfully', 'data' => $transaction]);
    }

    public function releaseFunds($transactionId)
    {
        $transaction = Transaction::findOrFail($transactionId);

        if ($this->areEscrowConditionsMet($transaction->escrow_agreement)) {
           $transaction->update(['status' => 'completed']);

            return response()->json(['message' => 'Funds released successfully', 'data' => $transaction]);
        }

        return response()->json(['message' => 'Escrow conditions not met']);
    }

    private function areEscrowConditionsMet(EscrowAgreement $escrowAgreement)
    {
        if ($escrowAgreement->status === 'completed') {
            return true;
        }

        // not complete (probably user a and user b) clicks agreed and delivered. The employer is satisfied
        return false;
    }

    public function __construct(BlockonomicsService $blockonomicsService)
    {
        $this->blockonomicsService = $blockonomicsService;
    }

    public function handleCallback(Request $request)
    {
        // Validate the callback request, e.g., by checking signatures

        // Extract relevant information from the callback
        $address = $request->input('addr');
        $status = $request->input('status');

        // Check the payment status using the BlockonomicsService
        $paymentStatus = $this->blockonomicsService->checkPaymentStatus($address);

        // Update your transaction status based on the payment status
        if ($status === 'confirmed' && $paymentStatus) {
            // Update transaction status to 'completed'
            // You might also update other relevant information based on your business logic
            // For example, mark the escrow conditions as met
        }

        // Return a response to Blockonomics (usually a 200 OK response)
        return response()->json(['message' => 'Callback processed successfully']);
    }

    public function viewEscrowDashboard()
    {
        // Retrieve escrow agreements from the database
        $escrowAgreements = Transaction::where('status', '!=', 'completed')->get();

        return view('escrow.dashboard', compact('escrowAgreements'));
    }
}
