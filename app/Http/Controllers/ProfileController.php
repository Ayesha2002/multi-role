<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class ProfileController extends Controller
{
    // Show profile based on role
    public function show()
    {
        $user = User::find(Auth::id());

        if ($user->role->name === 'admin') {
            return view('admin.profile', compact('user'));
        }

        return view('user.profile', compact('user'));
    }

    //  Update profile (name/email/photo)
    public function update(Request $request)
    {
            /** @var \App\Models\User $user */

        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'photo' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        //  Handle photo upload
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('photos', 'public');
            $user->photo = $photoPath;
        }

        $user->save();

        // Redirect back to correct profile view
        if ($user->role->name === 'admin') {
            return redirect()->route('admin.profile')->with('success', 'Profile updated successfully!');
        }

        return redirect()->route('profile.show')->with('success', 'Profile updated successfully!');
    }

    // Change password 
    public function changePassword(Request $request)
    {
        
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ]);
            /** @var \App\Models\User $user */


        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Your current password is incorrect.']);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        if ($user->role->name === 'admin') {
            return redirect()->route('admin.change-password')->with('success', 'Password changed successfully!');
        }

        return redirect()->route('profile.change-password')->with('success', 'Password changed successfully!');
    }
}
