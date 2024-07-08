@extends('layouts.layout')
@section('content')

<!-- Hero Start -->
<div class="container-fluid bg-primary py-5 mb-5 hero-header">
    <div class="container py-5">
        <div class="row justify-content-start">
            <div class="col-lg-8 text-center text-lg-start">
                <h5 class="d-inline-block text-primary text-uppercase border-bottom border-5" style="border-color: rgba(256, 256, 256, .3) !important;">Welcome To E-Dental</h5>
                <h1 class="display-1 text-white mb-md-4">Best Dentalcare Solution In Your City</h1>
                <div class="pt-2">
                    @if (Auth::user()->role == 0)
                    <a href="viewappointment" class="btn btn-light rounded-pill py-md-3 px-md-5 mx-2">View Appointment</a>
                    <a href="makeappointment" class="btn btn-outline-light rounded-pill py-md-3 px-md-5 mx-2">Make Appointment</a>
                    @else
                    <a href="viewappointment" class="btn btn-light rounded-pill py-md-3 px-md-5 mx-2">View Appointment</a>
                    <a href="approveappointment" class="btn btn-outline-light rounded-pill py-md-3 px-md-5 mx-2">Approve Appointment</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
  </div>
  <!-- Hero End -->
  
  
  <!-- About Start -->
  <div class="container-fluid py-5">
    <div class="container">
        <div class="row gx-5">
            <div class="col-lg-5 mb-5 mb-lg-0" style="min-height: 500px;">
                <div class="position-relative h-100">
                    <img class="position-absolute w-100 h-100 rounded" src="{{ asset('assets/img/about.jpg') }}" style="object-fit: cover;">
                </div>
            </div>
            <div class="col-lg-7">
                <div class="mb-4">
                    <h5 class="d-inline-block text-primary text-uppercase border-bottom border-5">About Us</h5>
                    <h1 class="display-4">Best Dental Care For Yourself and Your Family</h1>
                </div>
                <p>Experience the best dental care for yourself and your family with our exceptional services.
                    We understand the importance of oral health and provide comprehensive treatments tailored to meet the unique needs of each family member.
                    Our skilled team of dentists is committed to delivering gentle and personalized care in a comfortable environment.
                    From routine check-ups and cleanings to advanced procedures, we prioritize your wellbeing and strive to create beautiful, healthy smiles.
                    Trust us to provide the highest quality dental care, ensuring lasting oral health for you and your loved ones.
                    Contact us today and make us your partner in achieving optimal dental wellness.</p>
            </div>
        </div>
    </div>
  </div>
  <!-- About End -->

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
                    @if (Auth::user()->role == 0)
                    <a href="viewappointment" class="btn btn-light rounded-pill py-md-3 px-md-5 mx-2">View Appointment</a>
                    <a href="makeappointment" class="btn btn-outline-light rounded-pill py-md-3 px-md-5 mx-2">Make Appointment</a>
                    @else
                    <a href="viewappointment" class="btn btn-light rounded-pill py-md-3 px-md-5 mx-2">View Appointment</a>
                    <a href="approveappointment" class="btn btn-outline-light rounded-pill py-md-3 px-md-5 mx-2">Approve Appointment</a>
                    @endif
            </div>
            <div class="col-lg-6 mb-5 mb-lg-0">
                <div class="mb-4">
                    <h5 class="d-inline-block text-white text-uppercase border-bottom border-5">Digital Document</h5>
                    <h1 class="display-4">Record Your Digital Document</h1>
                </div>
                <p class="text-white mb-5">Take control of your dental care journey and ensure your digital documents are securely recorded.
                    By keeping a comprehensive record of your dental history, treatment plans, and important documents, you empower yourself to
                    make informed decisions and maintain optimal oral health. Safeguard your dental records digitally, allowing easy access and seamless sharing
                    with your dental professionals. Whether it's dental x-rays, treatment notes, or insurance information, organizing your digital documents will
                    streamline your dental appointments and enhance the efficiency of your care. Don't leave your oral health to chance – start recording your digital
                    documents today and enjoy peace of mind knowing that your dental care is in your hands.</p>
                    @if (Auth::user()->role == 0)
                    <a href="DigitalDocument" class="btn btn-light rounded-pill py-md-3 px-md-5 mx-2">View Document</a>
                    <a href="UploadDigitalDocument" class="btn btn-outline-light rounded-pill py-md-3 px-md-5 mx-2">Upload Document</a>
                    @else
                    <a href="dentistdocument" class="btn btn-light rounded-pill py-md-3 px-md-5 mx-2">View Document</a>
                    <a href="UploadDigitalDocument" class="btn btn-outline-light rounded-pill py-md-3 px-md-5 mx-2">Upload Document</a>
                    @endif
            </div>
        </div>
    </div>
  </div>
  <!-- Appointment End -->

  @endsection
  
  
  