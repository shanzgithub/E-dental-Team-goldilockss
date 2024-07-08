@extends('layouts.layout')
@section('content')    

<!-- Appointment Start -->
    <div class="container-fluid my-5 py-5">
        <div class="container py-5">
            <div class="row gx-5">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th class="border-top-0">#</th>
                                <th class="border-top-0">Dentist</th>
                                <th class="border-top-0">Date</th>
                                <th class="border-top-0">Time</th>
                                <th class="border-top-0">Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{$appointment->appointmentID}}</td>
                                <td>{{$appointment->dentistID}}</td>
                                <td>
                                    <form action="{{route('save.reschedule.appointment', $appointment->appointmentID)}}" method="POST">
                                        @csrf
                                        @method('PUT')
                                    <div class="date" id="date" data-target-input="nearest">
                                        <input type="text"
                                            class="form-control form-control-sm bg-light border-0 datetimepicker-input"
                                            onfocus="(this.type='date')"
                                            onblur="(this.type='text')"
                                            data-toggle="datetimepicker"
                                            placeholder="{{ \Carbon\Carbon::parse($appointment->date)->format('d/m/Y')}}"
                                            data-target="#date" style="height: 55px;" name="date">
                                    </div>
                                </td>
                                <td>
                                    <select class="form-select form-select-sm bg-light border-0" style="height: 55px;" name="time">
                                        <option selected>{{$appointment->time}}</option>
                                        <option value="10:00:00">10:00 AM</option>
                                        <option value="11:00:00">11:00 AM</option>
                                        <option value="12:00:00">12:00 AM</option>
                                        <option value="14:00:00">02:00 PM</option>
                                        <option value="15:00:00">03:00 PM</option>
                                        <option value="17:00:00">05:00 PM</option>
                                        <option value="18:00:00">06:00 PM</option>
                                        <option value="20:00:00">08:00 PM</option>
                                    </select>
                                </td>
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
                                    <button type="submit" class="btn btn-success">Confirm
                                    </button>
                                    </form>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Appointment End -->
@endsection