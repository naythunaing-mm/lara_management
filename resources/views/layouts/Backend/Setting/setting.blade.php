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
                  @if(isset($settings))
                  <form id="formAccountSettings formAuthentic ation" method="POST" class="needs-validation" action="{{ route('settingUpdate') }}" novalidate>
                  @endif
                    @csrf

                    <div class="row">
                      <div class="mb-3 col-md-6">
                        <label for="name" class="form-label">Site Name</label>
                        <input class="form-control" type="text" id="name" name="name" placeholder="Site's name" value="{{ (isset($settings)? $settings->name : '') }}"  required />
                        <div class="invalid-feedback">
                          @if ($errors->has('name'))
                          <p style="color:red">Please valid name</p>
                          @endif
                          Invalid Employee Name
                        </div>
                      </div>

                      <div class="mb-3 col-md-6">
                        <label for="email" class="form-label">E-mail</label>
                        <input class="form-control" type="email" id="email" name="email" placeholder="example@gmail.com" value="{{ (isset($settings)? $settings->email : '') }}" required  />
                        <div class="invalid-feedback">
                          @if ($errors->has('email'))
                          <p style="color:red">Please valid email</p>
                          @endif
                          Invalid Email
                        </div>
                      </div>

                      <div class="mb-3 col-md-6">
                        <label class="form-label" for="outline_phone">OutLine Phone Number</label>
                          <input  type="text"  id="outline_phone" name="outline_phone" class="form-control" placeholder="+95-XXX-XXXX-XXX" value="{{ (isset($settings)? $settings->outline_phone : '') }}" required  />
                          <div class="invalid-feedback">
                            @if ($errors->has('outline_phone'))
                            <p style="color:red">Please valid Outline phone</p>
                            @endif
                            Invalid Outline Phone Number
                          </div>
                      </div>

                      <div class="mb-3 col-md-6">
                        <label class="form-label" for="size_unit">Size Unit</label>
                          <input  type="text"  id="size_unit" name="size_unit" class="form-control" placeholder="cm" value="{{ (isset($settings)? $settings->size_unit : '') }}" required  />
                          <div class="invalid-feedback">
                            @if ($errors->has('size_unit'))
                            <p style="color:red">Please valid  Unit</p>
                            @endif
                            Invalid Unit
                          </div>
                      </div>

                      <div class="mb-3 col-md-6">
                        <label class="form-label" for="online_phone">Online Phone Number</label>
                          <input  type="text"  id="online_phone" name="online_phone" class="form-control" placeholder="+95-XXX-XXXX-XXX" value="{{ (isset($settings)? $settings->online_phone : '') }}" required  />
                          <div class="invalid-feedback">
                            @if ($errors->has('online_phone'))
                            <p style="color:red">Please valid Online phone</p>
                            @endif
                            Invalid Online Phone Number
                          </div>
                      </div>

                      <div class="mb-3 col-md-6">
                        <label class="form-label" for="occupancy">Occupancy</label>
                          <input  type="text"  id="occupancy" name="occupancy" class="form-control" placeholder="peoples" value="{{ (isset($settings)? $settings->occupancy : '') }}" required  />
                          <div class="invalid-feedback">
                            @if ($errors->has('occupancy'))
                            <p style="color:red">Please valid occupancy</p>
                            @endif
                            Invalid occupancy
                          </div>
                      </div>

                      <div class="mb-3 col-md-6">
                        <label class="form-label" for="price_unit">Price Unit</label>
                          <input  type="text"  id="price_unit" name="price_unit" class="form-control" placeholder="$" value="{{ (isset($settings)? $settings->price_unit : '') }}" required  />
                          <div class="invalid-feedback">
                            @if ($errors->has('price_unit'))
                            <p style="color:red">Please valid Price Unit</p>
                            @endif
                            Invalid Price Unit
                          </div>
                      </div>

                      <div class="mb-3 col-md-6">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" class="form-control" id="address" name="address" placeholder="Address" value="{{ (isset($settings)? $settings->address : '') }}" required />
                        <div class="invalid-feedback">
                          @if ($errors->has('address'))
                          <p style="color:red">Please valid address</p>
                          @endif
                          Invalid Address
                        </div>
                      </div>

                      <div class="mb-3 col-md-6">
                        <label for="checkin" class="form-label">Checkin Time</label>
                        <input class="form-control" type="text" id="checkin" name="checkin" value="{{ (isset($settings) ? $settings->checkin : '') }}" required />
                        <div class="invalid-feedback">
                          @if ($errors->has('checkin'))
                          <p style="color:red">Please valid checkin</p>
                          @endif
                          Invalid Checkin
                        </div>
                      </div>

                      <div class="mb-3 col-md-6">
                        <label for="checkout" class="form-label">Checkout Time</label>
                        <input type="text" class="form-control" id="checkout" name="checkout" value="{{ (isset($settings) ? $settings->checkout : '') }}" required />
                          <div class="invalid-feedback">
                          @if ($errors->has('checkout'))
                          <p style="color:red">Please enter a valid checkout</p>
                          @endif
                          Invalid checkout
                          </div>
                      </div>

                    <div class="mt-2">
                      @if(isset($settings))
                      <input type="hidden" name="id" value="{{ $settings->id }}" />
                      @endif
                      <input type="submit" class="btn btn-primary me-2">
                    </div>
                  </form>
                </div>
                <!-- /Account -->
              </div>
            </div>
          </div>
        </div>
        <!-- / Content -->
    </div>
    <!-- Content wrapper -->

@endsection
