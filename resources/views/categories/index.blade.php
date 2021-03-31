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
            <li class="breadcrumb-item active">Category List</li>
          </ol>
        </div>
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>

  <div class="col-lg-6">
    <div class="card card-primary card-outline">
      <div class="card-header"  style="justify-content:space-between; display:flex">
        <h5 class="m-0">Category List </h5><a href="{{route('categories.create')}}" class="btn btn-primary btn-sm "><i class="fa fa-plus"></i></a>
      </div>
      @include('flash::message')
      <div class="card-body">

          <table id="example" class="table table-bordered table-hover dataTable dtr-inline" style="width:100%">
            <thead>
                <tr>
                    <th>#Sn</th>
                    <th>Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>

              @if ($categories)
              @foreach($categories as $key=>$cat)

                  <tr>
                  <td>{{++$key}}</td>
                  <td>{{$cat->name?? 'Create Category'}}</td>
                  <td>
                    <a href="{{ route('categories.edit', $cat->id)}}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i></a>
                  
                    <a href="javascript:;" class="btn btn-sm btn-warning delete_btn_cls" data-form-id="category-delete-{{$cat->id}}">
                      <i class="fas fa-trash-alt"></i></a>

                      <form action="{{route('categories.destroy', $cat->id)}}" id="category-delete-{{$cat->id}}" method="POST">
                      @csrf
                      @method('DELETE')
                      </form>

                  </td>
                  </tr>
              @endforeach
          @endif
    
           
            </tbody>

        </table>

          


      </div>
    </div>
  </div>

@endsection