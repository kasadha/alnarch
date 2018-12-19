@extends('layouts.app')

@section('title','team')


@push('css')

@endpush

@section('content')

<div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
                @include('layouts.partials.msg')
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title ">Edit Client</h4>
            </div>
              <div class="card-content ">
                <form method="POST" action="{{ route('team.update',$team->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                            <label class="bmd-label-floating">Name</label>
                            <input type="text" class="form-control" name="name" value="{{ $team->name }}">
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                            <label class="bmd-label-floating">Occupation</label>
                            <input type="text" class="form-control" name="occupation" value="{{ $team->occupation }}">
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                            <label class="bmd-label-floating">Comment</label>
                            <input type="text" class="form-control" name="comment" value="{{ $team->comment }}">
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-12">
                                <label class="bmd-label-floating">Image</label>
                            <input type="file" name="image">
                        </div>
                      </div>
                      <a href="{{route('team.index')}}" class="btn btn-danger">Back</a>
                      <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection


@push('scripts')

@endpush
