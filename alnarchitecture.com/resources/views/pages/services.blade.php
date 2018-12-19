@extends('welcome')
@section('content')
  @include('partials.serviceheader')
  <section class="ftco-services">
    <div class="container">
      <div class="row">
      @foreach ($services as $key => $service)
        <div class="col-md-4">
          <a href="portfolio" class="portfolio ftco-animate">
            <div class="d-flex icon justify-content-center align-items-center">
              <span class="ion-md-search"></span>
            </div>
            <div class="d-flex heading align-items-end">
              <h3>
                <span>{{$service->service}}</span><br>

              </h3>
            </div>
            <img src="{{ asset('images/service/'.$service->image) }}" class="img-fluid" alt="Colorlib Template" style="width:100%;height:390px;">
          </a>
        </div>
      @endforeach
      </div>
    </div>
     </section>

@endsection
