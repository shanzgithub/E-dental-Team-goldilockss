@extends('layouts.layout')
@section('content')    

<!-- Appointment Start -->
    <div class="container-fluid my-5 py-5">
        <div class="container py-5">
            <div class="row gx-5">
                <div class="mb-4">
                    @if (Auth::user()->role == 1)
                    <h4 class="display-10">Appointment For : Drg. {{ Auth::user()->name }}</h4>
                    @endif
                </div>

                @if (session()->has('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
                @endif
                @if ($appointments->where('status', 1)->isNotEmpty())
                    <h5>Invoice Documents</h5>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th class="border-top-0">#</th>
                                    <th class="border-top-0">Patient Name</th>
                                    <th class="border-top-0">Treatment Type</th>
                                    <th class="border-top-0">Document</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($appointments->where('status', 1) as $appointment)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$appointment->patname}}</td>
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
                                    <th class="border-top-0">Patient Name</th>
                                    <th class="border-top-0">Document Name</th>
                                    <th class="border-top-0">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($documents->where('type', 1) as $document)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$document->patname}}</td>
                                        <td>{{$document->name}}</td>
                                        <td>
                                            <button type="#" class="btn-sm btn-warning">
                                               <a href="{{ route('patient.download.document', $document->id) }}" style="color: black" >Download</a>
                                            </button></a>
                                            <button type="#" class="btn-sm btn-danger">
                                                <a href="{{ route('delete.document', $document->id) }}" style="color: black" >Delete</a>
                                             </button></a>
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
                                    <th class="border-top-0">Patient Name</th>
                                    <th class="border-top-0">Document Name</th>
                                    <th class="border-top-0">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($documents->where('type', 2) as $document)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$document->patname}}</td>
                                        <td>{{$document->name}}</td>
                                        <td>
                                            <button type="#" class="btn-sm btn-warning">
                                               <a href="{{ route('patient.download.document', $document->id) }}" style="color: black" >Download</a>
                                            </button></a>
                                            <button type="#" class="btn-sm btn-danger">
                                                <a href="{{ route('delete.document', $document->id) }}" style="color: black" >Delete</a>
                                             </button></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif

                
                {{-- <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th class="border-top-0">#</th>
                                <th class="border-top-0">Patient Name</th>
                                <th class="border-top-0">Document Name</th>
                                <th class="border-top-0">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($documents as $document)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$document->patname}}</td>
                                <td>{{$document->name}}</td>
                                <td>
                                    <button type="#" class="btn-sm btn-warning">
                                       <a href="{{ route('patient.download.document', $document->id) }}" style="color: black" >Download</a>
                                    </button></a>
                                    <button type="#" class="btn-sm btn-warning">
                                        <a href="{{ route('delete.document', $document->id) }}" style="color: black" >Delete</a>
                                     </button></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div> --}}
            </div>
        </div>
    </div>
    <!-- Appointment End -->
@endsection