<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Patient;
use App\Models\Dentist;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    //
    // public function registerdentist(Request $request){
    //     $validatedData = $request->validate([
    //         'name' => ['required', 'string', 'max:50'],
    //         'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
    //         'password' => ['required', 'string', 'min:8', 'max:12', 'confirmed'],
    //         'age'=> ['required','min:2', 'max:2'],
    //         'gender'=> ['required'],
    //         'phoneNumber'=> ['required','min:10', 'max:12'],
    //         'role'=> ['required'],
    //     ]);

    //     $user = User::create([
    //         'name' => $validatedData['name'],
    //         'email' => $validatedData['email'],
    //         'password' => bcrypt($validatedData['password']),
    //         'role' => $validatedData['role'],
    //         'userstatus' => $validatedData['userstatus'],
    //         'is_admin' => $validatedData['is_admin'],
    //     ]);

    //     $dentist = Dentist::create([
    //         'name' => $validatedData['name'],
    //         'email' => $validatedData['email'],
    //         'phone' => $validatedData['phone'],
    //         'password' => bcrypt($validatedData['password']),
    //     ]);
    // } 
    protected function create( Request $request)
    {
        $data = $request->all();
        $request->validate([
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
            Patient::create([
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
            Dentist::create([
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

        session()->flash('message', 'Dentist Registration has been made');
        return redirect()->route('regist.new.dentist');
        // return back();

        
    }


    public function getUserList(){
        $users = User::orderBy('role')->get();
        return view('admin.UserVerification', ['users' => $users]);
    } 

    
    public function updateStatus(Request $request){
        $user = User::findOrFail($request->id);
        $user->userstatus = $request->input('changestatus');
        $user->save();
        
        $message = '';
        if ($user->userstatus == 1) {
        $message = 'Registration Approved.';
        } 
        elseif ($user->userstatus == 3) {
        $message = 'Registration Rejected.';
        }

    return back()->with('message', $message);
    }

    public function getUserInfo(){
        $currentuserid = Auth::user()->id;
        $user = User::findOrFail($currentuserid);
        $patients = User::join('patients', 'patients.patientID', '=', 'users.id')
        ->where('users.id','=', $currentuserid)
        ->get(['users.*', 'patients.age as patage', 'patients.phoneNumber as patphone', 'patients.gender as patgen', 'patients.patientID as patID' ]);
        error_log($patients);
        $dentists = User::join('dentists', 'dentists.dentistID', '=', 'users.id')
        ->where('users.id','=', $currentuserid)
        ->get(['users.*', 'dentists.age as dentage', 'dentists.phoneNumber as dentphone', 'dentists.gender as dentgen']);

        // error_log($users);
        return view ('profile',['patients'=> $patients, 'dentists'=>$dentists, 'user' => $user]);
    }

    public function userdetailsinmanage($id){
        $user = User::findorfail($id);
        // $currentuserid = Auth::user()->id;
        $patients = User::join('patients', 'patients.patientID', '=', 'users.id')
        ->where('users.id','=', $id)
        ->get(['users.*', 'patients.age as patage', 'patients.phoneNumber as patphone', 'patients.gender as patgen' ]);
        // error_log($patients);

        $dentists = User::join('dentists', 'dentists.dentistID', '=', 'users.id')
        ->where('users.id','=', $id)
        ->get(['users.*', 'dentists.age as dentage', 'dentists.phoneNumber as dentphone', 'dentists.gender as dentgen']);

        // error_log($users);
        return view ('manageprofile',['patients'=> $patients, 'dentists'=>$dentists, 'user' => $user]);
    }


    public function UpdateUserInfo(Request $request, $id){
        // $currentuserid = User::find($id);
        $currentuserid = User::findorfail($id);
        // error_log($currentuserid);
        // Customer::where('customer_id', $request->customer_id)->firstOrFail();
        
        // $currentuserid = Auth::user()->id;
        // $patentUserID = Auth::user()->patientID;
        // $dentistUserID = Auth::user()->dentistID;
        // $user = User::findOrFail($currentuserid);
        // $patients = Patient::findOrFail($patentUserID);
        // $dentists = Dentist::findOrFail($dentistUserID);
        // $patients = User::join('patients', 'patients.patientID', '=', 'users.id')
        // ->where('users.id','=', $currentuserid)
        // ->get(['users.*', 'patients.age as patage', 'patients.phoneNumber as patphone', 'patients.gender as patgen' ]);

        // $dentists = User::join('dentists', 'dentists.dentistID', '=', 'users.id')
        // ->where('users.id','=', $currentuserid)
        // ->get(['users.*', 'dentists.age as dentage', 'dentists.phoneNumber as dentphone', 'dentists.gender as dentgen']);
        
        if ($currentuserid->role == 0){
            // $currentuserid = Auth::user()->id;
            $patient = Patient::where("patientID", $id)->firstOrFail();
            $user = User::where("id", $id)->firstOrFail();
            // $patient = Patient::findOrFail($id);
            $patient->age = $request->input('age');
            $patient->phoneNumber = $request->input('phoneNumber');
            $patient->save();
            $user->save();
            session()->flash('message', 'Update Successful.');
        }
        else {
            $dentist = Dentist::where("dentistID", $id)->firstOrFail();
            $user = User::where("id", $id)->firstOrFail();
            // $patient = Patient::findOrFail($id);
            $dentist->age = $request->input('age');
            $dentist->phoneNumber = $request->input('phoneNumber');
            $dentist->save();
            $user->save();
            session()->flash('message', 'Update Successful.');
        }
        return redirect()->route('view.user.details');
    }
}
