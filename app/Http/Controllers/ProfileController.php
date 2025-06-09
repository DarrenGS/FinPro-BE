<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\User; // Make sure to import the User model

class ProfileController extends Controller
{
   
    /**
     * Show the form for topping up user balance.
     *
     * @return \Illuminate\View\View
     */
    public function showTopUpForm(): View
    {
        return view('profile.topUp'); 
    }

    /**
     * Process the top-up request and update user balance.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function processTopUp(Request $request): RedirectResponse
    {
        // 1. Validate the input amount
        $request->validate([
            'amount' => 'required|numeric|min:10000', 
        ], [
            'amount.required' => 'Jumlah saldo harus diisi.',
            'amount.numeric' => 'Jumlah saldo harus berupa angka yang valid.',
            'amount.min' => 'Jumlah saldo minimal untuk top up adalah Rp 10.000.',
        ]);

        $user = Auth::user(); 
        $topUpAmount = (float) $request->input('amount'); 
        $user->money += $topUpAmount;
        $user->save();
        return redirect()->route('home')->with('success', 'Saldo berhasil ditambahkan sebesar Rp ' . number_format($topUpAmount, 0, ',', '.') . '. Saldo Anda sekarang: Rp ' . number_format($user->money, 0, ',', '.'));
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}