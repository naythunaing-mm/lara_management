@extends('layouts.Backend.master')
@section('title', 'Check-In/Check-Out')
@section('content')

<div class="container-xxl vh-100">
    <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">
            <!-- Card for Attendance -->
            <div class="card">
                <div class="card-body">
                    <h4 class="mb-2">
                        Hello, <span class="badge rounded-pill bg-primary">{{ $employee->name }}</span> 👋
                    </h4>
                    <p class="mb-4">Please mark your attendance using click</p>
                    <div class="d-flex mt-4">
                        <form id="checkinForm" class="me-2" action="{{ route('checkin') }}" method="POST" novalidate>
                            @csrf
                            <input type="hidden" name="employee_id" value="{{ $employee->id }}">
                            <button id="checkinButton" class="btn btn-primary" type="submit">Checkin</button>
                        </form>

                        <form id="checkoutForm" action="{{ route('checkout') }}" method="POST" novalidate>
                            @csrf
                            <input type="hidden" name="employee_id" value="{{ $employee->id }}">
                            <button id="checkoutButton" class="btn btn-success" type="submit">Checkout</button>
                        </form>
                    </div>
                    <hr>
                    <p class="mb-4">Please mark your attendance using QR code</p>
                    <!-- QR Code Section -->
                    <!-- <div class="d-flex justify-content-center">
                        <img class="img-fluid" src="{{ URL::asset('admin-backend/assets/img/icons') }}/{{ getSiteSetting() !== null ? getSiteSetting()->logo : '' }}"
                             alt="Logo" style="width:130px; height:130px;">
                    </div> -->

                    <div class="text-center mt-4">
                        <!-- {!! $qrCode !!} -->
                         <img src="{{URL::asset('admin-backend/assets/img/QR.svg')}}" style="width: 250px;height:200px;" class="border p-3" alt="">
                         <p class="text-muted mb-1">Please Scan with QR</p>
                         <a href="" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCenter"><span class="d-flex">Scan &nbsp;<box-icon name='scan'></box-icon></span></a>
                    </div>
                    <div class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="modalCenterTitle">QR Scanning</h5>
                            <button
                                type="button"
                                class="btn-close"
                                data-bs-dismiss="modal"
                                aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <video id="video"></video>
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">
                                Close
                            </button>
                            </div>
                        </div>
                        </div>
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
@section('script')
<script src="{{ asset('admin-backend/js/qr-scanner.umd.min.js') }}"></script>
<script>
   $(document).ready(function() {
    var videoElem = document.getElementById('video');
    const qrScanner = new QrScanner(
        videoElem,
        function(result) {
            console.log(result);
        },
        function(error) {
            console.error(error);
        }
    );

    qrScanner.start().catch(err => console.error('Error starting scanner: ', err));
});
</script>
@endsection
