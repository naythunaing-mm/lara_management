@extends('layouts.Backend.master')
@section('title','Department Listing')
@section('content')
    <!-- Hoverable Table rows -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
        <h5 class="card-header">Departments Listing</h5>
        <div class="table-responsive text-nowrap">
            <table class="table table-hover" id="yourDataTable">
            <thead>
                <tr>
                <th>Department ID</th>
                <th>Department Name</th>
                <th>Actions</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @foreach ($departments as $department)
                    <tr>
                        <td>{{ $department->id }}</td>
                        <td>{{ $department->department }}</td>
                        <td>
                            <a class="" href="{{ URL::to('admin-backend/department/edit') }}/{{ $department->id }}"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                            <a class="" href="{{ URL::to('admin-backend/department/delete') }}/{{ $department->id }}"><i class="bx bx-trash me-1"></i> Delete</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            </table>
            {{  $departments->links() }}
        </div>
        </div>
    </div>
    <!--/ Hoverable Table rows -->
@endsection