@extends('layouts.master')
@section('content')

<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Return Product History</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
            <li class="breadcrumb-item active">Return Product History/li>
          </ol>
        </div>
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>

  <div class="col-lg-12">
    <div class="card card-primary card-outline">
      <div class="card-header"  style="justify-content:space-between; display:flex">
        <h5 class="m-0">Return Product History </h5>
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
                </tr>
            </thead>
            <tbody>

              @if ($return_product)
              @foreach($return_product as $key=>$return)

                  <tr>
                  <td>{{++$key}}</td>
                  <td>{{$return->date?? ''}}</td>
                  <td>{{$return->product->name?? ''}}</td>
                  <td>{{$return->size->size?? ''}}</td>
                  <td>{{$return->quantity?? ''}}</td>
                 
                  </tr>
              @endforeach
          @endif
    
           
            </tbody>

        </table>

          


      </div>
    </div>
  </div>

@endsection