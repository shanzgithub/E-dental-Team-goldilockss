<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Patient;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Dentist;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:50'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'max:12', 'confirmed'],
            'age'=> ['required','min:2', 'max:2'],
            'gender'=> ['required'],
            'phoneNumber'=> ['required','min:10', 'max:12'],
            'role'=> ['required'],
        ],[
            'name.required' => 'Please enter your Full Name',
            'name.max' => 'Please enter Your Full Name that must not exceed 50 characters',
            'email.required' => 'Please enter your Email Address',
            'email.email' => 'Invalid Email Address',
            'password.required' => 'Please enter your Password',
            'password.min' => 'The password must not less than 8 characters.',
            'password.max' => 'The password must not exceed 12 characters.',
            'age.required' => 'Please enter your Age',
            'gender.required' => 'Please select your Gender',
            'phoneNumber.required' => 'Please enter your Phone Number',
            'phoneNumber.min' => 'Your Phone Number must not less than 10 characters.',
            'phoneNumber.max' => 'Your Phone Number not exceed 12 characters.',
            'role.required' => 'Please enter your Role',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */

     protected function registered(Request $request, $user)
    {

    auth()->logout();
    session()->flash('message', 'Registration successful.');
    return redirect('/login');
    }


    protected function create(array $data)
    {

        $user=User::create([
            'id' => $data,
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => $data['role'],
            'userstatus' => $data['userstatus'],
            'is_admin' => $data['is_admin'],
        ]);

        // return Admin::create([
        //     'id'=>$user->id,
        //     'name' => $data['name'],
        //     'email' => $data['email'],
        //     'password' => Hash::make($data['password']),
        //     'is_admin' => $data['is_admin'],
        // ]);
            
        

        if ($user->role == '0'){
            return Patient::create([
                'patientID'=>$user->id,
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'age' => $data['age'],
                'gender' => $data['gender'],
                'phoneNumber' => $data['phoneNumber'],
                'role' => $user->role,
                'userstatus' => $user->userstatus,
                'is_admin' => $user->is_admin,
            ]);
        }
        else {
            return Dentist::create([
                'dentistID'=>$user->id,
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'age' => $data['age'],
                'gender' => $data['gender'],
                'phoneNumber' => $data['phoneNumber'],
                'role' => $user->role,
                'userstatus' => $user->userstatus,
                'is_admin' => $user->is_admin,
            ]);
        }
        event(new Registered($user));

        return $user;
        
    }
}
