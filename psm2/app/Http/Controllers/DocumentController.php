<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DigitalDocument;
use App\Models\User;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;
use App\Models\Patient;
use App\Models\Dentist;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Redirect;
use PDF;
use Dompdf\Options;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\View;

class DocumentController extends Controller
{
    //
    public function index1(){
        $documents = DigitalDocument::all();
        return view('DigitalDocument', ['documents' => $documents ]);
    } 

    public function patientDocument(){
        $currentuserid = Auth::user()->id;
        $gender = Patient::select('gender')->where('patientID', '=', $currentuserid)->get();
        $documents = DigitalDocument::join('patients', 'patients.patientID', '=', 'digital_documents.patientID')
        ->join('dentists', 'dentists.dentistID', '=', 'digital_documents.dentistID')
        ->where('digital_documents.patientID','=', $currentuserid)
        ->get(['digital_documents.*', 'dentists.name as dentname']);

        // $appointments = Appointment::join('dentists', 'dentists.dentistID', '=', 'appointments.dentistID')
        // ->join('patients', 'patientsz.patientID', '=', 'appointments.patientID')
        // ->where('appointments.patientID','=', $currentuserid)
        // ->orderby('date','asc')
        // ->get(['appointments.*', 'dentists.name as dentname', 'patients.name as patname']);

        $appointments = Appointment::join('dentists', 'dentists.dentistID', '=', 'appointments.dentistID')
        ->join('patients', 'patients.patientID', '=', 'appointments.patientID')
        ->join('treatments', 'treatments.id', '=', 'appointments.treatmentID')
        ->where('appointments.patientID','=', $currentuserid)
        ->orderby('date','asc')
        ->get(['appointments.*', 'dentists.name as dentname', 'patients.name as patname'
        , 'treatments.treatmentName as treatmentname', 'treatments.price as treatmentprice']);

        return view('DigitalDocument', [
            'documents' => $documents,
            'gender' => $gender,
            'appointments' => $appointments,
        ]);
    }

    // public function generateinvoice($id)
    // {
    //     $appointment = Appointment::join('treatments', 'treatments.id', '=', 'appointments.treatmentID')
    //         ->select('appointments.*', 'treatments.treatmentName as treatmentname', 'treatments.price as treatmentprice')
    //         ->where('appointments.appointmentID', $id)
    //         ->first();
    
    //     // Create an instance of Dompdf with the appropriate configuration
    //     $options = new Options();
    //     $options->setIsRemoteEnabled(true); // Enable remote file access
    //     $dompdf = new Dompdf($options);
    
    //     // Load the view and convert it to HTML
    //     $html = view('generateinvoice', ['appointment' => $appointment])->render();
    
    //     // Load the HTML into Dompdf
    //     $dompdf->loadHtml($html);
    
    //     // (Optional) Set paper size and orientation
    //     $dompdf->setPaper('A4', 'portrait');
    
    //     // Render the PDF
    //     $dompdf->render();
    
    //     // Download the PDF with a custom file name
    //     $output = $dompdf->output();
    //     $response = Response::make($output, 200, [
    //         'Content-Type' => 'application/pdf',
    //         'Content-Disposition' => 'inline; filename=invoice.pdf',
    //     ]);

    //     $response->headers->set('X-Content-Type-Options', 'nosniff');
    //     $response->headers->set('X-Frame-Options', 'sameorigin');
    //     $response->headers->set('Content-Security-Policy', "frame-ancestors 'self'");

    //     return $response;
    // }
    public function generateinvoice($id)
    {
        $appointment = Appointment::join('treatments', 'treatments.id', '=', 'appointments.treatmentID')
            ->select('appointments.*', 'treatments.treatmentName as treatmentname', 'treatments.price as treatmentprice')
            ->where('appointments.appointmentID', $id)
            ->first();
    
        // Create an instance of Dompdf with the appropriate configuration
        $options = new Options();
        $options->setIsRemoteEnabled(true); // Enable remote file access
        $dompdf = new Dompdf($options);
    
        // Load the view and convert it to HTML
        $html = view('generateinvoice', ['appointment' => $appointment])->render();
    
        // Load the HTML into Dompdf
        $dompdf->loadHtml($html);
    
        // (Optional) Set paper size and orientation
        $dompdf->setPaper('A3', 'portrait');
    
        // Render the PDF
        $dompdf->render();
    
        // Download the PDF with a custom file name
        $dompdf->stream('invoice.pdf', ['Attachment' => false]);
    
        // Return a response to prevent any additional content from being sent to the browser
        return response()->make('', 200);
    }
    

