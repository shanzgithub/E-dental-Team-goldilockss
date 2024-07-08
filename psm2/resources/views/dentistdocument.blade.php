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
                @if ($documents->isEmpty())
                <p>No record of Digital Document.</p>
                @else
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th class="border-top-0">#</th>
                                <th class="border-top-0">Patient Name</th>
                                <th class="border-top-0">Documents</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $printedUsernames = [];
                            @endphp
                            @foreach($documents as $document)
                            {{-- @if($document->dentistID == Auth::user()->id) --}}
                            @if (!in_array($document->patname, $printedUsernames))
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$document->patname}}</td>
                                {{-- <td>
                                    <button type="#" class="btn-sm btn-warning">
                                       <a href="{{ route('patient.download.document', $document->id) }}" style="color: black" >Download</a>
                                    </button></a>
                                    <button type="#" class="btn-sm btn-warning">
                                        <a href="{{ route('delete.document', $document->id) }}" style="color: black" >Delete</a>
                                     </button></a>
                                </td> --}}
                                <td>
                                    <button type="#" class="btn-sm btn-warning">
                                       <a href="{{ route('patient.view.document', $document->patientID) }}" style="color: black" >View Documents</a>
                                    </button></a>
                                </td>
                                <?php $printedUsernames[] = $document->patname; ?>
                            </tr>
                            @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif
            </div>
        </div>
    </div>
    <!-- Appointment End -->
@endsection