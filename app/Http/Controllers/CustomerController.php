<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    /**
     * Display all customers.
     */
    public function index()
    {
        $customers = User::where('role', 'user')
            ->latest()
            ->get();

        return view('customers.index', compact('customers'));
    }

    /**
     * Show create customer form.
     */
    public function create()
    {
        return view('customers.create');
    }

    /**
     * Store a new customer.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',

            'email' => [
                'required',
                'email',
                'max:255',
                'unique:users,email',
            ],

            'phone1' => 'required|string|max:30',

            'phone2' => 'nullable|string|max:30',

            'address' => 'required|string|max:1000',

            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
            ],
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],

            'phone1' => $validated['phone1'],

            'phone2' => $validated['phone2'] ?? null,

            'address' => $validated['address'],

            'password' => Hash::make($validated['password']),

            // Customer وليس Admin
            'role' => 'user',
        ]);

        return redirect()
            ->route('customers')
            ->with(
                'success',
                'Customer added successfully.'
            );
    }

    /**
     * Display a specific customer.
     */
    public function show(User $customer)
    {
        if ($customer->role !== 'user') {
            abort(404);
        }

        return view(
            'customers.show',
            compact('customer')
        );
    }

    /**
     * Show edit customer form.
     */
    public function edit(User $customer)
    {
        if ($customer->role !== 'user') {
            abort(404);
        }

        return view(
            'customers.edit',
            compact('customer')
        );
    }

    /**
     * Update customer.
     */
    public function update(
        Request $request,
        User $customer
    ) {
        if ($customer->role !== 'user') {
            abort(404);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',

            'email' => [
                'required',
                'email',
                'max:255',
                'unique:users,email,' . $customer->id,
            ],

            'phone1' => 'required|string|max:30',

            'phone2' => 'nullable|string|max:30',

            'address' => 'required|string|max:1000',

            'password' => [
                'nullable',
                'string',
                'min:8',
                'confirmed',
            ],
        ]);

        $customer->name = $validated['name'];

        $customer->email = $validated['email'];

        $customer->phone1 = $validated['phone1'];

        $customer->phone2 =
            $validated['phone2'] ?? null;

        $customer->address =
            $validated['address'];

        if (!empty($validated['password'])) {
            $customer->password =
                Hash::make($validated['password']);
        }

        // Customer يظل User
        $customer->role = 'user';

        $customer->save();

        return redirect()
            ->route('customers')
            ->with(
                'success',
                'Customer updated successfully.'
            );
    }

    /**
     * Delete customer.
     */
    public function destroy(User $customer)
    {
        if ($customer->role !== 'user') {
            abort(404);
        }

        // منع الأدمن من حذف نفسه
        if ($customer->id === auth()->id()) {
            return redirect()
                ->route('customers')
                ->with(
                    'error',
                    'You cannot delete your own account.'
                );
        }

        $customer->delete();

        return redirect()
            ->route('customers')
            ->with(
                'success',
                'Customer deleted successfully.'
            );
    }
}