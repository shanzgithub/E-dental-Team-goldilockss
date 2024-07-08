@extends('layouts.layout')
@section('content')    

<!-- Appointment Start -->
    <div class="container-fluid bg-primary my-5 py-5">
        <div class="container py-5">
            <div class="row gx-5">
                <div class="col-lg-6 mb-5 mb-lg-0">
                    <div class="mb-4">
                        <h5 class="d-inline-block text-white text-uppercase border-bottom border-5">Digital Document</h5>
                        <h1 class="display-4">Please upload your digital documents.</h1>
                    </div>
                    @if (Auth::user()->role == 0)
                    <p class="text-white mb-5">To assist us in providing you with optimal dental care, please upload your digital documents. 
                        These documents will help us understand your dental history and any previous treatments. 
                        Rest assured that your information will remain confidential and securely stored. 
                        Thank you for your cooperation in ensuring we can prioritize your dental health and well-being.</p>
                    @else
                    <p class="text-white mb-5">Please upload your digital documents for dental purposes. 
                        These documents play a crucial role in ensuring effective collaboration and comprehensive patient care. 
                        Diagnostic images, treatment plans, clinical notes, and other relevant information contribute to a thorough understanding of the patient's dental history and ongoing treatment needs. 
                        Rest assured that all uploaded documents will be handled securely and kept confidential. 
                        Your cooperation in sharing this information greatly benefits our dental practice and the well-being of our patients.</p>
                    @endif
                </div>
                <div class="col-lg-6">
                    <div class="bg-white text-center rounded p-5">
                        <h1 class="mb-4">Upload Your Document</h1>
                        <form method="POST" action="{{ route('upload.document.new') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row g-3">
                                @if (session()->has('message'))
                                <div class="alert alert-success">
                                    {{ session('message') }}
                                </div>
                                @endif
                                {{-- <div class="col-12 col-sm-6">
                                    <select class="form-select bg-light border-0" style="height: 55px;" name="treatmentID">
                                        <option selected>Choose Treatment</option>
                                        @foreach($treatments as $treatment)
                                        <option value="{{$treatment->id}}">{{$treatment->treatmentName}}</option>
                                        @endforeach
                                    </select>
                                </div> --}}

                                @if (Auth::user()->role == 0)
                                <div class="col-12 col-sm-6">
                                    <select class="form-select bg-light border-0" style="height: 55px;" name="dentistID">
                                        <option selected value="">Select Dentist</option>
                                        @foreach($users as $user)
                                        <option value="{{$user->id}}">{{$user->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('dentistID')
                                    <span style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-12 col-sm-6">
                                    <input type="hidden" value="{{ Auth::user()->id }}" name="patientID">
                                    <input type="hidden" value="0" name="status">
                                    <input type="text" class="form-control bg-light border-0" placeholder="{{ Auth::user()->name }}" style="height: 55px;" value="{{ Auth::user()->name }}" disabled>
                                </div>
                                @else
                                <div class="col-12 col-sm-6">
                                    <select class="form-select bg-light border-0" style="height: 55px;" name="patientID">
                                        <option selected>Select Patient</option>
                                        @foreach($users as $user)
                                        <option value="{{$user->id}}">{{$user->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('patientID')
                                    <span style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-12 col-sm-6">
                                    <input type="hidden" value="{{ Auth::user()->id }}" name="dentistID">
                                    <input type="hidden" value="0" name="status">
                                    <input type="text" class="form-control bg-light border-0" placeholder="Drg. {{ Auth::user()->name }}" style="height: 55px;" value="Drg. {{ Auth::user()->name }}" disabled>
                                </div>
                                @endif
                                <div class="col-12 col-sm-6">
                                    <input type="text" class="form-control bg-light border-0" placeholder="Enter Document Name" style="height: 55px;" value="" name="name">
                                    @error('name')
                                    <span style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-12 col-sm-6">
                                    <select class="form-select bg-light border-0" style="height: 55px;" name="type">
                                        <option selected value="">Type of Document</option>
                                        <option value=0>Invoice</option>
                                        <option value=1>Receipt</option>
                                        <option value=2>Digital History</option>
                                    </select>
                                    @error('type')
                                    <span style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-12 col-sm-6">
                                    <input type="file" class="form-control bg-light border-0" placeholder="Enter Document Name" value="" name="file">
                                	@error('file')
                                	<span style="color: red">{{ $message }}</span>
                                	@enderror
                                </div>
                                <span>*Please upload a PDF document (max 2MB).</span>
                                <div class="col-12">
                                    <button class="btn btn-primary w-100 py-3" type="submit">Upload Document</button>
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