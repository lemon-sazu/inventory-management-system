@extends('layouts.master')
@section('content')

<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Edit Page</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
            <li class="breadcrumb-item active">Edit User</li>
          </ol>
        </div>
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>

  <div class="col-lg-6">
    <div class="card">
      <div class="card-header">
        <h5 class="m-0">Edit User</h5>
      </div>
      @include('flash::message')
      <div class="card-body">
        
        {{-- categories form  --}}
        <form method="POST" action="{{route('user.update', $user->id)}}">
            @csrf
            @method('PUT')
            <div class="card-body">
              <div class="form-group">
                <label for="cat">Name</label>
                <input type="text" class="form-control" name='name' id="cat" value="{{ $user->name ?? ''}}">
                @if ($errors->has('name'))
                    <span class="text-danger">{{$errors->first('name')}}</span>
                @endif
              </div>
              <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" name='email' id="email"  value="{{ $user->email ?? ''}}" placeholder="Enter Email">
                @if ($errors->has('email'))
                    <span class="text-danger">{{$errors->first('email')}}</span>
                @endif
              </div>
              <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" name='password' id="password" placeholder="Enter Password">
                @if ($errors->has('name'))
                    <span class="text-danger">{{$errors->first('password')}}</span>
                @endif
              </div>
              <div class="form-group">
                <label for="confirm_password">Password Confirm</label>
                <input type="password" class="form-control" name='password_confirmation' id="confirm_password" placeholder="Enter Password">
         
              </div>
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
             
   
          </form>

      </div>
    </div>
  </div>

@endsection