@extends('layouts.Backend.master')
@section('title','Attendance Listing')
@section('content')
    <!-- Hoverable Table rows -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
        <h5 class="card-header">Attendance Listing</h5>
        <div class="table-responsive text-nowrap p-5">
            <table class="table table-hover" id="DataTable" style="width:100%;">
            <thead>
                <tr>

                <th>Employee ID</th>
                <th>Name</th>
                <th>Checkin Time</th>
                <th>Checkout Time</th>
                <th>Date</th>
                <th>Actions</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
            </tbody>
            </table>
        </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
       $(document).ready(function () {
        $('#DataTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: '/admin-backend/attendanceDataTable',
            columns: [
                { "data": "id" },
                { "data": "name" },
                { "data": "created_at" },
                { "data": "updated_at" },
                { "data": "date" },
                { "data": "actions", orderable: false, searchable: false },
            ],
        });
});
    </script>
@endsection
