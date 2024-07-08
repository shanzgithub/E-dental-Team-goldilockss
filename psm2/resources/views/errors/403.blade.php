@extends('layouts.error')
@section('subject')
<div class="max-w-xl mx-auto sm:px-6 lg:px-8">
    <div class="flex items-center pt-8 sm:justify-start sm:pt-0">
        <div class="px-4 text-lg text-gray-500 border-r border-gray-400 tracking-wider">
            403
        </div>

        <div class="ml-4 text-lg text-gray-500 uppercase tracking-wider">
            {{ $exception->getMessage() }}
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-4">
            <a href="{{ url()->previous() }}"> <button class="btn btn-danger">Return</button></a>
        </div>
    </div>
</div>
@endsection