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
                <h5 class="card-header"></h5>
                 <!-- Account -->
                 <div class="row">
                    <div class="col-md-6 col-sm-12">
                      <div class="card-body d-flex justify-content-start">
                          <div class="gap-4 ">
                            @if(isset($employee))
                                <img
                                src="{{$employee->profilePath()}}"
                                alt="user-avatar"
                                class="rounded-circle border border-info p-1"
                                height="140"
                                width="140"
                                id="uploadedAvatar"
                                name="file" required
                                />
                            @endif
                            <p class="mt-2 fs-4 mx-2">{{ (isset($employee)? $employee->name : '') }}</p>
                            <span>{{ (isset($employee)? $employee->formatted_id : '') }}</span> | <span class="text-success fs-5">{{ (isset($employee)? $employee->phone : '') }}</span><br>
                            <span class="badge rounded-pill bg-primary">
                                @if(optional($employee->getDepartment)->department != null)
                                    {{ $employee->getDepartment->department }}
                                @endif
                              </span>
                          </div>
                      </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="p-3" style="border-left:2px dashed #ddd">
                          <p><strong>Name : </strong>{{ (isset($employee)? $employee->email : '') }}</p>
                          <p><Strong>NRC : </Strong>{{ (isset($employee)? $employee->nrc_number : '') }}</p>
                          <p><strong>Address : </strong>{{ (isset($employee)? $employee->address : '') }}</p>
                          <p><strong>Birthday : </strong>{{ (isset($employee) ? \Carbon\Carbon::parse($employee->birthday)->format('Y-m-d') : '') }}</p>
                          <p><strong>Join Date : </strong>{{ (isset($employee) ? \Carbon\Carbon::parse($employee->date_of_join)->format('Y-m-d') : '') }}</p>
                          <p><strong>Gender : </strong>@if(isset($employee))
                              {{ $employee->gender == 0 ? 'Male' : 'Female' }}
                            @endif
                          </p>
                          <p><strong>Status : </strong><span class="badge rounded-pill bg-primary">
                            @if(isset($employee))
                              {{ $employee->status == 0 ? 'Leave' : 'Present' }}
                            @endif
                          </span></p>
                        </div>
                    </div>
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
