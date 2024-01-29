@extends('layouts.Backend.master')
@section('title','Employee Listing')
@section('content')
    <!-- Hoverable Table rows -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
        <h5 class="card-header">Employee Listing</h5>
        <div class="table-responsive text-nowrap p-5">
            <table class="table table-hover" id="DataTable" style="width:100%;">
            <thead>
                <tr>
                <th></th>
                <th>ID</th>
                <th>Email</th>
                <th>Department</th>
                <th>Role</th>
                <th>NRC</th>
                <th>Status</th>
                <th>Updated_at</th>
                <th>Actions</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
            </tbody>
            </table>
        </div>
        </div>
    </div>
    <!--/ Hoverable Table rows -->
@endsection
@section('script')
<script>
        $(document).ready(function () {
            $('#DataTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '/admin-backend/employee/employee/employeeDataTable',
                columns: [
                    {"data" : "profile",class: ''},
                    {"data": "employee_id"},
                    {"data": "email"},
                    {"data": "department", class: 'text-center'},
                    {"data" : "roles"},
                    {"data": "nrc_number"},
                    {"data": "status"},
                    {"data": "updated_at"},
                    {"data" : "actions"}
                    
                ],
               
            });
        });
    </script>
@endsection