@extends('layouts.adminlayout')
@section('content')

<div class="row">
    <div class="col-sm-12">
        <div class="white-box">
            @if(session('message'))
            <div class="alert alert-success">{{ session('message') }}</div>
            @endif
            <h3 class="box-title">Manage Users</h3>
            <div class="table-responsive">
                <table class="table text-nowrap">
                    <thead>
                        <tr>
                            <th class="border-top-0">#</th>
                            <th class="border-top-0">User Name</th>
                            <th class="border-top-0">Email</th>
                            <th class="border-top-0">User Role</th>
                            <th class="border-top-0">User Status</th>
                            <th class="border-top-0">Action</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>@if($user->role == 0)
                                Patient
                            @else Dentist</td>
                            @endif
                            <td>@if($user->userstatus == 0)
                                Pending
                            @elseif($user->userstatus == 1)
                                Approve
                            @else Reject
                            </td>
                            @endif
                            <td>
                                <form action="{{route('admin.user.update', $user->id)}}" method="POST">
                                    @csrf
                                    @method('PUT')
                                <input type="hidden" name="id" value="{{ $user->id }}">
                                <button type="submit" class="btn btn-success" name="changestatus">
                                    <input type="hidden"id="changestatus"name="changestatus" value="1">Approve
                                </button>
                                </form>
                            </td>
                            <td>
                                <form action="{{route('admin.user.update', $user->id)}}" method="POST">
                                    @csrf
                                    @method('PUT')
                                <input type="hidden" name="id" value="{{ $user->id }}">
                                <button type="submit" class="btn btn-danger" name="changestatus">
                                    <input type="hidden"id="changestatus"name="changestatus" value="3">Reject</button>
                                </form>

                                {{-- <form action="{{route('admin.user.update', $user->id)}}" method="POST">
                                    @csrf
                                    @method('PUT')
                                <input type="hidden" name="id" value="{{ $user->id }}">
                                <button type="submit" class="btn btn-success" name="changestatus">
                                    <input type="hidden"id="changestatus"name="changestatus" value="1">Approve
                                </button>
                                <button type="submit" class="btn btn-danger" name="changestatus">
                                    <input type="hidden"id="changestatus"name="changestatus" value="3">Reject</button>
                                </form> --}}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection