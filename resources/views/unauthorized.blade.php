@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ ucfirst(@Auth::user()->role) }} - Dashboard</div>

                <div class="card-body">
                    <p>Dear {{ ucfirst(@Auth::user()->name) }},</p>
                    <p>You cannot access this page! This is for only {{$role}}. <b>Go to <a href="{{ route('home') }}">Home</a></b></p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
