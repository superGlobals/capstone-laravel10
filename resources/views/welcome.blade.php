@extends('frontpage.main')
@section('content')
    
    <div class="row mt-5">
        <div class="col-md-4">
            <img src="{{ asset('images/poclogo1.png') }}" style="width: 90%; margin-top: 13%"  alt="">
        </div>
        <div class="col-md-8" style="margin-top: 13%">
            <h1><span class="fw-bold">NEUST - POC</span> Learning Management System</h1>
            <h3 class="text-muted">Transforming communities through Science and Technology</h3>
            <div class="mt-5">
                <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
            </div>
        </div>
        
    </div>
    

@endsection