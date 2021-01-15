@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="text-center" >

                <div class="card">
                <div class="card-header">{{ __(' WELCOME Clinic SYSTEM') }}</div>
                
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in NOW IN CLINIC SYSTEM!') }}

                </div>
                </div>
            </div>
            <br>
            <br>
            <center>
                <a href="{{route('home')}}" type="button" class="btn btn-primary btn-lg btn-block">HOME</a>
                <a href="{{route('patient.create')}}" type="button" class="btn btn-primary btn-lg btn-block">PATIENT AND ADD ORDER</a>

                <a href="{{route('order.index')}}" type="button" class="btn btn-primary btn-lg btn-block">SHOW ALL ORDERS</a>
                <a href="{{route('clinic.index')}}" type="button" class="btn btn-primary btn-lg btn-block">CLINICS CONTROL</a>

            </center>
        </div>
    </div>
</div>
@endsection
