<?php

namespace App\Http\Controllers;

use App\Models\OrderDetail;
use Illuminate\Http\Request;
use App\Http\Requests\StoreOrderDetailRequest;

class OrderDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->input('data');
        $book_id = $data['tempID'];
        $qty = $data['tempQty'];
        $order_id = $request->input('order_id');

        $orderDetail = new OrderDetail();
        $info = [];
        $info['book_id'] = $book_id;
        $info['order_id'] = $order_id;
        $info['qty'] = $qty;
        $orderDetail->fill($info);
        $orderDetail->save();

        return response()->json();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(OrderDetail $orderDetail = null, Request $request)
    {
        $data = $request->input('data');
        $book_id = $data['tempID'];
        $qty = $data['tempQty'];
        $order_id = $request->input('order_id');

        $info = [];
        $info['book_id'] = $book_id;
        $info['order_id'] = $order_id;
        $info['qty'] = $qty;
        $orderDetail->fill($info);
        $orderDetail->save();

        return response()->json();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


    public function deleteOrderDetails(string $id)
    {
        $old_order_details = OrderDetail::where('order_id', 'like', $id)->get();
        $old_order_details->delete();
    }
}
