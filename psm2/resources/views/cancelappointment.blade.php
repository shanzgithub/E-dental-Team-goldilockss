@extends('layouts.layout')
@section('content')    

<!-- Appointment Start -->
    <div class="container-fluid my-5 py-5">
        <div class="container py-5">
            <div class="row gx-5">
                <div class="mb-4">
                    <h4 class="display-10">Cancel Appointment ?</h4>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th class="border-top-0">#</th>
                                <th class="border-top-0">Dentist</th>
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
                                <td>{{$appointment->name}}</td>
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
                                <td>
                                    <form action="{{route('cancel.appointment.status', $appointment->appointmentID)}}" method="POST">
                                        @csrf
                                        @method('PUT')
                                    <input type="hidden" name="appointmentID" value="{{ $appointment->appointmentID }}">
                                    <button type="submit" class="btn btn-danger" name="changestatus">
                                        <input type="hidden"id="changestatus"name="changestatus" value="3">Cancel</button>
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
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Appointment End -->
@endsection