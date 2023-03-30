<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\OrderFile;

class OrderFileController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:order_file-index|order_file-create|order_file-edit|order_file-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:order_file-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:order_file-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:order_file-delete', ['only' => ['destroy']]);
    }
    public function index()
    {
        $order_files = OrderFile::paginate();
        return view('backend.order_file.index',compact('order_files'));
    }
    public function create()
    {
        return view('backend.order_file.create');
    }
    public function store(Request $request)
    {
        $data = $request->validate([

        ]);
        OrderFile::create($data);
        session()->flash('success');
        return redirect(route('order_file.index'));
    }
    public function edit(OrderFile $order_file)
    {
        return view('backend.order_file.create', compact('order_file'));
    }
    public function update(Request $request, OrderFile $order_file)
    {
        $data = $request->validate([
        ]);
        $order_file->update($data);
        session()->flash('success');
        return redirect(route('order_file.index'));
    }
    public function destroy(OrderFile $order_file)
    {
        $order_file->delete();
        session()->flash('success');
        return back();
    }
}