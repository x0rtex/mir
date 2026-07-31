<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class ProfileController extends Controller
{
    public function show(Request $request)
    {
        return Inertia::render("Profile/Show");
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            "name" => "required|string|max:255",
            "email" => "required|email|max:255|unique:users,email," . $request->user()->id,
            "avatar" => "nullable|image|max:2048",
        ]);

        $user = $request->user();

        if ($request->hasFile("avatar")) {
            $path = $request->file("avatar")->store("avatars", "public");
            $user->avatar = $path;
        }

        $user->name = $validated["name"];
        $user->email = $validated["email"];
        $user->save();

        return back()->with("message", "Profile updated.");
    }

    public function updatePassword(Request $request)
    {
        $validated = $request->validate([
            "current_password" => "required|current_password",
            "password" => "required|string|min:8|confirmed",
        ]);

        $request->user()->update([
            "password" => Hash::make($validated["password"]),
        ]);

        return back()->with("message", "Password updated.");
    }

    public function destroy(Request $request)
    {
        $user = $request->user();
        $user->comments()->delete();
        $user->delete();

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect("/")->with("message", "Account deleted.");
    }
}
