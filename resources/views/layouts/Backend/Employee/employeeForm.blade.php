@extends('layouts.Backend.master')
@section('title','Employee')
@section('content')
     <!-- Content wrapper -->
     <div class="content-wrapper">

        <div class="container-xxl flex-grow-1 container-p-y authentication-wrapper authentication-basic">
          <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Account Settings /</span> Account</h4>
          <div class="row">
            <div class="col-md-12">
              <div class="card mb-4">
                <h5 class="card-header">Profile Details</h5>   
                <hr class="my-0" />
                <div class="card-body">
                  @if(isset($employee))
                  <form id="formAccountSettings formAuthentic ation" method="POST" class="needs-validation" action="{{ route('employeeStore') }}" novalidate>
                  @else
                  <form id="formAccountSettings formAuthentic ation" method="POST" class="needs-validation" action="{{ route('employeeStore') }}" novalidate>
                  @endif
                    @csrf

                    <div class="row">
                      <div class="mb-3 col-md-6">
                        <label for="employee_id" class="form-label">Employee-ID</label>
                        <input type="text" class="form-control" id="employee_id" name="employee_id" placeholder="LaraHR-1001" value="{{ (isset($employee)? $employee->employee_id : '') }}" autofocus required />
                        <div class="invalid-feedback">
                          @if ($errors->has('employee_id'))
                          <p style="color:red">Please valid employee_id</p>
                          @endif
                          Invalid Employee ID
                        </div>
                      </div>

                      <div class="mb-3 col-md-6">
                        <label for="name" class="form-label">Name</label>
                        <input class="form-control" type="text" id="name" name="name" placeholder="employee's name" value="{{ (isset($employee)? $employee->name : '') }}"  required />
                        <div class="invalid-feedback">
                          @if ($errors->has('name'))
                          <p style="color:red">Please valid name</p>
                          @endif
                          Invalid Employee Name
                        </div>
                      </div>

                      <div class="mb-3 form-password-toggle col-md-6">
                        <div class="d-flex justify-content-between">
                          <label class="form-label" for="password">Password</label>
                        </div>
                        <div class="input-group input-group-merge">
                          <input type="password" id="password"  class="form-control" name="password" placeholder="password" aria-describedby="password" value="{{ (isset($employee)? $employee->password : '') }}" required />
                          <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                          <div class="invalid-feedback">
                            @if($errors->has('password'))
                            <p style="color:red">Please valid password</p>
                            @endif
                            Invalid Password
                          </div>
                        </div>
                      </div>

                      <div class="mb-3 col-md-6">
                        <label for="email" class="form-label">E-mail</label>
                        <input class="form-control" type="email" id="email" name="email" placeholder="example@gmail.com" value="{{ (isset($employee)? $employee->email : '') }}" required  />
                        <div class="invalid-feedback">
                          @if ($errors->has('email'))
                          <p style="color:red">Please valid email</p>
                          @endif
                          Invalid Email
                        </div>
                      </div>

                      <div class="mb-3 col-md-6">
                        <label for="nrc_number" class="form-label">NRC</label>
                        <input type="text" class="form-control" id="nrc_number" name="nrc_number"  placeholder="1/kakana(N)110211" value="{{ (isset($employee) ? $employee->nrc_number : '') }}"  required />
                        <div class="invalid-feedback">
                          @if ($errors->has('nrc_number'))
                          <p style="color:red">Please valid nrc_number</p>
                          @endif
                          Invalid NRC
                        </div>
                      </div>

                      <div class="mb-3 col-md-6">
                        <label class="form-label" for="phone">Phone Number</label>
                          <input  type="text"  id="phone" name="phone" class="form-control" placeholder="+95-XXX-XXXX-XXX" value="{{ (isset($employee)? $employee->phone : '') }}" required  />
                          <div class="invalid-feedback">
                            @if ($errors->has('phone'))
                            <p style="color:red">Please valid phone</p>
                            @endif
                            Invalid Phone Number
                          </div>
                      </div>

                      <div class="mb-3 col-md-6">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" class="form-control" id="address" name="address" placeholder="Address" value="{{ (isset($employee)? $employee->address : '') }}" required />
                        <div class="invalid-feedback">
                          @if ($errors->has('address'))
                          <p style="color:red">Please valid address</p>
                          @endif
                          Invalid Address
                        </div>
                      </div>

                      <div class="mb-3 col-md-6">
                        <label for="birthday" class="form-label">Birthday</label>
                        <input class="form-control" type="date" id="birthday" name="birthday" value="{{ (isset($employee)? $employee->birthday : '') }}" required />
                        <div class="invalid-feedback">
                          @if ($errors->has('birthday'))
                          <p style="color:red">Please valid birthday</p>
                          @endif
                          Invalid Date Of Birth
                        </div>
                      </div>

                      <div class="mb-3 col-md-6">
                        <label for="date_of_join" class="form-label">Date Of Join</label>
                        <input  type="date" class="form-control"  id="date_of_join"  name="date_of_join" value="{{ (isset($employee)? $employee->date_of_join : '') }}" required  />
                        <div class="invalid-feedback">
                          @if ($errors->has('date_of_join'))
                          <p style="color:red">Please valid date_of_join</p>
                          @endif
                          Invalid Date Of Join
                        </div>
                      </div>

                      <div class="mb-3 col-md-6">
                        <label for="department_id" class="form-label">Department</label>
                        <select id="department_id" class="select2 form-select" name="department_id" required>
                          @if(isset($departments))
                            @foreach($departments as $department)
                              <option value="{{$department->id}}">{{$department->department}}</option>
                            @endforeach
                          @endif
                        </select>
                        <div class="invalid-feedback">
                          @if ($errors->has('department_id'))
                          <p style="color:red">Please valid department_id</p>
                          @endif
                          Invalid Department-ID
                        </div>
                      </div>

                      <div class="mb-3 col-md-6">
                        <label for="gender" class="form-label">Gender</label>
                        <select id="gender" class="select2 form-select" name="gender" required>
                          <option value="">Select Gender</option>
                          <option value="0">Male</option>
                          <option value="1">Female</option>
                        </select>
                        <div class="invalid-feedback">
                          @if ($errors->has('gender'))
                          <p style="color:red">Please valid gender</p>
                          @endif
                          Invalid Gender
                        </div>
                      </div>

                      <div class="mb-3 col-md-6">
                        <label for="status" class="form-label">Status</label>
                        <select id="status" class="select2 form-select" name="status" required>
                          <option value="">Select Status</option>
                          <option value="0">Leave</option>
                          <option value="1">Present</option>
                        </select>
                        <div class="invalid-feedback">
                          @if ($errors->has('status'))
                          <p style="color:red">Please valid status</p>
                          @endif
                          Invalid Status
                        </div>
                      </div>
                    </div>
                    <div class="mt-2">
                      @if(isset($employee))
                      <input type="hidden" name="id" value={{ $employee->id }}>
                      @endif
                      <input type="submit" class="btn btn-primary me-2">
                    </div>
                  </form>
                </div>
                <!-- /Account -->
              </div>
              <div class="card">
                <h5 class="card-header">Delete Account</h5>
                <div class="card-body">
                  <div class="mb-3 col-12 mb-0">
                    <div class="alert alert-warning">
                      <h6 class="alert-heading fw-bold mb-1">Are you sure you want to delete your account?</h6>
                      <p class="mb-0">Once you delete your account, there is no going back. Please be certain.</p>
                    </div>
                  </div>
                  {{-- <form id="formAccountDeactivation" onsubmit="return false">
                    <div class="form-check mb-3">
                      <input
                        class="form-check-input"
                        type="checkbox"
                        name="accountActivation"
                        id="accountActivation"
                      />
                      <label class="form-check-label" for="accountActivation"
                        >I confirm my account deactivation</label
                      >
                    </div>
                    <button type="submit" class="btn btn-danger deactivate-account">Deactivate Account</button>
                  </form> --}}
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
