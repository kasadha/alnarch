@extends('layouts.app')

@section('title','Messages')


@push('css')
    <link rel="stylesheet" href="backend/css/dataTables.bootstrap.min.css">
@endpush

@section('content')

<div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">

            @include('layouts.partials.msg')
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title "><p>{{$quote->name}}</p></h4>
            </div>
              <div class="card-content">
                <div class="row">
                    <div class="col-md-12">
                        <b>Mobile Number:{{$quote->phone}}</b><br>
                        <b>Email:{{$quote->email}}</b><br>
                        <strong>Message:</strong><hr>
                        <p>{{$quote->message}}</p><hr>
                    </div>
                </div>
                <a href="{{route('quote.index')}}" class="btn btn-danger">Back</a>
                <div class="clearfix"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection


@push('scripts')

@endpush
