@extends('layouts.Backend.master')
@section('title','Permission Listing')
@section('content')
    <!-- Hoverable Table rows -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
        <h5 class="card-header">Permissions Listing</h5>
        <div class="table-responsive text-nowrap">
            <table class="table table-hover" id="yourDataTable">
            <thead>
                <tr>
                <th>Permission ID</th>
                <th>Permission</th>
                <th>Actions</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @foreach ($permissions as $permission)
                    <tr>
                        <td>{{ $permission->id }}</td>
                        <td>{{ $permission->name }}</td>
                        <td>
                            <a class="" href="{{ URL::to('admin-backend/permission/edit') }}/{{ $permission->id }}"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                            <a class="" href="{{ URL::to('admin-backend/permission/delete') }}/{{ $permission->id }}"><i class="bx bx-trash me-1"></i> Delete</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            </table>
        </div>
        </div>
    </div>
    <!--/ Hoverable Table rows -->
@endsection