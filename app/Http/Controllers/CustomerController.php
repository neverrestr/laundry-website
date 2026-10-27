<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::orderBy('name')->paginate(10);
        return view('customers.index', compact('customers'));
    }

    public function create()
    {
        return view('customers.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:50',
            'phone' => 'required|string|max:20',
            'address' => 'nullable|string|max:200',
        ]);

        Customer::create($data);
        return redirect()->route('customers.index')->with('success', 'Customer added.');
    }

    public function edit(Customer $customer)
    {
        return view('customers.edit', compact('customer'));
    }

    public function update(Request $request, Customer $customer)
    {
        $data = $request->validate([
            'name' => 'required|string|max:50',
            'phone' => 'required|string|max:20',
            'address' => 'nullable|string|max:200',
        ]);

        $customer->update($data);
        return redirect()->route('customers.index')->with('success', 'Customer updated.');
    }

    public function destroy(Customer $customer)
    {
        // Проверка: нельзя удалить клиента, если у него есть заказы
        if ($customer->bills()->exists()) {
            return back()->with('error', 'Customer has bills and cannot be deleted.');
        }
        
        $customer->delete();
        return redirect()->route('customers.index')->with('success', 'Customer deleted.');
    }
}