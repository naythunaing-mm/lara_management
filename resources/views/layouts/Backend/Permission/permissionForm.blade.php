@extends('layouts.Backend.master')
@section('title', 'permission Form')
@section('content')
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y authentication-wrapper authentication-basic">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">permission Form/</span>
            @if(isset($permissions))
            <span>Edit</span>
            @else
            <span>Register</span>
        @endif
        </h4>
            <div class="row">
                <div class="col-xxl">
                    <div class="card mb-4">
                        <div class="card-body">
                            @if(isset($permissions))
                                <form action="{{ route('permissionUpdate') }}" method="POST" class="needs-validation" id="formAuthentication" novalidate>
                            @else
                                <form action="{{ route('permissionStore') }}" method="POST" class="needs-validation" id="formAuthentication" novalidate>
                            @endif
                                @csrf
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="basic-icon-default-fullname">permission</label>
                                    <div class="col-sm-10">
                                        <div class="">
                                            <input
                                                type  = "text"
                                                class = "form-control"
                                                name  = "name"
                                                value = "{{ (isset($permissions)) ? $permissions->name : '' }}"
                                                id = "basic-icon-default-fullname"
                                                placeholder="General Manager"
                                                aria-label="General Manager"
                                                aria-describedby="permission"
                                                required
                                            />
                                            <div class="invalid-feedback">
                                                @if ($errors->has('name'))
                                                    {{ $errors->first('name') }}
                                                @else
                                                    Please provide a valid permission.
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row justify-content-end">
                                    <div class="col-sm-10">
                                        @if(isset($permissions))
                                            <input type="hidden" name="id" value="{{ $permissions->id }}" />
                                        @endif
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- / Content -->
        <div class="content-backdrop fade"></div>
    </div>
    <!-- Content wrapper -->
@endsection
