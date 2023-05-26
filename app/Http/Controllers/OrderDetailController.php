<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\OrderDetail;

class OrderDetailController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:order_detail-index|order_detail-create|order_detail-edit|order_detail-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:order_detail-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:order_detail-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:order_detail-delete', ['only' => ['destroy']]);
    }
    public function index()
    {
        $order_details = OrderDetail::paginate();
        return view('backend.order_detail.index', compact('order_details'));
    }
    public function create()
    {
        return view('backend.order_detail.create');
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'order_id' => 'nullable',
            "name" => 'required',
            "qty" => 'required',
            "price" => 'required',
            "original_price" => 'nullable'
        ]);
        OrderDetail::create($data);
        session()->flash('success');
        return back();
    }
    public function edit(OrderDetail $order_detail)
    {
        return view('backend.order_detail.create', compact('order_detail'));
    }
    public function update(Request $request, OrderDetail $order_detail)
    {
        $data = $request->validate([
            'order_id' => 'nullable',
            "name" => 'required',
            "qty" => 'required',
            "price" => 'required',
            "original_price" => 'nullable'
        ]);
        $order_detail->update($data);
        session()->flash('success');
        return back();
    }
    public function destroy(OrderDetail $order_detail)
    {
        $order_detail->delete();
        session()->flash('success');
        return back();
    }
}
