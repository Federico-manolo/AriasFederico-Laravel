<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use MercadoPago;

class MercadoPagoAPIController extends Controller
{
    public function processPayment(Request $request)
    {
        MercadoPago\SDK::setAccessToken("TEST-7049738388618660-062305-772c9ff026f1e4d81b8e58e7eadfe5a5-1176199339");
        
        $contents = $request->json()->all();
        
        $payment = new MercadoPago\Payment();
        $payment->transaction_amount = $contents['transaction_amount'];
        $payment->token = $contents['token'];
        $payment->installments = $contents['installments'];
        $payment->payment_method_id = $contents['payment_method_id'];
        $payment->issuer_id = $contents['issuer_id'];
        
        $payer = new MercadoPago\Payer();
        $payer->email = $contents['payer']['email'];
        $payer->identification = [
            "type" => $contents['payer']['identification']['type'],
            "number" => $contents['payer']['identification']['number']
        ];
        
        $payment->payer = $payer;
        $payment->save();
        
        $response = [
            'status' => $payment->status,
            'status_detail' => $payment->status_detail,
            'id' => $payment->id
        ];
        
        return response()->json($response);
    }
}
