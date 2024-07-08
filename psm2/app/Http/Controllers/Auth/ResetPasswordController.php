<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Patient;
use App\Models\Dentist;
use Illuminate\Support\Facades\Auth;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    // use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;

    // public function change(Request $request)
    // {
    //     // Validate the request data
    //     $request->validate([
    //         'phone_number' => 'required',
    //         'password' => 'required|min:6|confirmed',
    //     ]);

    //     // Find the user by phone number
    //     $user = User::where('phoneNumber', $request->phoneNumber)->first();

    //     if (!$user) {
    //         // User not found
    //         return redirect()->back()->with('error', 'User not found.');
    //     }

    //     // Update the user's password
    //     $user->password = Hash::make($request->password);
    //     $user->save();

    //     // Redirect the user with a success message
    //     return redirect()->back()->with('success', 'Password changed successfully.');
    // }
    public function change(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'phoneNumber' => 'required',
            'password' => 'required|min:8|confirmed',
        ], [
            'password.confirmed' => 'The password and confirm password do not match.',
        ]);

        $email = $request->email;
        $phoneNumber = $request->phoneNumber;
        $role = $request->role;

        // Fetch user based on email
        $user = User::where('email', $email)->first();

        if($role == 1){
            $user = User::where('email', $email)->first();
            if (!$user) {
                return redirect()->back()->withErrors(['email' => 'User not found.']);
            }
            $dentist = Dentist::where('email', $email)->first();
            if (!$dentist) {
                return redirect()->back()->withErrors(['email' => 'Your are not a Dentist']);
            }
            $phoneColumn = (Dentist::class) ? 'phoneNumber' : 'phoneNumber';
            $isValidCredentials = Dentist::where('email', $email)
            ->where($phoneColumn, $phoneNumber)
            ->exists();
            if (!$isValidCredentials) {
                return redirect()->back()->withErrors(['message' => 'Invalid email or phone number.']);
            }
            $user->password = bcrypt($request->password);
            $user->save();
            $dentist->save();
            return redirect()->back()->with('message', 'Password changed successfully.');
        }

        if($role == 0){
            $user = User::where('email', $email)->first();
            if (!$user) {
                return redirect()->back()->withErrors(['email' => 'User not found.']);
            }
            $patient = Patient::where('email', $email)->first();
            if (!$patient) {
                return redirect()->back()->withErrors(['email' => 'Your are not a Patient']);
            }
            $phoneColumn = (Patient::class) ? 'phoneNumber' : 'phoneNumber';
            $isValidCredentials = Patient::where('email', $email)
            ->where($phoneColumn, $phoneNumber)
            ->exists();
            if (!$isValidCredentials) {
                return redirect()->back()->withErrors(['message' => 'Invalid email or phone number.']);
            }
            $user->password = bcrypt($request->password);
            $user->save();
            $patient->save();
            return redirect()->back()->with('message', 'Password changed successfully.');
        }

    }
    
}
