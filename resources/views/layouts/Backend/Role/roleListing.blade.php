@extends('layouts.Backend.master')
@section('title','Role Listing')
@section('content')
    <!-- Hoverable Table rows -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
        <h5 class="card-header">Roles Listing</h5>
        <div class="table-responsive text-nowrap p-5">
            <table class="table table-hover" id="DataTable" style="width:100%;">
            <thead>
                <tr>
                <th>role ID</th>
                <th>Role</th>
                <th>Permission</th>
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
                ajax: '/admin-backend/role/roleDataTable',
                columns: [
                    {"data": "id"},
                    {"data": "name"},
                    {"data": "permissions"},
                    {"data" : "actions"}
                ],
               
            });
        });
    </script>
@endsection