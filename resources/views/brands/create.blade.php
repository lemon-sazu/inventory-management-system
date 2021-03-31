@extends('layouts.master')
@section('content')

<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Categories Page</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
            <li class="breadcrumb-item active">Create Category</li>
          </ol>
        </div>
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>

  <div class="col-lg-6">
    <div class="card">
      <div class="card-header">
        <h5 class="m-0">Create Category</h5>
      </div>
      @include('flash::message')
      <div class="card-body">
        
        {{-- categories form  --}}
        <form method="POST" action="{{route('categories.store')}}">
            @csrf
            <div class="card-body">
              <div class="form-group">
                <label for="cat">Category Name</label>
                <input type="text" class="form-control" name='name' id="cat" placeholder="Enter Name">
                @if ($errors->has('name'))
                    <span class="text-danger">{{$errors->first('name')}}</span>
                @endif
              </div>
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
             
   
          </form>

      </div>
    </div>
  </div>

@endsection