@extends('layouts.app')

@section('title','client')



@section('content')

<div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
            <a href="{{route('client.create')}}" class="btn btn-info">Add New</a>
            @include('layouts.partials.msg')
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title ">All client</h4>
            </div>
              <div class="card-content table-responsive">
                <table class="table table-striped table-bordered" id="table" cellspacing="0" width="100%">
                  <thead class=" text-primary">
                   <th>ID</th>
                   <th>Name</th>
                   <th>Occupation</th>
                   <th>Comment</th>
                   <th>Image</th>
                   <th>Created At</th>
                   <th>Updated At</th>
                   <th>Action</th>
                  </thead>
                  <tbody>
                    @foreach ($clients as $key => $client)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $client->name }}</td>
                        <td>{{ $client->occupation }}</td>
                        <td>{{ $client->comment }}</td>
                        <td><img class="img-responsive img-thumbnail" src="{{ asset('images/client/'.$client->image) }}" style="height: 100px; width: 100px" alt=""></td>
                        <td>{{ $client->created_at }}</td>
                        <td>{{ $client->updated_at }}</td>
                        <td>
                            <a href="{{ route('client.edit',$client->id) }}" class="btn btn-info btn-sm"><i class="material-icons">mode_edit</i></a>

                            <form id="delete-form-{{ $client->id }}" action="{{ route('client.destroy',$client->id) }}" style="display: none;" method="POST">
                                @csrf
                                @method('DELETE')
                            </form>
                            <button type="button" class="btn btn-danger btn-sm" onclick="if(confirm('Are you sure? You want to delete this?')){
                                event.preventDefault();
                                document.getElementById('delete-form-{{ $client->id }}').submit();
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