    public function getdocument(Request $request, $id)
    {
        $file = DigitalDocument::find($id);

        $fileData = $file->file;
        $fileName = $file->name;

        $headers = [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="' . $fileName . '.pdf',
        ];

        return response($fileData, 200, $headers);
    }

    public function dentistDocument(){
        $currentuserid = Auth::user()->id;
        $gender = Dentist::select('gender')->where('dentistID', '=', $currentuserid)->get();
        $documents = DigitalDocument::join('patients', 'patients.patientID', '=', 'digital_documents.patientID')->join('dentists', 'dentists.dentistID', '=', 'digital_documents.dentistID')
        ->where('digital_documents.dentistID','=', $currentuserid)->orderby('patients.name', 'asc')
        ->get(['digital_documents.*', 'patients.name as patname', 'patients.patientID as patID', 'dentists.dentistID as dentID']);
        return view('dentistdocument', ['documents' => $documents], ['gender' => $gender]);
    }

    public function specificDocument($id){
        $currentuserid = Auth::user()->id;
        $gender = Dentist::select('gender')->where('dentistID', '=', $currentuserid)->get();
        $documents = DigitalDocument::join('patients', 'patients.patientID', '=', 'digital_documents.patientID')->join('dentists', 'dentists.dentistID', '=', 'digital_documents.dentistID')
        ->where('digital_documents.dentistID','=', $currentuserid)->where('digital_documents.patientID','=', $id)
        ->get(['digital_documents.*', 'patients.name as patname', 'patients.patientID as patID', 'dentists.dentistID as dentID']);
        
        

        $appointments = Appointment::join('dentists', 'dentists.dentistID', '=', 'appointments.dentistID')
        ->join('patients', 'patients.patientID', '=', 'appointments.patientID')
        ->join('treatments', 'treatments.id', '=', 'appointments.treatmentID')
        ->where('appointments.dentistID','=', $currentuserid)
        ->orderby('date','asc')
        ->get(['appointments.*', 'dentists.name as dentname', 'patients.name as patname'
        , 'treatments.treatmentName as treatmentname', 'treatments.price as treatmentprice']);
        return view('specificpatientdoc', [
            'documents' => $documents,
            'gender' => $gender,
            'appointments' => $appointments,
        ]);
    }

    public function deletedocument($id){
        DigitalDocument::where('id', $id)->delete();
        session()->flash('message', 'Digital document has been deleted.');
        return redirect()->back();
    }

    public function redata(){
        if(Auth::user()->role == 0){
        $users = User::where('role','=','1')->get();
        return view('UploadDigitalDocument', ['users' => $users]);
        }
        else{
        $users = User::where('role','=','0')->get();
        return view('UploadDigitalDocument', ['users' => $users]);
        }
    }

    public function uploaddocument(Request $request){
        $request->validate([
            'file' => 'required|mimes:pdf|max:2048', // Restrict to PDF files
            'dentistID' => 'required',
            'patientID' => 'required',
            'type' => 'required',
            'name' => 'required',
        ],[
            'dentistID.required' => 'Please select the Dentist.',
            'patientID.required' => 'Please select the Patient',
            'type.required' => 'Please select the Type of Document',
            'name.required' => 'Please enter the Document Name',
            'file.required' => 'Please upload the Document,',
            'file.mimes' => 'Invalid Document file, ONLY PDF format.',
            'file.max' => 'The file size should not exceed 2MB.'
        ]
    );


        if ($request->hasFile('file')) {
            $file = $request->file('file');

            // Read the file content
            $fileContents = file_get_contents($file->getRealPath());

            // Save the document to the database
            $document = new DigitalDocument();
            $document->dentistID = request('dentistID');
            $document->patientID = request('patientID');
            $document->type = request('type');
            $document->name = request('name');
            $document->file = $fileContents;
            $document->save();
            session()->flash('message', 'Upload successful.');
        }
        return redirect()->route('upload.document.new');
    }
    

    // public function dentistDocument(){
    //     $patients = Patient::all();
    //     return view('dentistdocument', ['patients' => $patients]);
    // }
}

