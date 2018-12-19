@extends('layouts.app')

@section('title','price')



@section('content')

<div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
            <a href="{{route('price.create')}}" class="btn btn-info">Add New</a>
            @include('layouts.partials.msg')
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title ">All price</h4>
            </div>
              <div class="card-content table-responsive">
                <table class="table table-striped table-bordered" id="table" cellspacing="0" width="100%">
                  <thead class=" text-primary">
                   <th>ID</th>
                   <th>Title</th>
                   <th>Description</th>
                   <th>Price</th>
                   <th>Icon</th>
                   <th>Created At</th>
                   <th>Updated At</th>
                   <th>Action</th>
                  </thead>
                  <tbody>
                    @foreach ($prices as $key => $price)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $price->services->service }}</td>
                        <td>{{ $price->description }}</td>
                        <td>{{ $price->price }}</td>
                        <td><img class="img-responsive img-thumbnail" src="{{ asset('images/price/'.$price->image) }}" style="height: 100px; width: 100px" alt=""></td>
                        <td>{{ $price->created_at }}</td>
                        <td>{{ $price->updated_at }}</td>
                        <td>
                            <a href="{{ route('price.edit',$price->id) }}" class="btn btn-info btn-sm"><i class="material-icons">mode_edit</i></a>

                            <form id="delete-form-{{ $price->id }}" action="{{ route('price.destroy',$price->id) }}" style="display: none;" method="POST">
                                @csrf
                                @method('DELETE')
                            </form>
                            <button type="button" class="btn btn-danger btn-sm" onclick="if(confirm('Are you sure? You want to delete this?')){
                                event.preventDefault();
                                document.getElementById('delete-form-{{ $price->id }}').submit();
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
