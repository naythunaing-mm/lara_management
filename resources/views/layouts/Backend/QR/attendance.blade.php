@extends('layouts.Backend.master')
@section('title', 'Check/Checkout')
@section('content')
<div class="container-xxl 100-vh">
    <div class="authentication-wrapper authentication-basic container-p-y">
    <div class="authentication-inner">
        <!-- Register -->
        <div class="card">
        <div class="card-body">
        <h4 class="mb-2">Hello <span class="badge rounded-pill bg-primary">{{ $employee->name }}</span> 👋</h4>
        <p class="mb-4">Please addentance with QR CODE</p>
        <div class="d-flex justify-content-center">
            <img class="img-fluid" src="{{URL::asset('admin-backend/assets/img/icons') }}/{{ getSiteSetting() !== null ? getSiteSetting()->logo : ''  }}" alt="" style="width:130px;height:130px;">
        </div>
            <form id="formAuthentication" class="mb-3 needs-validation" action="{{route('checkin')}}" method="POST" novalidate>
                @csrf
                <div class="text-center mt-4">{!! $qrCode !!}</div>

                <div class="mt-2">
                    <input class="btn btn-primary" type="submit" value="Checkin">
                </div>
                <input type="hidden" name="employee_id" value="{{$employee->id}}">
            </form>
        </div>
        </div>
    </div>
    </div>
</div>

@endsection
