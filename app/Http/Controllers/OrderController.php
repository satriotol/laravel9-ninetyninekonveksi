<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:order-index|order-create|order-edit|order-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:order-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:order-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:order-delete', ['only' => ['destroy']]);
    }
    public function index()
    {
        $orders = Order::paginate();
        return view('backend.order.index', compact('orders'));
    }
    public function create()
    {
        return view('backend.order.create');
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'nullable',
            "title" => 'required',
            "name" => 'required',
            "phone" => 'required',
            "start_at" => 'required',
            "end_at" => 'required',
            "description" => 'required'
        ]);
        $data['user_id'] = Auth::user()->id;
        Order::create($data);
        session()->flash('success');
        return redirect(route('order.index'));
    }
    public function edit(Order $order)
    {
        return view('backend.order.create', compact('order'));
    }
    public function update(Request $request, Order $order)
    {
        $data = $request->validate([
            'user_id' => 'nullable',
            "title" => 'required',
            "name" => 'required',
            "phone" => 'required',
            "start_at" => 'required',
            "end_at" => 'required',
            "description" => 'required'
        ]);
        $order->update($data);
        session()->flash('success');
        return redirect(route('order.index'));
    }
    public function destroy(Order $order)
    {
        $order->delete();
        session()->flash('success');
        return back();
    }
}