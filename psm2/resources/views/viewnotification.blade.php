@extends('layouts.layout')
@section('content')    

<!-- Appointment Start -->
    <div class="container-fluid my-5 py-5">
        <div class="container py-5">
            <div class="row gx-5">
                <div class="mb-4">
                    @if (Auth::user()->role == 1)
                    <h4 class="display-10">Notification for Drg. {{ Auth::user()->name }}</h4>
                    @elseif ($gender == '[{"gender":"Male"}]')
                        <h4 class="display-10">Notification For : Mr. {{ Auth::user()->name }}</h4>
                    
                    @else 
                        <h4 class="display-10">Notification For : Mrs. {{ Auth::user()->name }}</h4>
                    @endif
                </div>
                @if ($appointments->isEmpty())
                <p>No appointment notification.</p>
                @else
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            @if (Auth::user()->role == 1)
                            <tr>
                                <th class="border-top-0">#</th>
                                <th class="border-top-0">Message</th>
                            </tr>
                            @else
                            <tr>
                                <th class="border-top-0">#</th>
                                <th class="border-top-0">Message</th>
                            </tr>
                            @endif
                        </thead>
                        <tbody>
                            @foreach($appointments as $appointment)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                @if(Auth::user()->role == 1)
                                <td>Your Appointment on {{$appointment->date}} {{$appointment->time}} with patient Name of {{$appointment->patname}}
                                @if($appointment->status == 1)
                                has been Approve
                                @elseif($appointment->status == 0)
                                has not been Approved, Please Make an action
                                @elseif($appointment->status == 2)
                                has Rejected
                                @else
                                has been cancelled by the patient
                                @endif
                                </td>
                                @else
                                <td>Your Appointment on {{$appointment->date}} {{$appointment->time}} with dentist Name of Drg. {{$appointment->dentname}}
                                    has been
                                    @if($appointment->status == 1)
                                    Approve
                                    @elseif ($appointment->status == 0)
                                    has not been Approved
                                    @elseif($appointment->status == 2)
                                    has Rejected by the Dentist
                                    @else
                                    has been cancelled
                                    @endif
                                @endif
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif
            </div>
        </div>
    </div>
    <!-- Appointment End -->
@endsection