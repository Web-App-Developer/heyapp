@extends('BackendViews.Admin.layouts.master')

@section('adminContent')      
@include('BackendViews.Admin.layouts.partials.sidebar')
      
    <!-- yield content here -->
    <div class="col-md-12 grid-margin">
      <div class="card">
        <div class="card-body">
          <div class="d-flex justify-content-between">
            <h4 class="card-title mb-0">My Profile</h4>
          </div>
          <p class="card-description">This page represent the admin profile</p>
          
          @include('msg.msg')
            
          <div class='row'>
              <div class="col-md-6" style="margin-bottom: 20px">
                <p class="text-uppercase">Change Info.</p>
                <form action="{{ route('admin.changeInfo') }}" method="POST">
                  @csrf
                  <div class="form-group">
                    <label for="email">Name</label>
                    <input type="text" name="name" value="{{ Auth::user()->name }}" required="1" class="form-control">
                  </div>
                  <div class="form-group">
                    <label for="email">Current Email</label>
                    <input type="email" name="email" value="{{ Auth::user()->email }}" required="1" class="form-control">
                  </div>
                  <button class="btn btn-primary btn-sm">Update</button>
                </form>
              </div>

              <div class="col-md-6">
                <p class="text-uppercase">Change Password</p>
                <form action="{{ route('admin.changePassword') }}" method="POST">
                  @csrf
                  <div class="form-group">
                    <label for="current_password">Current Password</label>
                    <input type="password" name="current_password" required="1" class="form-control">
                  </div>
                  <div class="form-group">
                    <label for="password">New Password</label>
                    <input type="password" name="password" required="1" class="form-control">
                  </div>
                  <div class="form-group">
                    <label for="password_confirmation">Confirmed Password</label>
                    <input type="password" name="password_confirmation" required="1" class="form-control">
                  </div>
                  <button class="btn btn-primary btn-sm">Update</button>
                </form>
              </div>
          </div>
          
        </div>
      </div>
    </div>

@endsection