@extends('layouts.app')

@section('title','Service')



@section('content')

<div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
            <a href="{{route('service.create')}}" class="btn btn-info">Add New</a>
            @include('layouts.partials.msg')
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title ">All Services</h4>
            </div>
              <div class="card-content table-responsive">
                <table class="table table-striped table-bordered" id="table" cellspacing="0" width="100%">
                  <thead class=" text-primary">
                   <th>ID</th>
                   <th>Services</th>
                   <th>Description</th>
                   <th>Button Url</th>
              
                   <th>Image</th>
                   <th>Created At</th>
                   <th>Updated At</th>
                   <th>Action</th>
                  </thead>
                  <tbody>
                    @foreach ($services as $key => $service)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $service->service }}</td>
                        <td>{{ $service->description }}</td>
                        <td>{{ $service->btn_url }}</td>

                        <td><img class="img-responsive img-thumbnail" src="{{ asset('images/service/'.$service->image) }}" style="height: 100px; width: 100px" alt=""></td>
                        <td>{{ $service->created_at }}</td>
                        <td>{{ $service->updated_at }}</td>
                        <td>
                            <a href="{{ route('service.edit',$service->id) }}" class="btn btn-info btn-sm"><i class="material-icons">mode_edit</i></a>

                            <form id="delete-form-{{ $service->id }}" action="{{ route('service.destroy',$service->id) }}" style="display: none;" method="POST">
                                @csrf
                                @method('DELETE')
                            </form>
                            <button type="button" class="btn btn-danger btn-sm" onclick="if(confirm('Are you sure? You want to delete this?')){
                                event.preventDefault();
                                document.getElementById('delete-form-{{ $service->id }}').submit();
                            }else {
                                event.preventDefault();
                                    }"><i class="material-icons">delete</i></button>
                        </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
