@extends('layouts.Backend.master')
@section('title','View Listing')
@section('content')
    <!-- Hoverable Table rows -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
        <h5 class="card-header">View Listing</h5>
        <div class="table-responsive text-nowrap">
            <table class="table table-hover" id="yourDataTable">
            <thead>
                <tr>
                <th>View ID</th>
                <th>View Name</th>
                <th>Actions</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @foreach ($views as $view)
                    <tr>
                        <td>{{ $view->id }}</td>
                        <td>{{ $view->name }}</td>
                        <td>
                            <a class="pe-2" href="{{ URL::to('admin-backend/view/edit') }}/{{ $view->id }}"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                            <a class="ps-2" href="{{ URL::to('admin-backend/view/delete') }}/{{ $view->id }}"><i class="bx bx-trash me-1"></i> Delete</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            </table>
            {{  $views->links() }}
        </div>
        </div>
    </div>
    <!--/ Hoverable Table rows -->
@endsection
