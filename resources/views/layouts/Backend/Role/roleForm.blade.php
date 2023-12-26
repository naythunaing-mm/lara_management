@extends('layouts.Backend.master')
@section('title', 'Role Form')
@section('content')
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y authentication-wrapper authentication-basic">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Role Form/</span>
            @if(isset($roles))
            <span>Edit</span>
            @else
            <span>Register</span>
        @endif
        </h4>
            <div class="row">
                <div class="col-xxl">
                    <div class="card mb-4">
                        <div class="card-body">
                            @if(isset($roles))
                                <form action="{{ route('roleUpdate') }}" method="POST" class="needs-validation" id="formAuthentication"  novalidate>
                            @else
                                <form action="{{ route('roleStore') }}" method="POST" class="needs-validation" id="formAuthentication" novalidate>
                            @endif
                                @csrf
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="basic-icon-default-fullname">role</label>
                                    <div class="col-sm-10">
                                        <div class="">
                                            <input
                                                type  = "text"
                                                class = "form-control"
                                                name  = "name"
                                                value = "{{ (isset($roles)) ? $roles->name : '' }}"
                                                id = "basic-icon-default-fullname"
                                                placeholder="HR"
                                                aria-label="HR"
                                                aria-describedby="role"
                                                required
                                            />
                                            <div class="invalid-feedback">
                                                @if ($errors->has('name'))
                                                    {{ $errors->first('name') }}
                                                @else
                                                    Please provide a valid role.
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3 d-md-flex">
                                    <label class="col-sm-2 col-form-label" for="basic-icon-default-fullname">Permission</label>
                                    <div class="row px-3">
                                        @foreach ($permissions as $permission)
                                            <div class="col-sm-6 col-md-4 form-check">
                                                @php
                                                    $isChecked = isset($oldPermissions) && $oldPermissions->contains($permission->id);
                                                @endphp
                                                <input class="form-check-input" 
                                                    type="checkbox" 
                                                    id="permission_{{ $permission->id }}" 
                                                    name="permission[]" 
                                                    value="{{ $permission->name }}" 
                                                    {{ $isChecked ? 'checked' : '' }}
                                                />
                                                <label class="form-check-label" for="permission_{{ $permission->id }}">
                                                    {{ $permission->name }}
                                                </label>
                                            </div>
                                        @endforeach

                                    </div>
                                </div>                                       

                                <div class="row justify-content-end">
                                    <div class="col-sm-10">
                                        @if(isset($roles))
                                            <input type="hidden" name="id" value="{{ $roles->id }}" />
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
    <script>
    document.getElementById('formAuthentication').addEventListener('submit', function(event) {
        var checkboxes = document.querySelectorAll('input[name="permission[]"]:checked');
        if (checkboxes.length === 0) {
            alert('Please select at least one permission.');
            event.preventDefault(); // Prevent the form from submitting
        }
    });
</script>
@endsection
