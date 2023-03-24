<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\OrderPayment;

class OrderPaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:order_payment-index|order_payment-create|order_payment-edit|order_payment-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:order_payment-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:order_payment-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:order_payment-delete', ['only' => ['destroy']]);
    }
    public function index()
    {
        $order_payments = OrderPayment::paginate();
        return view('backend.order_payment.index', compact('order_payments'));
    }
    public function create()
    {
        return view('backend.order_payment.create');
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'order_id' => 'required',
            'value' => 'required',
            'real_value' => 'nullable',
            'date' => 'required',
        ]);
        OrderPayment::create($data);
        session()->flash('success');
        return back();
    }
    public function edit(OrderPayment $order_payment)
    {
        return view('backend.order_payment.create', compact('order_payment'));
    }
    public function update(Request $request, OrderPayment $order_payment)
    {
        $data = $request->validate([]);
        $order_payment->update($data);
        session()->flash('success');
        return redirect(route('order_payment.index'));
    }
    public function destroy(OrderPayment $order_payment)
    {
        $order_payment->delete();
        session()->flash('success');
        return back();
    }
}
