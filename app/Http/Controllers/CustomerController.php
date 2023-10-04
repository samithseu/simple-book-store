<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCustomerRequest;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $formData = [];
        $formData['filter_by'] = request('filter_by');
        $formData['search_value'] = request('search_value');
        $customers = [];
        if(!empty($formData['filter_by'])) {
            $query = '%'.$formData['search_value'].'%';
            $customers = Customer::where('name', 'LIKE', $query)
                         ->orWhere('address', 'LIKE', $query)
                         ->orWhere('phone', 'LIKE', $query)
                         ->paginate(4);
        } else {
            $customers = Customer::paginate(4);
        }
        return view('admin.customers.search', compact('formData', 'customers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.customers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCustomerRequest $request)
    {
        $customer = new Customer();
        $data = [];
        $data['name'] = $request->name;
        $data['address'] = $request->address;
        $data['phone'] = $request->phone;
        $customer->fill($data);
        try {
            $customer->save();
            return redirect()->route('customers.edit', $customer->id)->with('success', 'Customer created successfully!');
        } catch (\Throwable $th) {
            return back()->withInput()->withErrors($th->getMessage());
        }
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
    public function edit(Customer $customer)
    {
        return view('admin.customers.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Customer $customer = null)
    {
        $data = [];
        $data['name'] = request('name');
        $data['address'] = request('address');
        $data['phone'] = request('phone');
        $customer->fill($data);
        try {
            $customer->save();
            return redirect()->route('customers.create')->with('success', 'Customer updated successfully!');
        } catch (\Throwable $th) {
            return back()->withInput()->withErrors($th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        try {
            $customer->delete();
            return back()->with('success', 'Customer deleted successfully!');
        } catch (\Throwable $th) {
            return back()->withInput()->with('success', "Can't delete because it's in use!");
        }
    }
}
