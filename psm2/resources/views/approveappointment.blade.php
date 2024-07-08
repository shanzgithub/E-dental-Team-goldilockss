@extends('layouts.layout')
@section('content')    

<!-- Appointment Start -->
    <div class="container-fluid my-5 py-5">
        <div class="container py-5">
            <div class="row gx-5">
                <div class="mb-4">
                    <h4 class="display-10">Appointment For : Drg. {{ Auth::user()->name }}</h4>
                </div>
                @if ($appointments->isEmpty())
                <p>No Appointment has been made.</p>
                @else
                @if(session('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
                @endif
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th class="border-top-0">#</th>
                                <th class="border-top-0">Patient</th>
                                <th class="border-top-0">Date</th>
                                <th class="border-top-0">Time</th>
                                <th class="border-top-0">Status</th>
                                <th class="border-top-0">Action</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($appointments as $appointment)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$appointment->patname}}</td>
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
                                @if ($appointment->status == 0)
                                <td>
                                    <form action="{{route('update.appointment.status', $appointment->appointmentID)}}" method="POST">
                                        @csrf
                                        @method('PUT')
                                    <input type="hidden" name="appointmentID" value="{{ $appointment->appointmentID }}">
                                    <button type="submit" class="btn btn-success">
                                        <input type="hidden"id="changestatus"name="changestatus" value="1">Approve
                                    </button>
                                    </form>
                                </td>
                                <td>
                                    <form action="{{route('update.appointment.status', $appointment->appointmentID)}}" method="POST">
                                        @csrf
                                        @method('PUT')
                                    <input type="hidden" name="appointmentID" value="{{ $appointment->appointmentID }}">
                                    <button type="submit" class="btn btn-danger" name="changestatus">
                                        <input type="hidden"id="changestatus"name="changestatus" value="2">Reject</button>
                                    </form>
            
                                    {{-- <form action="{{route('admin.user.update', $user->id)}}" method="POST">
                                        @csrf
                                        @method('PUT')
                                    <input type="hidden" name="id" value="{{ $user->id }}">
                                    <button type="submit" class="btn btn-success" name="changestatus">
                                        <input type="hidden"id="changestatus"name="changestatus" value="1">Approve
                                    </button>="chan
                                    <button type="submit" class="btn btn-danger" name="changestatus">
                                        <input type="hidden"id="changestatus"name="changestatus" value="3">Reject</button>
                                    </form> --}}
                                </td>
                                @elseif ($appointment->status == 3)
                                <td> The Appointment Cancelled by the Patient. </td>
                                @endif
                                <td></td>
                                <td></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @endif
        </div>
    </div>
    <!-- Appointment End -->
@endsection