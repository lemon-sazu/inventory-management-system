@extends('layouts.master')
@section('content')

<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Stock History</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
            <li class="breadcrumb-item active">Stock History/li>
          </ol>
        </div>
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>

  <div class="col-lg-12">
    <div class="card card-primary card-outline">
      <div class="card-header"  style="justify-content:space-between; display:flex">
        <h5 class="m-0">Stock History List </h5><a href="{{route('categories.create')}}" class="btn btn-primary btn-sm "><i class="fa fa-plus"></i></a>
      </div>
      @include('flash::message')
      <div class="card-body">

          <table id="example" class="table table-bordered table-hover dataTable dtr-inline" style="width:100%">
            <thead>
                <tr>
                    <th>#Sn</th>
                    <th>Date</th>
                    <th>Name</th>
                    <th>Size</th>
                    <th>Quantity</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>

              @if ($stocks)
              @foreach($stocks as $key=>$stock)

                  <tr>
                  <td>{{++$key}}</td>
                  <td>{{$stock->date?? ''}}</td>
                  <td>{{$stock->product->name?? ''}}</td>
                  <td>{{$stock->size->size?? ''}}</td>
                  <td>{{$stock->quantity?? ''}}</td>
                  <td>{{strtoupper($stock->status)?? ''}}</td>
                 
                  </tr>
              @endforeach
          @endif
    
           
            </tbody>

        </table>

          


      </div>
    </div>
  </div>

@endsection