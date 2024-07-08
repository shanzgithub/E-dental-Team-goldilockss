@extends('layouts.layout')
@section('content')
<div class="container-fluid py-5">
    <div class="container">
        <div class="text-center mx-auto mb-5" style="max-width: 500px;">
            <h5 class="d-inline-block text-primary text-uppercase border-bottom border-5">Welcome {{ Auth::user()->name }} !</h5>
            @if(Auth::user()->role == 1)
            <h1 class="display-4">Our Amazing Dentist</h1>
            @else
            <h1 class="display-4">Our Beloved Patient</h1>
            @endif
        </div>
        <div class="position-relative">
            <div class="team-item">
                <div class="row g-0 bg-light rounded h-100">
                    <div class="col-12 col-sm-5 h-100">
                        @if(Auth::user()->role == 1)
                        <img class="img-fluid h-100" src="{{ asset('assets/img/dentist.png') }}" style="object-fit: cover;">
                        @else
                        <img class="img-fluid h-100" src="{{ asset('assets/img/patient.png') }}" style="object-fit: cover;">
                        @endif
                    </div>
                    <div class="col-12 col-sm-7 h-100 d-flex flex-column">
                        <div class="mt-auto p-4">
                            <form action="{{route('save.user.details', $user->id)}}" method="POST">
                                @csrf
                                @method('PUT')
                            @if(Auth::user()->role == 1)
                            <h3>{{ Auth::user()->name }}</h3>
                            <h6 class="fw-normal fst-italic text-primary mb-4">Dentist Profile</h6>
                            <input type="email" class="form-control bg-light" style="width: 200px;"placeholder="{{ Auth::user()->email }}" value="{{ Auth::user()->email }}" disabled>
                            <input type="text" id="name" name="name" class="form-control bg-light" style="width: 200px;"placeholder="{{ Auth::user()->name }}" value="{{ Auth::user()->name }}" disabled>
                            <input type="text" id="age" name="age" class="form-control bg-white" style="width: 200px;"placeholder="{{ $dentists[0]['dentage'] }}" value="{{ $dentists[0]['dentage'] }}" >
                            <input type="text" id="gender" class="form-control bg-light" style="width: 200px;"placeholder="{{ $dentists[0]['dentgen'] }}" value="{{ $dentists[0]['dentgen'] }}"disabled>
                            <input type="number" id="phoneNumber" name="phoneNumber" class="form-control bg-white" style="width: 200px;"placeholder="0{{ $dentists[0]['dentphone'] }}" value="{{ $dentists[0]['dentphone'] }}">
                            @else
                            <h3>{{ Auth::user()->name }}</h3>
                            <h6 class="fw-normal fst-italic text-primary mb-4">Patient Profile</h6>
                            <input type="email" class="form-control bg-light" style="width: 200px;"placeholder="{{ Auth::user()->email }}" value="{{ Auth::user()->email }}" disabled>
                            <input type="text" name="name" class="form-control bg-light" style="width: 200px;"placeholder="{{ Auth::user()->name }}" value="{{ Auth::user()->name }}" disabled>
                            <input type="text" id="age" name="age" class="form-control bg-white" style="width: 200px;"placeholder="{{ $patients[0]['patage'] }}" value="{{ $patients[0]['patage'] }}">
                            <input type="text" id="gender" class="form-control bg-light" style="width: 200px;"placeholder="{{ $patients[0]['patgen'] }}" value="{{ $patients[0]['patgen'] }}"disabled>
                            <input type="number" id="phoneNumber" name="phoneNumber" class="form-control bg-white" style="width: 200px;"placeholder="0{{ $patients[0]['patphone'] }}" value="{{ $patients[0]['patphone'] }}">
                            @endif
                        </div>
                        <div class="d-flex mt-auto border-top p-4">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                        </div>
                    </div>
                </div>
            </div>

@endsection