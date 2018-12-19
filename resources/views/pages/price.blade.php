@extends('welcome')
@section('content')
  @include('partials.priceheader')
  <section class="ftco-section ">
       <div class="container">
        <div class="row">
        @foreach ($prices as $key => $price)
          <div class="col-md-4">
            <a href="portfolio" class="portfolio ftco-animate">
              <div class="d-flex icon justify-content-center align-items-center">
                <span class="ion-md-search"></span>
              </div>
              <div class="d-flex heading align-items-end">
                <h3>
                  <span>{{$price->services->service}}</span><br>
                  <p class="mb-4">{{$price->description}}</p>
                  <p class="mb-4">{{$price->price}}</p>
                </h3>
              </div>
              <img src="{{ asset('images/price/'.$price->image) }}" class="img-fluid" alt="Colorlib Template" style="width:100%;height:390px;">
            </a>
          </div>
        @endforeach
        </div>
       </div>
     </section>
  @include('partials.quote')
@endsection
