@extends('layouts.app')

@section('title','portfolio')


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
                <form method="POST" action="{{ route('portfolio.update',$portfolio->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                            <label class="bmd-label-floating">Service</label>
                            <select name="services"  class="form-control">
                                @foreach ($services as  $service)
                                    <option {{ $service->id == $portfolio->services->id ? 'selected' : '' }} value="{{$service->id}}">
                                        {{ $service->service }}
                                     </option>
                                @endforeach
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                            <label class="bmd-label-floating">Description</label>
                            <input type="text" class="form-control" name="description" value="{{ $portfolio->description }}">
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                            <label class="bmd-label-floating">Button Url</label>
                            <input type="text" class="form-control" name="btn_url" value="{{ $portfolio->btn_url }}">
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-12">
                                <label class="bmd-label-floating">Image</label>
                            <input type="file" name="image">
                        </div>
                      </div>
                      <a href="{{route('portfolio.index')}}" class="btn btn-danger">Back</a>
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
