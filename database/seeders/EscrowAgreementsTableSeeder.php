<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\EscrowAgreement;
use Illuminate\Database\Seeder;
use App\Services\BlockonomicsService;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class EscrowAgreementsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
            $blockonomicsService = new BlockonomicsService(env('BLOCKONOMICS_API'));

            // Seed multiple escrow agreements
            for ($i = 1; $i <= 3; $i++) {
                $buyerId = User::inRandomOrder()->value('id');
                $sellerId = User::where('id', '!=', $buyerId)->inRandomOrder()->value('id');

                $escrowAgreement = EscrowAgreement::create([
                    'buyer_id' => $buyerId,
                    'seller_id' => $sellerId,
                    'status' => 'pending',
                ]);

                // Generate payment link using BlockonomicsService
                $amount = 100.00; // Replace with your desired amount
                $orderId = $escrowAgreement->id;
                $paymentLink = $blockonomicsService->createPaymentLink($amount, $orderId, route('blockonomics.callback'));

                // Optionally, update the escrow agreement with the payment link
                $escrowAgreement->update(['payment_link' => $paymentLink]);
        }
    }
}
