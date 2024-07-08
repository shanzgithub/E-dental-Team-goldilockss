@extends('layouts.layout')
@section('content')    

<!-- Appointment Start -->
    <div class="container-fluid my-5 py-5">
        <div class="container py-5">
            <div class="row gx-5">
                <div class="mb-4">
                    @if ($gender == '[{"gender":"Male"}]')
                        <h4 class="display-10">Appointment For : Mr. {{ Auth::user()->name }}</h4>
                    @else 
                        <h4 class="display-10">Appointment For : Mrs. {{ Auth::user()->name }}</h4>
                    @endif
                </div>
                
                @if (session()->has('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
                @endif

                @if ($documents->isEmpty())
                <p>No record of Digital Document.</p>
                @else
                
                @if ($appointments->where('status', 1)->isNotEmpty())
                    <h5>Invoice Documents</h5>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th class="border-top-0">#</th>
                                    <th class="border-top-0">Dentist Name</th>
                                    <th class="border-top-0">Treatment Type</th>
                                    <th class="border-top-0">Document</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($appointments->where('status', 1) as $appointment)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>Drg. {{$appointment->dentname}}</td>
                                        <td>{{$appointment->treatmentname}}</td>
                                        <td>
                                            <button type="#" class="btn-sm btn-warning">
                                                <a href="{{ route('generate.invoice', $appointment->appointmentID) }}" style="color: black" >Generate</a>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif

                @if ($documents->where('type', 1)->isNotEmpty())
                    <h5>Receipt Documents</h5>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th class="border-top-0">#</th>
                                    <th class="border-top-0">Dentist Name</th>
                                    <th class="border-top-0">Document Name</th>
                                    <th class="border-top-0">Document</th>
                                    <th class="border-top-0">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($documents->where('type', 1) as $document)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>Drg. {{$document->dentname}}</td>
                                        <td>{{$document->name}}</td>
                                        <td>
                                            <button type="#" class="btn-sm btn-warning">
                                                <a href="{{ route('patient.download.document', $document->id) }}" style="color: black" >Download</a>
                                            </button>
                                        </td>
                                        <td>
                                            <button type="#" class="btn-sm btn-danger">
                                                <a href="{{ route('delete.document', $document->id) }}" style="color: black" >Delete</a>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif

                @if ($documents->where('type', 2)->isNotEmpty())
                    <h5>Digital History Documents</h5>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th class="border-top-0">#</th>
                                    <th class="border-top-0">Dentist Name</th>
                                    <th class="border-top-0">Document Name</th>
                                    <th class="border-top-0">Document</th>
                                    <th class="border-top-0">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($documents->where('type', 2) as $document)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>Drg. {{$document->dentname}}</td>
                                        <td>{{$document->name}}</td>
                                        <td>
                                            <button type="#" class="btn-sm btn-warning">
                                                <a href="{{ route('patient.download.document', $document->id) }}" style="color: black" >Download</a>
                                            </button>
                                        </td>
                                        <td>
                                            <button type="#" class="btn-sm btn-danger">
                                                <a href="{{ route('delete.document', $document->id) }}" style="color: black" >Delete</a>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
                @endif
            </div>
        </div>
    </div>
    <!-- Appointment End -->
@endsection