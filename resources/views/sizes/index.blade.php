@extends('layouts.master')
@section('content')

<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Size Page</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
            <li class="breadcrumb-item active">Size List</li>

          </ol>
        </div>
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>

  <div class="col-lg-12">
    <div class="card card-primary card-outline">
      <div class="card-header"  style="display:flex">
        <h5 class="m-0">Size List </h5><a href="{{route('sizes.create')}}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i></a>
        
      </div>
      @include('flash::message')
      <div class="card-body">

          <table id="example" class="table table-bordered table-hover dataTable dtr-inline" style="width:100%">
            <thead>
                <tr>
                    <th>#Sn</th>
                    <th>Size</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>

              @if ($sizes)
              @foreach($sizes as $key=>$size)

                  <tr>
                  <td>{{++$key}}</td>
                  <td>{{$size->size?? 'Create Category'}}</td>
                  <td>
                    <a href="{{ route('sizes.edit', $size->id)}}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i></a>
                  
                    <a href="javascript:;" class="btn btn-sm btn-warning delete_btn_cls" data-form-id="sizes-delete-{{$size->id}}">
                      <i class="fas fa-trash-alt"></i></a>

                      <form action="{{route('sizes.destroy', $size->id)}}" id="sizes-delete-{{$size->id}}" method="POST">
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