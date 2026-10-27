<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::orderBy('name')->paginate(10);
        return view('services.index', compact('services'));
    }

    public function create()
    {
        return view('services.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:100',
            'price_per_unit' => 'required|numeric|min:1',
            'unit' => 'required|in:kg,item,pair',
        ]);
        Service::create($data);
        return redirect()->route('services.index')->with('success', 'Service added.');
    }

    public function edit(Service $service)
    {
        return view('services.edit', compact('service'));
    }

    public function update(Request $request, Service $service)
    {
        $data = $request->validate([
            'name' => 'required|string|max:100',
            'price_per_unit' => 'required|numeric|min:1',
            'unit' => 'required|in:kg,item,pair',
        ]);
        $service->update($data);
        return redirect()->route('services.index')->with('success', 'Service updated.');
    }

    public function destroy(Service $service)
    {
        if ($service->bills()->exists()) {
            return back()->with('error', 'Service is used in bills and cannot be deleted.');
        }
        $service->delete();
        return redirect()->route('services.index')->with('success', 'Service deleted.');
    }
}