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
              <h4 class="card-title "><p>{{$message->subject}}</p></h4>
            </div>
              <div class="card-content">
                <div class="row">
                    <div class="col-md-12">
                        <strong>Name:{{$message->name}}</strong><br>
                        <b>Phone Number:{{$message->phone}}</b><br>
                        <b>Email:{{$message->email}}</b><br>
                        <strong>Message:</strong><hr>
                        <p>{{$message->body}}</p><hr>
                    </div>
                </div>
                <a href="{{route('message.index')}}" class="btn btn-danger">Back</a>
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
