<?php

namespace App\Http\Controllers\Other;

use App\Http\Controllers\Controller;
use App\Models\MyCourse;
use App\Models\Order;
use App\Models\PaymentLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class TripayCallbackController extends Controller
{
    protected $privateKey = 'lPrXv-lwndJ-aqKhJ-kAwcQ-exYQW';

    public function handle(Request $request)
    {
        $callbackSignature = $request->server('HTTP_X_CALLBACK_SIGNATURE');
        $json = $request->getContent();
        $signature = hash_hmac('sha256', $json, $this->privateKey);

        if ($signature !== (string) $callbackSignature) {
            return Response::json([
                'success' => false,
                'message' => 'Invalid signature',
            ]);
        }

        if ('payment_status' !== (string) $request->server('HTTP_X_CALLBACK_EVENT')) {
            return Response::json([
                'success' => false,
                'message' => 'Unrecognized callback event, no action was taken',
            ]);
        }

        $data = json_decode($json);

        if (JSON_ERROR_NONE !== json_last_error()) {
            return Response::json([
                'success' => false,
                'message' => 'Invalid data sent by tripay',
            ]);
        }

        $invoiceId = $data->merchant_ref;
        $OrderId = explode('-', $invoiceId);
        $tripayReference = $data->reference;
        $status = strtoupper((string) $data->status);

        if ($data->is_closed_payment === 1) {
            $invoice = Order::where('id', $OrderId)
                ->where('tripay_reference', $tripayReference)
                ->where('status', 'PENDING')
                ->first();

            if (! $invoice) {
                return Response::json([
                    'success' => false,
                    'message' => 'No invoice found or already paid: ' . $invoiceId,
                ]);
            }

            switch ($status) {
                case 'PAID':
                    $invoice->update(['status' => 'PAID']);
                    MyCourse::create([
                        'user_id' => $invoice->user_id,
                        'course_id' => $invoice->course_id
                    ]);
                    break;

                case 'EXPIRED':
                    $invoice->update(['status' => 'EXPIRED']);
                    break;

                case 'FAILED':
                    $invoice->update(['status' => 'FAILED']);
                    break;

                default:
                    return Response::json([
                        'success' => false,
                        'message' => 'Unrecognized payment status',
                    ]);
            }

            PaymentLog::create([
                'status' => $status,
                'payment_type' => $data->payment_method,
                'raw_response' => $data,
                'order_id' => $OrderId
            ]);

            return Response::json(['success' => true]);
        }
    }
}
