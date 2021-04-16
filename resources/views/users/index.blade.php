@extends('layouts.master')
@section('content')

<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Users Page</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
            <li class="breadcrumb-item active">User List</li>
          </ol>
        </div>
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>

  <div class="col-lg-6">
    <div class="card card-primary card-outline">
      <div class="card-header"  style="justify-content:space-between; display:flex">
        <h5 class="m-0">User List </h5><a href="{{route('user.create')}}" class="btn btn-primary btn-sm "><i class="fa fa-plus"></i></a>
      </div>
      @include('flash::message')
      <div class="card-body">

          <table id="example" class="table table-bordered table-hover dataTable dtr-inline" style="width:100%">
            <thead>
                <tr>
                    <th>#Sn</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Created At</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>

              @if ($users)
              @foreach($users as $key=>$user)

                  <tr>
                  <td>{{++$key}}</td>
                  <td>{{$user->name?? 'Create Category'}}</td>
                  <td>{{$user->email?? 'Create Category'}} 
                        @if (auth()->id()==$user->id)
                            (You)
                        @endif
                </td>
                  <td>{{$user->created_at->format('Y-m-d')?? 'Create Category'}}</td>
                  <td>

                    <a href="{{ route('user.edit', $user->id)}}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i></a>
                  @if (auth()->id()!=$user->id)
                    <a href="javascript:;" class="btn btn-sm btn-warning delete_btn_cls" data-form-id="category-delete-{{$user->id}}">
                      <i class="fas fa-trash-alt"></i></a>

                      <form action="{{route('categories.destroy', $user->id)}}" id="category-delete-{{$user->id}}" method="POST">
                      @csrf
                      @method('DELETE')
                      </form>
                      @endif
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