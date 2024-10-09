<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\VoucherMail;
use App\Models\User;
use App\Models\VoucherModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class VoucherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()

    {
        $vouchers=VoucherModel::all();

        return view('admin.voucher.index',compact('vouchers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Get all accounts for the voucher selection
        $accounts = User::all();
        return view('admin.voucher.addVoucher', compact('accounts'));
    }

    /**
     * Store a new voucher in the database and send an email if applicable to individuals.
     */
    public function store(Request $request)
    {
        // Validate incoming data
        $validatedData = $request->validate([
            'code' => 'required|unique:vouchers,code|max:50',
            'name_voucher' => 'required|max:255',
            'applicable_to' => 'required|in:private,public',
            'discount_type' => 'required|in:percentage,fixed',
            'discount_amount' => 'required|numeric|min:0',
            'start_date' => 'required|date',
            'expiration_date' => 'required|date|after_or_equal:start_date',
            'status' => 'required|in:active,inactive',
            'selected_users' => 'sometimes|array',
            'selected_users.*' => 'exists:users,id',
        ]);

        // Create new voucher
        $voucher = VoucherModel::create([
            'code' => $validatedData['code'],
            'name_voucher' => $validatedData['name_voucher'],
            'applicable_to' => $validatedData['applicable_to'],
            'discount_type' => $validatedData['discount_type'],
            'discount_amount' => $validatedData['discount_amount'],
            'start_date' => $validatedData['start_date'],
            'expiration_date' => $validatedData['expiration_date'],
            'usage_limit' => $validatedData['usage_limit'] ?? null,
            'status' => $validatedData['status'],
        ]);

        // If applicable to "private", send emails to selected users
        if ($validatedData['applicable_to'] === 'private' && isset($validatedData['selected_users'])) {
            $users = User::whereIn('id', $validatedData['selected_users'])->get();

            foreach ($users as $user) {
                Mail::to($user->email)->send(new VoucherMail($voucher));

                // Save the relationship in the user_vouchers table
                DB::table('user_vouchers')->insert([
                    'user_id' => $user->id,
                    'voucher_id' => $voucher->id_voucher,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        return redirect()->route('list.voucher')->with('success', 'Voucher đã được thêm thành công.');
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
