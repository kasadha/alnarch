@extends('layouts.app')

@section('title','contactheader')



@section('content')

<div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <a href="{{route('contactheader.create')}}" class="btn btn-info">Add</a>
            @include('layouts.partials.msg')
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title ">About header</h4>
            </div>
              <div class="card-content table-responsive">
                <table class="table table-striped table-bordered" id="table" cellspacing="0" width="100%">
                  <thead class=" text-primary">
                   <th>ID</th>
                   <th>Mobile Phone</th>
                   <th>Email</th>
                   <th>Address</th>
                   <th>Image</th>
                   <th>Facebook Url</th>
                   <th>Twiter Url</th>
                   <th>Instagram Url</th>
                   <th>Created At</th>
                   <th>Updated At</th>
                   <th>Action</th>
                  </thead>
                  <tbody>
                    @foreach ($contactheaders as $key => $contactheader)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{$contactheader->phone}}</td>
                        <td>{{$contactheader->email}}</td>
                        <td>{{$contactheader->address}}</td>
                        <td><img class="img-responsive img-thumbnail" src="{{ asset('images/contact/'.$contactheader->image) }}" style="height: 100px; width: 100px" alt=""></td>
                        <td>{{ $contactheader->fb }}</td>
                        <td>{{ $contactheader->twiter }}</td>
                        <td>{{ $contactheader->instagram }}</td>
                        <td>{{ $contactheader->created_at }}</td>
                        <td>{{ $contactheader->updated_at }}</td>
                        <td>
                            <a href="{{ route('contactheader.edit',$contactheader->id) }}" class="btn btn-info btn-sm"><i class="material-icons">mode_edit</i></a>
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
