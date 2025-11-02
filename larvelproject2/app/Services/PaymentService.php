<?php

namespace App\Services;

use Razorpay\Api\Api;

class PaymentService
{
    protected $razorpay;

    public function __construct()
    {
        $this->razorpay = new Api(env('rzp_live_ShlrYe09ozYerk'), env('9Tduz0AQJRc3VVwq7g1kuMPK'));
    }

    public function createOrder($amount, $currency = 'INR', $receipt = null)
    {
        return $this->razorpay->order->create([
            'receipt'         => $receipt ?? uniqid(),
            'amount'          => $amount * 100, // Razorpay expects paisa
            'currency'        => $currency,
            'payment_capture' => 1,
        ]);
    }

    public function fetchPaymentDetails($paymentId)
    {
        return $this->razorpay->payment->fetch($paymentId);
    }

    public function verifySignature($attributes)
    {
        return \Razorpay\Api\Utility::verifyPaymentSignature($attributes);
    }
}
