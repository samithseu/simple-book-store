<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Requests\StoreOrderRequest;
use App\Models\Order;
use App\Models\OrderDetail;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $formData = [];
        $formData['filter_by'] = request('filter_by');
        $formData['search_value'] = request('search_value');
        $orders = [];
        if(!empty($formData['filter_by'])) {
            $query = '%'.$formData['search_value'].'%';
            $orders = Order::latest()->where('id', 'LIKE', $query)
                         ->orWhere('customer_id', 'LIKE', $query)
                         ->paginate(4);
        } else {
            $orders = Order::latest()->paginate(4);
        }
        return view('admin.orders.search', compact('formData', 'orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $customers = Customer::select('id', 'name')->get();
        $books = Book::select('id', 'name', 'unit_price')->get();
        return view('admin.orders.create', compact('customers', 'books'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrderRequest $request)
    {
        $order = new Order();
        $data = [];
        $data['customer_id'] = $request->customer_id;
        $data['note'] = $request->note;
        $order->fill($data);

        try {
            $order->save();
            return response()->json(['success' => 'Order created successfully!', 'order_id' => $order->id]);
        } catch (\Throwable $th) {
            return back()->withInput()->withErrors($th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $order = Order::findOrFail($id);
        $order_details = OrderDetail::where('order_id', 'like', $id)->get();
        return view('admin.orders.invoice', compact('order', 'order_details'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        $customers = Customer::select('id', 'name')->get();
        $books = Book::select('id', 'name', 'unit_price')->get();
        $order_details = OrderDetail::where('order_id', 'LIKE', $order->id)->get();
        return view('admin.orders.edit', compact('order', 'customers', 'books', 'order_details'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $order = Order::find($request->input('order_id'));
        $data = [];
        $data['customer_id'] = $request->input("customer_id");
        $data['note'] = $request->input("note");
        $order->fill($data);
        $order->orderdetails()->delete();
        try {
            $order->save();
            return response()->json(['success' => 'Order updated successfully!']);
        } catch (\Throwable $th) {
            return back()->withInput()->withErrors($th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        try {
            $order->delete();
            return back()->with('success', 'Order deleted successfully!');
        } catch (\Throwable $th) {
            return back()->withInput()->with('success', "Can't delete because it's in use!");
        }
    }
}
