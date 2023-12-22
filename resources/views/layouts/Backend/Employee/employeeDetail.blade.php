@extends('layouts.Backend.master')
@section('title','Employee')
@section('content')
     <!-- Content wrapper -->
     <div class="content-wrapper">

        <div class="container-xxl flex-grow-1 container-p-y authentication-wrapper authentication-basic">
          <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Account Settings /</span>Detail Account</h4>
          <div class="row">
            <div class="col-md-12">
              <div class="card mb-4">
                <h5 class="card-header">{{ (isset($employee)? $employee->name : '') }}</h5> 
                 <!-- Account -->
                 <div class="card-body">
                    <div class="d-flex align-items-center justify-content-center gap-4">
                      <img
                        src="{{URL::asset('admin-backend/assets/img/avatars/1.png')}}"
                        alt="user-avatar"
                        class="d-block rounded"
                        height="130"
                        width="130"
                        id="uploadedAvatar"
                      />
                      <div class="button-wrapper">
                          <input
                            type="file"
                            id="upload"
                            class="account-file-input"
                            hidden
                            accept="image/png, image/jpeg"
                          />
                        </label>
                      </div>
                    </div>
                  </div>
                  <hr class="my-0" />
                <div class="card-body">
                    <div class="row">
                      <div class="mb-3 col-md-6">      
                        <label for="employee_id" class="form-label">Employee-ID</label> <br />
                        <span>{{ (isset($employee)? $employee->employee_id : '') }}</span>
                      </div>

                      <div class="mb-3 col-md-6">
                        <label for="name" class="form-label">Name</label> <br />
                        <span>{{ (isset($employee)? $employee->name : '') }}</span>
                      </div>

                      <div class="mb-3 col-md-6">
                        <label for="email" class="form-label">E-mail</label> <br />
                        <span>{{ (isset($employee)? $employee->email : '') }}</span>
                      </div>

                      <div class="mb-3 col-md-6">
                        <label for="nrc_number" class="form-label">NRC</label> <br />
                        <span>{{ (isset($employee)? $employee->nrc_number : '') }}</span>
                      </div>

                      <div class="mb-3 col-md-6">
                        <label class="form-label" for="phone">Phone Number</label> <br />
                        <span>{{ (isset($employee)? $employee->phone : '') }}</span>
                      </div>

                      <div class="mb-3 col-md-6">
                        <label for="address" class="form-label">Address</label> <br />
                        <span>{{ (isset($employee)? $employee->address : '') }}</span>
                      </div>

                      <div class="mb-3 col-md-6">
                        <label for="birthday" class="form-label">Birthday</label> <br />
                        <span>{{ (isset($employee) ? \Carbon\Carbon::parse($employee->birthday)->format('Y-m-d') : '') }}</span>
                      </div>

                      <div class="mb-3 col-md-6">
                        <label for="date_of_join" class="form-label">Date Of Join</label> <br />
                        <span>{{ (isset($employee) ? \Carbon\Carbon::parse($employee->date_of_join)->format('Y-m-d') : '') }}</span>
                      </div>

                      <div class="mb-3 col-md-6">
                        <label for="department_id" class="form-label">Department</label> <br />
                        <span>
                          @if(optional($employee->getDepartment)->department != null)
                              {{ $employee->getDepartment->department }}
                          @endif
                        </span>
                      </div>

                      <div class="mb-3 col-md-6">
                        <label for="gender" class="form-label">Gender</label> <br />
                        <span>
                          @if(isset($employee))
                          {{ $employee->gender == 0 ? 'Male' : 'Female' }}
                        @endif
                        </span>
                      </div>

                      <div class="mb-3 col-md-6">
                        <label for="status" class="form-label">Gender</label> <br />
                        <span>
                          @if(isset($employee))
                          {{ $employee->status == 0 ? 'Leave' : 'Present' }}
                        @endif
                        </span>
                      </div>
                    </div>
                  </form>
                </div>
                <!-- /Account -->
              </div>
            </div>
          </div>
        </div>
        <!-- / Content -->

        <div class="content-backdrop fade"></div>
    </div>
    <!-- Content wrapper -->

@endsection
