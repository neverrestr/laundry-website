<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\Customer;
use App\Models\Service;
use Illuminate\Http\Request;

class BillController extends Controller
{
    public function index()
    {
        $bills = Bill::with(['customer', 'service'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);
        return view('bills.index', compact('bills'));
    }

    public function create()
    {
        $customers = Customer::orderBy('name')->get();
        $services = Service::orderBy('name')->get();
        return view('bills.create', compact('customers', 'services'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'service_id' => 'required|exists:services,id',
            'units' => 'required|integer|min:1|max:100',
        ]);

        $service = Service::findOrFail($data['service_id']);
        $data['charged'] = $service->price_per_unit * $data['units'];
        $data['status'] = 'queued';

        $bill = Bill::create($data);
        return redirect()->route('bills.show', $bill)->with('success', "Bill #{$bill->id} created.");
    }

    public function show(Bill $bill)
    {
        $bill->load(['customer', 'service']);
        return view('bills.show', compact('bill'));
    }

    public function advance(Bill $bill)
    {
        $next = match ($bill->status) {
            'queued' => 'finished',
            'finished' => 'departed',
            default => null,
        };

        if (!$next) {
            return back()->with('error', 'Bill is already collected.');
        }

        $bill->update(['status' => $next]);
        return back()->with('success', "Bill is now {$next}.");
    }

    public function destroy(Bill $bill)
    {
        if ($bill->status !== 'queued') {
            return back()->with('error', 'Only queued bills can be deleted.');
        }
        $bill->delete();
        return redirect()->route('bills.index')->with('success', 'Bill deleted.');
    }
}