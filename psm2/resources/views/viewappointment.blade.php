@extends('layouts.layout')
@section('content')    

<!-- Appointment Start -->
    <div class="container-fluid my-5 py-5">
        <div class="container py-5">
            <div class="row gx-5">
                <div class="mb-4">
                    @if (Auth::user()->role == 1)
                    <h4 class="display-10">Appointment For : Drg. {{ Auth::user()->name }}</h4>
                    @elseif ($gender == '[{"gender":"Male"}]')
                        <h4 class="display-10">Appointment For : Mr. {{ Auth::user()->name }}</h4>
                    @else 
                        <h4 class="display-10">Appointment For : Mrs. {{ Auth::user()->name }}</h4>
                    @endif
                    @if ($selectedDate)
                    <h5 class="display-10">Appointment on {{ $selectedDate }}</h5>
                    @endif
                </div>
                @if ($appointments->isEmpty())
                <form action="{{ route('filter.appointments') }}" method="GET" class="mb-4">
                    @csrf
                    <div class="row gx-3">
                        <div class="col-md-3">
                            <label for="selected_date" class="form-label">Select Date:</label>
                            <input type="date" class="form-control" id="selected_date" name="selected_date">
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-primary">Filter</button>
                        </div>
                    </div>
                </form> 
                <p>No Appointment has been made.</p>
                @else
                @if (session()->has('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
                @endif


                <!-- Filter Form -->
            <form action="{{ route('filter.appointments') }}" method="GET" class="mb-4">
                @csrf
                <div class="row gx-3">
                    <div class="col-md-3">
                        <label for="selected_date" class="form-label">Select Date:</label>
                        <input type="date" class="form-control" id="selected_date" name="selected_date">
                    </div>
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </div>
                </div>
            </form>
            <!-- End Filter Form -->

            
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            @if (Auth::user()->role == 1)
                            <tr>
                                <th class="border-top-0">#</th>
                                <th class="border-top-0">Patient</th>
                                <th class="border-top-0">Date</th>
                                <th class="border-top-0">Time</th>
                                <th class="border-top-0">Status</th>
                                <th class="border-top-0">Edit</th>
                                <th class="border-top-0">Action</th>
                            </tr>
                            @else
                            <tr>
                                <th class="border-top-0">#</th>
                                <th class="border-top-0">Dentist</th>
                                <th class="border-top-0">Date</th>
                                <th class="border-top-0">Time</th>
                                <th class="border-top-0">Status</th>
                                <th class="border-top-0">Edit</th>
                                <th class="border-top-0">Action</th>
                            </tr>
                            @endif
                        </thead>
                        <tbody>
                            @foreach($appointments as $appointment)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                @if(Auth::user()->role == 1)
                                <td>{{$appointment->patname}}</td>
                                @else
                                <td>{{$appointment->dentname}}</td>
                                @endif
                                <td>{{$appointment->date}}</td>
                                <td>{{$appointment->time}}</td>
                                <td>@if($appointment->status == 0)
                                    Pending
                                @elseif($appointment->status == 1)
                                    Approve
                                @elseif($appointment->status == 2) 
                                    Reject
                                @else Canceled
                                </td>
                                @endif
                                @if (Auth::user()->role == 0)
                                @if($appointment->status == 0)
                                <td><a href="{{route('edit.reschedule.appointment', $appointment->appointmentID)}}">
                                    <button type="submit" class="btn-sm btn-warning">
                                        <input type="hidden"id="changestatus"name="changestatus" value="1">Reschedule
                                    </button></a>
                                </td>
                                <td>
                                    <form action="{{route('cancel.appointment.status', $appointment->appointmentID)}}" method="POST">
                                        @csrf
                                        @method('PUT')
                                    <input type="hidden" name="appointmentID" value="{{ $appointment->appointmentID }}">
                                    <button type="submit" class="btn btn-danger" name="changestatus">
                                        <input type="hidden"id="changestatus"name="changestatus" value="3">Cancel</button>
                                    </form>
                                </td>
                                @else
                                <td></td>
                                <td></td>
                                @endif


                                @else
                                @if($appointment->status == 0)
                                <td><a href="{{route('edit.reschedule.appointment', $appointment->appointmentID)}}">
                                    <button type="submit" class="btn-sm btn-warning">
                                        <input type="hidden"id="changestatus"name="changestatus" value="1">Reschedule
                                    </button></a>
                                </td>
                                <td></td>
                                @else
                                <td></td>
                                <td></td>
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