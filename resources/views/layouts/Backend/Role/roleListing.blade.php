@extends('layouts.Backend.master')
@section('title','Role Listing')
@section('content')
    <!-- Hoverable Table rows -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
        <h5 class="card-header">Roles Listing</h5>
        <div class="table-responsive text-nowrap">
            <table class="table table-hover" id="yourDataTable">
            <thead>
                <tr>
                <th>role ID</th>
                <th>Role</th>
                <th>Permission</th>
                <th>Actions</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @foreach ($roles as $role)
                    <tr>
                        <td>{{ $role->id }}</td>
                        <td>{{ $role->name }}</td>
                        <td>
                            @foreach ($role->permissions as $permission)
                            <span class="badge rounded-pill bg-primary">{{ $permission->name }}</span>
                            @endforeach
                        </td>                        
                       
                        <td>
                            <a class="" href="{{ URL::to('admin-backend/role/edit') }}/{{ $role->id }}"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                            <a class="" href="{{ URL::to('admin-backend/role/delete') }}/{{ $role->id }}"><i class="bx bx-trash me-1"></i> Delete</a>
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