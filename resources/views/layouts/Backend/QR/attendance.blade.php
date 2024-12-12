@extends('layouts.Backend.master')
@section('title', 'Check-In/Check-Out')
@section('content')

<div class="container-xxl 100-vh">
    <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">
            <!-- Card for Attendance -->
            <div class="card">
                <div class="card-body">
                    <h4 class="mb-2">
                        Hello, <span class="badge rounded-pill bg-primary">{{ $employee->name }}</span> 👋
                    </h4>
                    <p class="mb-4">Please mark your attendance using the QR Code</p>

                    <!-- QR Code Section -->
                    <div class="d-flex justify-content-center">
                        <img class="img-fluid" src="{{ URL::asset('admin-backend/assets/img/icons') }}/{{ getSiteSetting() !== null ? getSiteSetting()->logo : '' }}"
                             alt="Logo" style="width:130px; height:130px;">
                    </div>

                    <div class="text-center mt-4">
                        {!! $qrCode !!}
                    </div>

                    <!-- Buttons Row -->
                    <div class="d-flex justify-content-center mt-4">
                        <!-- Check-In Form -->
                        <form id="checkinForm" class="me-2" action="{{ route('checkin') }}" method="POST" novalidate>
                            @csrf
                            <input type="hidden" name="employee_id" value="{{ $employee->id }}">
                            <button id="checkinButton" class="btn btn-primary" type="submit">Check-In</button>
                        </form>

                        <!-- Check-Out Form -->
                        <form id="checkoutForm" action="{{ route('checkout') }}" method="POST" novalidate>
                            @csrf
                            <input type="hidden" name="employee_id" value="{{ $employee->id }}">
                            <button id="checkoutButton" class="btn btn-success" type="submit">Check-Out</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Prevent multiple form submissions by disabling the buttons after one click
    document.getElementById('checkinButton').addEventListener('click', function() {
        this.disabled = true;
        document.getElementById('checkinForm').submit();
    });

    document.getElementById('checkoutButton').addEventListener('click', function() {
        this.disabled = true;
        document.getElementById('checkoutForm').submit();
    });
</script>

@endsection
