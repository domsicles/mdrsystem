<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    // Show the form to change the password
    public function showChangePasswordForm()
    {
        return view('account.change-password');
    }

    // Handle the password change request
    public function changePassword(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        // Check if the current password matches
        if (!Hash::check($request->current_password, Auth::user()->password)) {
            return back()->withErrors(['current_password' => 'The current password is incorrect.']);
        }

        // Update the password
        Auth::user()->update([
            'password' => Hash::make($request->new_password),
        ]);

        return redirect()->route('home')->with('success', 'Password changed successfully.');
    }

    // Show the form for deleting the account
    public function showDeleteAccountForm()
    {
        return view('account.delete-account');
    }

    // Handle the account deletion request
    public function deleteAccount(Request $request)
    {
        // Validate password input to confirm account deletion
        $request->validate([
            'password' => 'required',
        ]);

        // Check if the provided password matches
        if (!Hash::check($request->password, Auth::user()->password)) {
            return back()->withErrors(['password' => 'The password is incorrect.']);
        }

        // Delete the user account
        Auth::user()->delete();

        // Logout the user after account deletion
        Auth::logout();

        return redirect()->route('home')->with('success', 'Your account has been deleted successfully.');
    }
}
