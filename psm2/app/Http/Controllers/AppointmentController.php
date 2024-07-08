<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Dentist;
use App\Models\Patient;
use App\Models\User;
use App\Models\Treatment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class AppointmentController extends Controller
{
    public function makeAppointment(Request $request){
        $request->validate([
            'dentistID' => 'required',
            'treatmentID' => 'required',
            'date' => 'required',
            'time' => 'required',
            'dentistID' => [
                'required',
                Rule::unique('appointments')->where(function ($query) use ($request) {
                    return $query->where('date', $request->date)
                        ->where('time', $request->time)
                        ->where('dentistID', $request->dentistID)
                        ->where(function ($subquery) {
                            $subquery->where('status', 1)
                                ->orWhere('status', 0);
                        });
                })->ignore($request->appointmentID),
            ],
        ], [
            'dentistID.required' => 'Please select the dentist.',
            'treatmentID.required' => 'Please select the treatment.',
            'date.required' => 'Please select the date.',
            'time.required' => 'Please select the time.',
            'dentistID.unique' => 'An appointment already exists on the selected date and time with the same dentist.',
        ]);

        $appointment = new Appointment();
        // $appointment->appointmentID = $appointment->appointmentID+1;
        $appointment->dentistID = request('dentistID');
        $appointment->patientID = request('patientID');
        $appointment->treatmentID = request('treatmentID');
        $appointment->date = request('date');
        $appointment->time = request('time');
        $appointment->status = request('status');

        $appointment->save();
        session()->flash('message', 'Appointment has been made.');
        return redirect()->route('view.all.appointment');
    }
    
    public function reqalldata(){
        $users = User::where('role','=','1')->get();
        $treatments = Treatment::all();
        $appointments = Appointment::all();
        return view('makeappointment', ['users' => $users], ['appointments' => $appointments, 'treatments' => $treatments]);
    }
    // public function index1(){
    //     $treatments = Treatment::all();
    //     return view('makeappointment', ['treatments' => $treatments]);
    // }
    
    public function dentistappointment(){
        $currentuserid = Auth::user()->id;
        // $appointments = Appointment::join('dentists', 'appointments.dentistID', '=', 'dentists.dentistID')
        // ->where('appointments.dentistID','=', $currentuserid)->get(['appointments.*', 'dentists.name as name']);

        $appointments = Appointment::join('dentists', 'dentists.dentistID', '=', 'appointments.dentistID')->join('patients', 'patients.patientID', '=', 'appointments.patientID')
        ->where('appointments.dentistID','=', $currentuserid)->orderby('date','asc')
        ->get(['appointments.*', 'dentists.name as dentname', 'patients.name as patname']);
        return view('approveappointment', ['appointments' => $appointments]);
    }


    public function dentistupdatestatus(Request $request){
        $appointment = Appointment::findOrFail($request->appointmentID);
        $appointment->status = $request->input('changestatus');
        $appointment->save();
        session()->flash('message', 'Appointment Approved.');
        $message = '';
        if ($appointment->status == 1) {
        $message = 'Appointment Approved.';
        } elseif ($appointment->status == 2) {
        $message = 'Appointment Rejected.';
        }
        return back()->with('message', $message);
    }

    public function patientappointment(){
        $currentuserid = Auth::user()->id;
        $appointments = Appointment::join('dentists', 'dentists.dentistID', '=', 'appointments.dentistID')->join('patients', 'patients.patientID', '=', 'appointments.patientID')
        ->where('appointments.patientID','=', $currentuserid)->orderby('date','asc')
        ->get(['appointments.*', 'dentists.name as name']);
        return view('cancelappointment', ['appointments' => $appointments]);
    }


    public function patientupdatestatus(Request $request){
        $appointment = Appointment::findOrFail($request->appointmentID);
        $appointment->status = $request->input('changestatus');
        $appointment->save();
        session()->flash('message', 'Appointment Canceled.');
        return back();
    }

    public function allappointment()
    {
        $currentuserid = Auth::user()->id;
        $gender = Patient::select('gender')->where('patientID', '=', $currentuserid)->get();
        $appointments = Appointment::join('dentists', 'dentists.dentistID', '=', 'appointments.dentistID')
            ->join('patients', 'patients.patientID', '=', 'appointments.patientID')
            ->where('appointments.patientID','=', $currentuserid)
            ->orWhere('appointments.dentistID','=', $currentuserid)
            ->orderby('date','asc')
            ->get(['appointments.*', 'dentists.name as dentname', 'patients.name as patname']);
    
        // Initialize $selectedDate to null if it's not already set
        $selectedDate = null;
    
        return view('viewappointment', compact('appointments', 'gender', 'selectedDate'));
    }
    

    public function filter(Request $request)
    {
        $selectedDate = $request->input('selected_date');
        $currentUserId = Auth::id();
        $gender = Patient::where('patientID', $currentUserId)->pluck('gender')->first();
        if (Auth::user()->role == 1){
        $appointments = Appointment::join('dentists', 'dentists.dentistID', '=', 'appointments.dentistID')
            ->join('patients', 'patients.patientID', '=', 'appointments.patientID')
            ->where('appointments.dentistID', $currentUserId)
            ->where('date', $selectedDate) // Ensure that the date matches the selected date
            ->orderBy('date', 'asc')
            ->get(['appointments.*', 'dentists.name as dentname', 'patients.name as patname']);
    
        return view('viewappointment', compact('appointments', 'gender', 'selectedDate'));
        }
        elseif(Auth::user()->role == 0){
            $appointments = Appointment::join('dentists', 'dentists.dentistID', '=', 'appointments.dentistID')
            ->join('patients', 'patients.patientID', '=', 'appointments.patientID')
            ->where('appointments.patientID', $currentUserId)
            ->where('date', $selectedDate) // Ensure that the date matches the selected date
            ->orderBy('date', 'asc')
            ->get(['appointments.*', 'dentists.name as dentname', 'patients.name as patname']);
    
        return view('viewappointment', compact('appointments', 'gender', 'selectedDate'));
        }
    }
    

    public function reschedule($id){
        $appointment = Appointment::find($id);
        return view ('rescheduleappointment', ['appointment' => $appointment]);
    }

    public function savereschedule(Request $request, $id){
        $appointment = Appointment::findorfail($id);
        // $appdate = $appointment->date = request('date');
        $appointment->time = request('time');
        if($request->filled('date')){
            $appdate = $appointment->date = request('date');
        }

        // error_log(request('time'));
        // error_log(request('date'));

        // if ($appointment->date == null){
        //     old('date', $appdate);
        // }
        // else

        $appointment-> save();
        session()->flash('message', 'Appointment Updated.');
        return redirect()-> route('view.all.appointment');
    }


    public function notification(){
        $currentuserid = Auth::user()->id;
        $gender = Patient::select('gender')->where('patientID', '=', $currentuserid)->get();
        $appointments = Appointment::join('dentists', 'dentists.dentistID', '=', 'appointments.dentistID')->join('patients', 'patients.patientID', '=', 'appointments.patientID')
        ->where('appointments.patientID','=', $currentuserid)->orwhere('appointments.dentistID','=', $currentuserid)
        ->orderby('updated_at','asc')
        ->get(['appointments.*', 'dentists.name as dentname', 'patients.name as patname']);
        return view('viewnotification', ['appointments' => $appointments, 'gender' => $gender]);
    }
}
