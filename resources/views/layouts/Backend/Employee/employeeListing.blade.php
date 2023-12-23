@extends('layouts.Backend.master')
@section('title','Employee Listing')
@section('content')
    <!-- Hoverable Table rows -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
        <h5 class="card-header">Employee Listing</h5>
        <div class="table-responsive text-nowrap">
            <table class="table table-hover" id="yourDataTable">
            <thead>
                <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Department</th>
                <th>NRC</th>
                <th>Actions</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @foreach ($employees as $employee)
                    <tr>
                        <td>{{ $employee->employee_id }}</td>
                        <td>{{ $employee->name }}</td>
                        <td>{{ $employee->email }}</td>
                        <td>
                            @if(optional($employee->getDepartment)->department != null)
                                {{ $employee->getDepartment->department }}
                            @endif
                        </td>
                        <td>{{ $employee->nrc_number }}</td>
                        <td>
                            <a class="" href="{{ URL::to('admin-backend/employee/edit') }}/{{ $employee->id }}"><i class="bx bx-edit-alt me-1"></i> </a> |
                            <a class="" href="{{ URL::to('admin-backend/employee/delete') }}/{{ $employee->id }}"><i class="bx bx-trash me-1"></i> </a> |
                            <a class="" href="{{ URL::to('admin-backend/employee/detail') }}/{{ $employee->id }}"><i class="menu-icon tf-icons bx bx-copy"></i> </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            </table>
            {{  $employees->links() }}
        </div>
        </div>
    </div>
    <!--/ Hoverable Table rows -->
      @if (session('success_msg'))
    <script>
        Swal.fire({
            position: "top-end",
            icon: "success",
            title: "Your work has been saved",
            showConfirmButton: false,
            timer: 1500
        });
    </script>
    @endif
@endsection