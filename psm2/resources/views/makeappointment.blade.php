@extends('layouts.layout')
@section('content')    

<!-- Appointment Start -->
    <div class="container-fluid bg-primary my-5 py-5">
        <div class="container py-5">
            <div class="row gx-5">
                <div class="col-lg-6 mb-5 mb-lg-0">
                    <div class="mb-4">
                        <h5 class="d-inline-block text-white text-uppercase border-bottom border-5">Appointment</h5>
                        <h1 class="display-4">Make An Appointment Today</h1>
                    </div>
                    <p class="text-white mb-5">Don't delay any longer – take a proactive step towards better oral health by scheduling an appointment today.
                        Our experienced dental team is ready to provide you with exceptional care, addressing your concerns and ensuring your comfort throughout the process.
                        With our state-of-the-art facilities and personalized approach, you can trust us to deliver the highest quality treatments and achieve remarkable results.
                        Your oral health is our priority, and by making an appointment, you're investing in a brighter, healthier smile.
                        Don't wait another day – contact us now and experience the positive difference that professional dental care can make.</p>
                </div>
                <div class="col-lg-6">
                    <div class="bg-white text-center rounded p-5">
                        <h1 class="mb-4">Book An Appointment</h1>
                        @if ($errors->has('appointment'))
                        <div class="alert alert-danger">
                            {{ $errors->first('appointment') }}
                        </div>
                        @endif
                        <form method="POST" action="{{ route('book.appointment.new') }}">
                            @csrf
                            <div class="row g-3">
                                <div class="col-12 col-sm-6">
                                    <select class="form-select bg-light border-0" style="height: 55px;" name="treatmentID">
                                        <option selected value="">Choose Treatment</option>
                                        @foreach($treatments as $treatment)
                                        <option value="{{$treatment->id}}">{{$treatment->treatmentName}}</option>
                                        @endforeach
                                    </select>
                                    @error('treatmentID')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12 col-sm-6">
                                    <select class="form-select bg-light border-0" style="height: 55px;" name="dentistID">
                                        <option selected value="">Select Doctor</option>
                                        @foreach($users as $user)
                                        <option value="{{$user->id}}">{{$user->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('dentistID')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12 col-sm-6">
                                    <input type="hidden" value="{{ Auth::user()->id }}" name="patientID">
                                    <input type="hidden" value="0" name="status">
                                    <input type="text" class="form-control bg-light border-0" placeholder="{{ Auth::user()->name }}" style="height: 55px;" value="{{ Auth::user()->name }}" disabled>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <input type="email" class="form-control bg-light border-0" placeholder="{{ Auth::user()->email }}" style="height: 55px;" value="{{ Auth::user()->email }}" disabled>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="date" id="date" data-target-input="nearest">
                                        <input type="date"
                                            class="form-control bg-light border-0 datetimepicker-input"
                                            placeholder="Date" data-target="#date" data-toggle="datetimepicker" style="height: 55px;" name="date">
                                    </div>
                                    @error('date')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12 col-sm-6">
                                    <select class="form-select bg-light border-0" style="height: 55px;" name="time">
                                        <option selected value="">Select Time</option>
                                        <option value="10:00:00">10:00 AM</option>
                                        <option value="11:00:00">11:00 AM</option>
                                        <option value="12:00:00">12:00 AM</option>
                                        <option value="14:00:00">02:00 PM</option>
                                        <option value="15:00:00">03:00 PM</option>
                                        <option value="17:00:00">05:00 PM</option>
                                        <option value="18:00:00">06:00 PM</option>
                                        <option value="20:00:00">08:00 PM</option>
                                    </select>
                                    @error('time')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror

                                    {{-- <div class="time" id="time" data-target-input="nearest">
                                        <input type="time"
                                            class="form-control bg-light border-0 datetimepicker-input"
                                            placeholder="Time"  data-toggle="datetimepicker" style="height: 55px;" name="time">
                                    </div> --}}
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-primary w-100 py-3" type="submit">Make An Appointment</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Appointment End -->
@endsection