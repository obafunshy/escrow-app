<?php

namespace App\Services;

class BlockonomicsService
{
    protected $apiKey;

    public function __construct($apiKey)
    {
        $this->apiKey = env('BLOCKONOMICS_API');
    }

    public function createPaymentLink($amount, $orderId, $callbackUrl)
    {
        // Use Blockonomics API to create a payment link
        // You may need to install an HTTP client package, like Guzzle, to make API requests

        // Sample request using Guzzle (install it via composer require guzzlehttp/guzzle)
        $httpClient = new \GuzzleHttp\Client();
        $response = $httpClient->post('https://www.blockonomics.co/api/new_address', [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->apiKey,
            ],
            'json' => [
                'amount' => $amount,
                'currency' => 'USD', // Adjust currency as needed
                'order_id' => $orderId,
                'callback' => $callbackUrl,
            ],
        ]);

        // Parse the response and return the payment link
        $responseData = json_decode($response->getBody(), true);

        return $responseData['address'];
    }

    public function checkPaymentStatus($address)
    {
        // Use Blockonomics API to check the payment status

        // Sample request using Guzzle
        $httpClient = new \GuzzleHttp\Client();
        $response = $httpClient->get("https://www.blockonomics.co/api/balance?addr=$address", [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->apiKey,
            ],
        ]);

        // Parse the response and return the payment status
        $responseData = json_decode($response->getBody(), true);

        return $responseData['confirmed'];
    }

    public function generateCallbackUrl()
    {
        // Use the route function to generate the callback URL
        $callbackUrl = route('blockonomics.callback');

        return $callbackUrl;
    }
}
