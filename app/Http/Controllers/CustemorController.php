<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    public function index()
{
    $customers = DB::table('customers')
        ->select(
            'customers.*',
            DB::raw('(
                SELECT COUNT(*)
                FROM orders
                WHERE orders.Customer_Name = customers.Name
            ) as Orders_Count')
        )
        ->orderBy('Customer_ID', 'desc')
        ->get();

    return view('customers', compact('customers'));
}

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:150|unique:customers,Email',
            'phone' => 'nullable|string|max:30',
            'status' => 'required|in:Active,Inactive',
        ]);

        DB::table('customers')->insert([
            'Name' => $request->name,
            'Email' => $request->email,
            'Phone' => $request->phone,
            'Status' => $request->status,
        ]);

        return redirect()
            ->route('customers')
            ->with('success', 'Customer added successfully.');
    }

    public function edit($id)
    {
        $customer = DB::table('customers')
            ->where('Customer_ID', $id)
            ->first();

        if (!$customer) {
            return redirect()
                ->route('customers')
                ->withErrors([
                    'customer' => 'Customer not found.'
                ]);
        }

        return view('customers-edit', compact('customer'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:150|unique:customers,Email,' . $id . ',Customer_ID',
            'phone' => 'nullable|string|max:30',
            'status' => 'required|in:Active,Inactive',
        ]);

        $customer = DB::table('customers')
            ->where('Customer_ID', $id)
            ->first();

        if (!$customer) {
            return redirect()
                ->route('customers')
                ->withErrors([
                    'customer' => 'Customer not found.'
                ]);
        }

        DB::table('customers')
            ->where('Customer_ID', $id)
            ->update([
                'Name' => $request->name,
                'Email' => $request->email,
                'Phone' => $request->phone,
                'Status' => $request->status,
            ]);

        return redirect()
            ->route('customers')
            ->with('success', 'Customer updated successfully.');
    }

    public function destroy($id)
    {
        $customer = DB::table('customers')
            ->where('Customer_ID', $id)
            ->first();

        if (!$customer) {
            return redirect()
                ->route('customers')
                ->withErrors([
                    'customer' => 'Customer not found.'
                ]);
        }

        DB::table('customers')
            ->where('Customer_ID', $id)
            ->delete();

        return redirect()
            ->route('customers')
            ->with('success', 'Customer deleted successfully.');
    }
}