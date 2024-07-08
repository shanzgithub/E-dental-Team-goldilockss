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
            @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
            @endif
        </div>
        <div class="position-relative">
            <div class="team-item">
                <div class="row g-0 bg-light rounded overflow-hidden">
                    <div class="col-12 col-sm-5 h-100">
                        @if(Auth::user()->role == 1)
                        <img class="img-fluid h-100" src="{{ asset('assets/img/dentist.png') }}" style="object-fit: cover;">
                        @else
                        <img class="img-fluid h-100" src="{{ asset('assets/img/patient.png') }}" style="object-fit: cover;">
                        @endif
                    </div>
                    <div class="col-12 col-sm-7 h-100 d-flex flex-column">
                        <div class="mt-auto p-4">
                            @if(Auth::user()->role == 1)
                            <h3>{{ Auth::user()->name }}</h3>
                            <h6 class="fw-normal fst-italic text-primary mb-4">Dentist Profile</h6>
                            <p class="m-0">E-Mail : {{ Auth::user()->email }}</p>
                            <p class="m-0">Age : {{ $dentists[0]['dentage'] }}</p>
                            <p class="m-0">Gander : {{ $dentists[0]['dentgen'] }}</p>
                            <p class="m-0">Phone Number : 0{{ $dentists[0]['dentphone'] }}</p>
                            @else
                            <h3>{{ Auth::user()->name }}</h3>
                            <h6 class="fw-normal fst-italic text-primary mb-4">Patient Profile</h6>
                            <p class="m-0">E-Mail : {{ Auth::user()->email }}</p>
                            <p class="m-0">Age : {{ $patients[0]['patage'] }}</p>
                            <p class="m-0">Gander : {{ $patients[0]['patgen'] }}</p>
                            <p class="m-0">Phone Number : 0{{ $patients[0]['patphone'] }}</p>
                            @endif
                        </div>
                        <div class="d-flex mt-auto border-top p-4">
                            <a href="{{route('update.user.details', $user->id)}}"><button class="btn btn-primary" >Edit Profile</button> </a>
                        </div>
                    </div>
                </div>
            </div>

@endsection