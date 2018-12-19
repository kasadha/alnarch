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
              <h4 class="card-title ">Requst Quotes</h4>
            </div>
              <div class="card-content table-responsive">
                <table class="table table-striped table-bordered" id="table" cellspacing="0" width="100%">
                  <thead class=" text-primary">
                   <th>ID</th>
                   <th> Full Names</th>
                   <th>Mobile Number</th>
                   <th>Email</th>
                   <th>Message</th>
                   <th>Sent At</th>
                   <th>Action</th>
                  </thead>
                  <tbody>
                    @foreach ($quotes as $key => $quote)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $quote->name }}</td>
                        <td>{{ $quote->phone }}</td>
                        <td>{{ $quote->email }} </td>
                        <td>{{ $quote->message }}</td>
                        <td>{{ $quote->created_at }}</td>
                        <td>
                            <a href="{{ route('quote.show',$quote->id) }}" class="btn btn-info btn-sm">
                                <i class="material-icons">details</i></a>

                            <form id="delete-form-{{ $quote->id }}" action="{{ route('quote.destroy',$quote->id) }}" style="display: none;" method="POST">
                                @csrf
                                @method('DELETE')
                            </form>
                            <button type="button" class="btn btn-danger btn-sm" onclick="if(confirm('Are you sure? You want to delete this?')){
                                event.preventDefault();
                                document.getElementById('delete-form-{{ $quote->id }}').submit();
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


@push('scripts')
    <script src="js/jquery.dataTables.min.js"></script>
    <script src="/js/dataTables.bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#table').DataTable();
        } );
    </script>
@endpush
