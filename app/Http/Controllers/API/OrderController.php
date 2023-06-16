<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\MyCourse;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    protected $merchantCode = 'T23015';
    protected $apiKey = 'DEV-w0Bow1hbgdvV0Xp92qxzwFlMOpNXQ4QYw48daTcw';
    protected $privateKey = 'lPrXv-lwndJ-aqKhJ-kAwcQ-exYQW';

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Get all data Order
        $order = Order::all();

        // Get all data order berdasarkan user yang login
        $user_id = $request->user()->id;
        if ($user_id) {
            $order = Order::where('user_id', $user_id)->get();
        }

        return ResponseFormatter::success(
            $order,
            'Data pesanan berhasil diambil'
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user' => ['required'],
            'course' => ['required']
        ]);

        $user = $request->input('user');
        $course = $request->input('course');

        $order = Order::create([
            'user_id' => $user['id'],
            'course_id' => $course['id']
        ]);

        if ($course['price'] == 0) {
            $order->update(['status' => 'PAID']);
            MyCourse::create([
                'user_id' => $user['id'],
                'course_id' => $course['id']
            ]);
        } else {
            $merchantRef  = $order->id.'-'.Str::random(7);
            $amount       = $course['price'];

            $signature = hash_hmac('sha256', $this->merchantCode.$merchantRef.$amount, $this->privateKey);

            $order_items[] = [
                'sku' => $merchantRef,
                'name' => $course['name'],
                'price' => $course['price'],
                'quantity' => 1,
            ];

            $data = [
                'method' => $request->bank_code,
                'merchant_ref'   => $merchantRef,
                'amount'         => $amount,
                'customer_name'  => $user['name'],
                'customer_email' => $user['email'],
                'customer_phone' => $user['phone'],
                'order_items' => $order_items,
                'expired_time' => (time() + (24 * 60 * 60)), // 24 jam
                'signature' => $signature
            ];

            $response = Http::withToken($this->apiKey)->post('https://tripay.co.id/api-sandbox/transaction/create', $data);

            $getData = json_decode($response);

            $order->checkout_url = $getData->data->checkout_url;
            $order->metadata = $course;
            $order->tripay_reference = $getData->data->reference;
            $order->save();
        }

        return ResponseFormatter::success(
            $order,
            'Berhasil membuat pesanan'
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
