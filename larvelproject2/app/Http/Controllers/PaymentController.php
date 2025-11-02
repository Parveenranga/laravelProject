<?php

use App\Services\PaymentService;

class PaymentController extends Controller
{
    protected $paymentService;

    public function __construct(PaymentService $paymentService)
    {
        $this->paymentService = $paymentService;
    }

    public function createOrder(Request $request)
    {
        $order = $this->paymentService->createOrder($request->amount);

        return response()->json([
            'order_id' => $order->id,
            'amount'   => $order->amount,
        ]);
    }
}
